

<?php
// Set the heading for the page
$heading = "All Podcasts";

// Include necessary core classes
use core\App;
use core\Database;

// Resolve the Database instance from the application container
$db = App::resolve(Database::class);

try {
    // Get the search term from the URL query parameter 'search'. Default to empty string.
    $search = $_GET['search'] ?? '';
    // Get the category filter from the URL query parameter 'category'. Default to 'all'.
    $categoryFilter = $_GET['category'] ?? 'all';
    // Get the sorting order for 'created_at'. Default to 'desc' (newest first).
    $sortByCreatedAt = $_GET['sort_by_created_at'] ?? 'desc'; // 'asc' for oldest first, 'desc' for newest first

    // --- 1. Fetch all distinct categories for the filter dropdown ---
    // This allows you to populate a <select> dropdown in your HTML view.
    $allCategories = $db->query("SELECT DISTINCT category FROM podcasts ORDER BY category ASC")->fetchAll();

    // --- 2. Construct the Base SQL Query ---
    $query = "
        SELECT
            p.podcast_id,
            p.title,
            p.description,
            p.category,
            p.cover_image,
            p.created_at,
            u.name AS creator_name,
            COUNT(e.episode_id) AS episode_count
        FROM podcasts p
        JOIN users u ON p.created_by = u.user_id
        LEFT JOIN episodes e ON p.podcast_id = e.podcast_id
        WHERE p.status = 'published' -- CRITICAL: Only show published podcasts to the public
    ";

    // Initialize an array to hold parameters for the prepared statement
    $params = [];

    // --- 3. Add Full-Text Search Filter ---
    // If a search term is provided, add the MATCH() AGAINST() clause.
    // IMPORTANT: For this to work efficiently, you MUST have a FULLTEXT index on
    // 'title' and 'description' columns in your 'podcasts' table.
    // Example SQL to add index: ALTER TABLE podcasts ADD FULLTEXT(title, description);
    if (!empty($search)) {
        $query .= " AND MATCH(p.title, p.description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
        $params['search'] = $search; // Bind the search term parameter
    }

    // --- 4. Add Category Filtering ---
    // If a specific category is selected (not 'all'), add the category filter.
    if ($categoryFilter !== 'all' && !empty($categoryFilter)) {
        $query .= " AND p.category = :category_filter";
        $params['category_filter'] = $categoryFilter; // Bind the category filter parameter
    }

    // --- 5. Finalize Query with Grouping and Ordering ---
    // Group by podcast_id to ensure COUNT(e.episode_id) works correctly for each podcast.
    $query .= " GROUP BY p.podcast_id";

    // Add ordering by 'created_at' based on the 'sort_by_created_at' parameter
    if ($sortByCreatedAt === 'asc') {
        $query .= " ORDER BY p.created_at ASC;";
    } else {
        // Default to descending order (newest first)
        $query .= " ORDER BY p.created_at DESC;";
    }

    // --- 6. Execute the Query ---
    $podcasts = $db->query($query, $params)->fetchAll();

} catch (PDOException $e) {
    // Log any database errors for debugging
    error_log($e->getMessage());
    // Abort and show a 500 error page to the user
    abort(500); // Assumes your application has an 'abort' function for error handling
}


require "views/pages/podcast/index_view.php";






















// <?php

// use core\App;
// use core\Database;
// use models\Campaign;

// $db = App::resolve(Database::class);
// $errors = [];

// if (empty($_POST['title'])) {
//     $errors['title'] = "حقل العنوان مطلوب.";
// } elseif (strlen($_POST['title']) > 150) {
//     $errors['title'] = "يجب أن يكون العنوان أقل من 150 حرفًا.";
// }

// $description = $_POST['description'] ?? '';
// if (strlen($description) > 65535) {
//     $errors['description'] = "يجب أن يكون الوصف أقل من 65535 حرفًا.";
// }

// $category = $_POST['category'] ?? '';
// if (strlen($category) > 100) {
//     $errors['category'] = "يجب أن تكون الفئة أقل من 100 حرفًا.";
// }

// $cover_image = $_POST['cover_image'] ?? '';
// if (strlen($cover_image) > 255) {
//     $errors['cover_image'] = "يجب أن يكون رابط صورة الغلاف أقل من 255 حرفًا.";
// }

// if (empty($_POST['created_by'])) {
//     $errors['created_by'] = "حقل المنشئ مطلوب.";
// } elseif (!filter_var($_POST['created_by'], FILTER_VALIDATE_INT) || filter_var($_POST['created_by'], FILTER_VALIDATE_INT) <= 0) {
//     $errors['created_by'] = "يجب أن يكون معرف المنشئ عددًا صحيحًا موجبًا.";
// }

// $status = $_POST['status'] ?? 'pending';
// if (!in_array($status, ['published', 'pending', 'rejected'])) {
//     $errors['status'] = "الحالة المحددة غير صالحة.";
// }

