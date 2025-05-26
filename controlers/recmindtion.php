
<?php
// db_connection.php
function getDbConnection() {
    $servername = "localhost"; // Your database host
    $username = "your_db_user"; // Your database username
    $password = "your_db_password"; // Your database password
    $dbname = "your_db_name"; // Your database name

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Set default fetch mode to associative arrays
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch(PDOException $e) {
        // Log the error for debugging, but don't expose sensitive info to the user
        error_log("Database Connection failed: " . $e->getMessage());
        // In a production environment, you might just show a generic error page
        http_response_code(500);
        die("Service unavailable. Please try again later.");
    }
}
?>

<?php
// recommendations.php
require_once 'db_connection.php'; // Include your database connection file

function getCategoryBasedPodcastRecommendations($userId, $limit = 10) {
    $conn = getDbConnection();
    $recommendations = [];

    try {
        // Step 1: Find all categories associated with podcasts the user has subscribed to
        // We'll count how many times a category appears across subscribed podcasts to prioritize
        $stmt = $conn->prepare("
            SELECT
                pc.category_id,
                c.name AS category_name,
                COUNT(pc.category_id) AS category_count
            FROM
                subscriptions s
            JOIN
                podcast_categories pc ON s.podcast_id = pc.podcast_id
            JOIN
                categories c ON pc.category_id = c.category_id
            WHERE
                s.user_id = :user_id
            GROUP BY
                pc.category_id, c.name
            ORDER BY
                category_count DESC
        ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $subscribedCategories = $stmt->fetchAll();

        if (empty($subscribedCategories)) {
            // Cold start for new users or users with no subscriptions:
            // Recommend popular podcasts or simply a diverse set
            return getPopularPodcasts($limit);
        }

        // Extract category IDs for the main recommendation query
        $categoryIds = array_column($subscribedCategories, 'category_id');
        $categoryPlaceholders = implode(',', array_fill(0, count($categoryIds), '?'));

        // Step 2: Get podcasts already subscribed by the user to exclude them
        $stmt = $conn->prepare("SELECT podcast_id FROM subscriptions WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $alreadySubscribedPodcastIds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Get just the IDs

        $excludePlaceholders = '0'; // Default if no exclusions
        if (!empty($alreadySubscribedPodcastIds)) {
            $excludePlaceholders = implode(',', array_fill(0, count($alreadySubscribedPodcastIds), '?'));
        }

        // Step 3: Find other podcasts in these categories, excluding already subscribed ones
        // Prioritize podcasts based on how many of the user's subscribed categories they belong to.
        $sql = "
            SELECT
                p.podcast_id,
                p.title,
                p.description,
                p.cover_image,
                GROUP_CONCAT(c.name ORDER BY c.name SEPARATOR ', ') AS categories,
                COUNT(pc.category_id) AS shared_category_count
            FROM
                podcasts p
            JOIN
                podcast_categories pc ON p.podcast_id = pc.podcast_id
            JOIN
                categories c ON pc.category_id = c.category_id
            WHERE
                pc.category_id IN ($categoryPlaceholders)
                AND p.status = 'published' -- Only recommend published podcasts
                AND p.podcast_id NOT IN ($excludePlaceholders)
            GROUP BY
                p.podcast_id, p.title, p.description, p.cover_image
            ORDER BY
                shared_category_count DESC, -- Podcasts matching more categories first
                p.created_at DESC -- Then by recency (or popularity if you track plays)
            LIMIT :limit
        ";

        $stmt = $conn->prepare($sql);

        // Bind category IDs
        $paramIndex = 1;
        foreach ($categoryIds as $catId) {
            $stmt->bindValue($paramIndex++, $catId, PDO::PARAM_INT);
        }

        // Bind excluded podcast IDs (if any)
        if (!empty($alreadySubscribedPodcastIds)) {
            foreach ($alreadySubscribedPodcastIds as $subId) {
                $stmt->bindValue($paramIndex++, $subId, PDO::PARAM_INT);
            }
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();
        $recommendations = $stmt->fetchAll();

    } catch (PDOException $e) {
        error_log("Error getting category-based podcast recommendations: " . $e->getMessage());
        // Return an empty array or handle error gracefully
    } finally {
        $conn = null; // Close connection
    }
    return $recommendations;
}

// Helper function for cold start (new users or no subscriptions)
function getPopularPodcasts($limit = 10) {
    $conn = getDbConnection();
    $popularPodcasts = [];
    try {
        // A simple definition of popular: most subscriptions
        $stmt = $conn->prepare("
            SELECT
                p.podcast_id,
                p.title,
                p.description,
                p.cover_image,
                COUNT(s.podcast_id) AS subscription_count
            FROM
                podcasts p
            LEFT JOIN
                subscriptions s ON p.podcast_id = s.podcast_id
            WHERE
                p.status = 'published'
            GROUP BY
                p.podcast_id, p.title, p.description, p.cover_image
            ORDER BY
                subscription_count DESC, p.created_at DESC
            LIMIT :limit
        ");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $popularPodcasts = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error getting popular podcasts: " . $e->getMessage());
    } finally {
        $conn = null;
    }
    return $popularPodcasts;
}


// API Endpoint Usage:
if (isset($_GET['user_id'])) {
    $userId = (int)$_GET['user_id'];
    $recommendations = getCategoryBasedPodcastRecommendations($userId);

    // Set header to indicate JSON content
    header('Content-Type: application/json');
    echo json_encode(['recommendations' => $recommendations]);
} else {
    // Handle error if user_id is not provided
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'User ID is required.']);
}
?>