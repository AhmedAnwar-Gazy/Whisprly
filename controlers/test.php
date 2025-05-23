<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinite Scroll Pagination</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Our Products</h1>
    <div id="content-container">
        <?php
        // Database connection (replace with your credentials)
        $servername = "localhost";
        $username = "root";
        $password = ""; // Your database password
        $dbname = "your_database_name"; // Your database name

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $limit = 5; // Number of items to load initially
        $offset = 0;

        $sql = "SELECT * FROM products ORDER BY id ASC LIMIT $limit OFFSET $offset";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-item' data-id='" . $row['id'] . "'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }

        $conn->close();
        ?>
    </div>

    <div id="loading-spinner" style="display: none; text-align: center; padding: 20px;">
        Loading more products...
    </div>

    <script>
        // Set initial offset for JavaScript to pick up
        var initialOffset = <?php echo $limit; ?>;
    </script>
    <script src="js/infinite_scroll.js"></script>
</body>
</html>

<?php
header('Content-Type: application/json');

// Database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "your_database_name"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Number of items to load per request
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Starting point for fetching

// Basic validation to prevent negative values
if ($limit <= 0) $limit = 5;
if ($offset < 0) $offset = 0;

$sql = "SELECT * FROM products ORDER BY id ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

echo json_encode(['success' => true, 'products' => $products]);
?>