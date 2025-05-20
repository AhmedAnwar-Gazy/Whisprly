<?php
$heading = "Podcast Category Management";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// --- Authorization Check (Admin Only) ---
// Assume $_SESSION['user']['role'] holds the user's role
$currentUserRole = $_SESSION['user']['role'] ?? 'listener';
if ($currentUserRole !== 'admin') {
    abort(403); // Forbidden: Only admins can access this page
}
// --- End Authorization Check ---

try {
    $search = $_GET['search'] ?? '';

    // Base Query to fetch distinct categories
    // If you had a 'categories' table, you would query that instead:
    // "SELECT category_id, name FROM categories WHERE 1=1"
    $query = "
        SELECT DISTINCT category
        FROM podcasts
        WHERE 1=1
    ";

    $params = [];

    // 🔎 Add Search Filter for categories
    if (!empty($search)) {
        // Using LIKE for partial matches since it's a VARCHAR field
        $query .= " AND category LIKE :search";
        $params['search'] = '%' . $search . '%';
    }

    // Finalize Query
    $query .= " ORDER BY category ASC;";

    // Execute the query
    $categories = $db->query($query, $params)->fetchAll();

    // If you had a 'categories' table, the fetch above would be:
    // $categories = $db->query($query, $params)->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500); // Internal Server Error
}

require "views/pages/admin/category_management_view.php";














// <?php



// use core\App;
// use core\Database;

// $db = App::resolve(Database::class);


// $page = "charity_campaigns_manage" ;

// $heading = "All My tests";

// try {
//     // Fetch categories for the dropdown
//     $categories = $db->query("SELECT log_id, name FROM categories")->fetchAll();

//     // Get search and filter inputs
//     $search = $_GET['search'] ?? '';
//     $filter = $_Get['filter'] ?? 'all';

//     // Base Query
//     $query = "
//         SELECT
//     al.log_id,
//     ad.name AS admin_name,
//     al.action_type,
//     al.target_type,
//     al.target_id,
//     al.notes,
//     al.timestamp
// FROM
//     admin_logs al
// JOIN
//     users ad ON al.admin_id = ad.user_id;
 
//     ";

//     $params = [];

//     // 🔎 Add Search Filter
//     if (!empty($search)) {
//         $query .= " AND MATCH(al.notes) AGAINST (:search IN NATURAL LANGUAGE MODE)";
//         $params['search'] = $search;
//     }

//     // 🎯 Add Category Filter (if a valid category is selected)
//     if ($filter !== 'all' && is_numeric($filter)) {
//         $query .= " AND al.log_id = :log_id";
//         $params['log_id'] = $filter;
//     }

//     // if ($_GET['submit'] == "foryou") {
//     //     $query .= " AND u.user_id = :user_id";
//     //     $params['user_id'] = $_SESSION['user']['id'];
//     // }

//     if (isset($_GET['NotActivated'])) {
//         $query .= " AND  g.state <> 'active' ";
//     } else {
//         $query .= " AND  g.state = 'active' " ;
//     }


//     // 👌 Finalize Query
//     $query .= " GROUP BY g.campaign_id ORDER BY g.start_at;";

//     // Execute the query
//     $campaigns = $db->query($query, $params)->fetchAll();

// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }




// require "views/admin/manage_view.php";