// if (empty($errors)) {
//     try {
//         $sql = "INSERT INTO podcasts (title, description, category, cover_image, created_by, status) VALUES (:title, :description, :category, :cover_image, :created_by, :status)";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute([
//             'title' => htmlspecialchars($_POST['title']),
//             'description' => htmlspecialchars($description),
//             'category' => htmlspecialchars($category),
//             'cover_image' => htmlspecialchars($cover_image),
//             'created_by' => filter_var($_POST['created_by'], FILTER_SANITIZE_NUMBER_INT),
//             'status' => $status
//         ]);
//         echo "تم إضافة البودكاست بنجاح.";
//     } catch (PDOException $e) {
//         error_log("خطأ في إضافة البودكاست: " . $e->getMessage());
//         echo "حدث خطأ أثناء إضافة البودكاست: " . htmlspecialchars($e->getMessage());
//     }
// } else {
//     echo "<ul>";
//     foreach ($errors as $error) {
//         echo "<li>" . $error . "</li>";
//     }
//     echo "</ul>";
//  }






 // from bader
 
// $page = "charity_campaigns_index" ;
// start_page:
// $page_campaigns_ids = [];
// $heading = "All My tests";
// if(!isset($_GET['page_number'])) $_GET['page_number'] = 1; // if page_number not set in $_GET

// $search = $_GET['search'] ?? '';
// $filter = $_GET['filter'] ?? 'all';

// if(!isset($_SESSION['campaigns_count_all'])){
//     $page_campaigns_ids = [];
//     $_SESSION['campaigns_count_all'] = $db->query(
//         "select count(*) as count from campaigns where state = 'active';"
//     )->fetchAll()['0']['count'];
// }else{
//     $campaigns_current_count = $db->query( "select count(*) as count from campaigns where state = 'active';")->fetchAll()['0']['count'];
//     if($campaigns_current_count != $_SESSION['campaigns_count_all']){
//         if($campaigns_current_count > $_SESSION['campaigns_count_all']){// changes are adding
//             if(count($_SESSION['campaigns_pages'][$_GET['page_number']]) < '10'){ // there is an empty place for the added value
//                 $_SESSION['campaigns_pages'][$_GET['page_number']] = [];
//             }else{// no empty place for the new item added
//                 $latest_page = intval($_SESSION['campaigns_count_all']/10 + 1);
//                 $_SESSION['campaigns_pages'][$latest_page] = [];
//             }
//         }else{// changes are deleting
//             $_SESSION['campaigns_pages'] = [];
//         }
//         $_SESSION['campaigns_count_all'] = $campaigns_current_count;
//         goto start_page;
//     }
// }
// $pages_count['campaigns'] = $_SESSION['campaigns_count_all']/10 + 1;
// $has_next = !isset($_GET['page_number']) || $_GET['page_number'] + 1 >= $pages_count['campaigns'];
// $filtered = (!empty($search) || ($filter !== 'all') || (isset($_GET['submit']) && $_GET['submit'] == "foryou"));

// try {
//     // Fetch categories for the dropdown
//     $categories = $db->query("SELECT category_id, name FROM categories")->fetchAll();

//     // Get search and filter inputs
    
//     $query = 
//     "SELECT
//     p.podcast_id,
//     p.title AS podcast_title,
//     u.name AS creator_name,
//     COUNT(s.user_id) AS subscriber_count
// FROM
//     podcasts p
// JOIN
//     users u ON p.created_by = u.user_id
// LEFT JOIN
//     subscriptions s ON p.podcast_id = s.podcast_id
// GROUP BY
//     p.podcast_id, p.title, u.name
// ORDER BY
//     subscriber_count DESC;


    
    
  
//     ";
//     if($filtered){
//         $params = [];
//         if (!empty($search)) {
//             $query .= " AND MATCH(g.name, g.short_description, g.full_description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
//             $params['search'] = $search;
//         }
//         // 🎯 Add Category Filter (if a valid category is selected)
//         if ($filter !== 'all' && is_numeric($filter)) {
//             $query .= " AND g.category_id = :category_id";
//             $params['category_id'] = $filter - 1 ;
//         }
//         if(isset($_GET['submit']) && $_GET['submit'] == "foryou"){
//             $query .= " AND u.user_id = :user_id";
//             $params['user_id'] = $_SESSION['user']['id'];
//         }
//         $campaigns = $db->query($query, $params)->fetchAll();
//     }elseif/*ides are stored in session */(isset($_SESSION['campaigns_pages']) && isset($_SESSION['campaigns_pages'][$_GET['page_number']]) && count($_SESSION['campaigns_pages'][$_GET['page_number']]) > 0){
//         $query .= " AND g.campaign_id IN (".implode(separator: ",",array: $_SESSION['campaigns_pages'][$_GET['page_number']]).") order by g.campaign_id;";
//         $campaigns = $db->query($query)->fetchAll();
//     }else{// list of items arent stored yet in session
//         if(isset($_SESSION['campaigns_pages'])){
//             $query .= " AND g.campaign_id NOT IN (-1,-2 ";
//             foreach($_SESSION['campaigns_pages'] as $key => $value){
//                     if(isset($value) && count($value) > 0){
//                         $query .= ",".implode(",", $value);
//                     }
//                 }
//                 $query .= ")";
//             }
//             $query.= " ORDER BY RAND() limit 10;";
//         $campaigns = $db->query($query)->fetchAll();
//         foreach($campaigns as $campaign){
//             $page_campaigns_ids[] = $campaign['campaign_id'];
//         }
//         $_SESSION['campaigns_pages'][$_GET['page_number']] = $page_campaigns_ids;
//     }
//     // 👌 Finalize Query

//     // Execute the query
    

// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }





// require "views/pages/charity_campaigns/index_view.php";
