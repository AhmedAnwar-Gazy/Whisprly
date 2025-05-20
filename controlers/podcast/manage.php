<?php
$heading = "Manage My Podcasts";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Assume you have a way to get the current logged-in user's ID
// For demonstration, let's use a placeholder. In a real app, this would come from session/auth.
$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Adjust this for your auth system

try {
    $search = $_GET['search'] ?? '';
    $statusFilter = $_GET['status'] ?? 'all'; // 'published', 'pending', 'rejected', 'all'

    $query = "
        SELECT
            p.podcast_id,
            p.title,
            p.description,
            p.category,
            p.cover_image,
            p.status,
            p.created_at,
            u.name AS creator_name
        FROM podcasts p
        JOIN users u ON p.created_by = u.user_id
        WHERE p.created_by = :current_user_id
    ";

    $params = [
        'current_user_id' => $currentUserId
    ];

    // Add Search Filter
    if (!empty($search)) {
        $query .= " AND MATCH(p.title, p.description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
        $params['search'] = $search;
    }

    // Add Status Filter
    if ($statusFilter !== 'all' && in_array($statusFilter, ['published', 'pending', 'rejected'])) {
        $query .= " AND p.status = :status_filter";
        $params['status_filter'] = $statusFilter;
    }

    // Finalize Query
    $query .= " ORDER BY p.created_at DESC;";

    $podcasts = $db->query($query, $params)->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500); // Or handle the error gracefully
}

require "views/pages/podcasts/manage_view.php";













// <?php

// use core\App;
// use core\Database;

// $db = App::resolve(Database::class);


// $page = "charity_campaigns_manage" ;




// $searchTerm = $_GET['search'] ?? ''; // الحصول على كلمة البحث من الرابط أو تكون فارغة
// $searchTerm = $db->real_escape_string($searchTerm); // حماية من حقن SQL

// $sql = "SELECT
//             podcast_id,
//             title,
//             description
//         FROM
//             podcasts
//         WHERE
//             MATCH(title, description) AGAINST('$searchTerm' IN NATURAL LANGUAGE MODE)";

// $result = $db->query($sql);

// // ... باقي كود PHP للتعامل مع النتائج والترقيم
// ?>
// <?php
// // اتصال بقاعدة البيانات (افترض أن لديك كائن اتصال $db)
// $db = new mysqli("localhost", "your_username", "your_password", "whisprly");

// if ($db->connect_error) {
//     die("فشل الاتصال بقاعدة البيانات: " . $db->connect_error);
// }

// $searchTerm = $_GET['search'] ?? '';
// $searchTerm = $db->real_escape_string($searchTerm);

// $resultsPerPage = 10; // عدد العناصر في كل صفحة
// $page = $_GET['page'] ?? 1; // رقم الصفحة الحالي (افتراضيًا 1)
// $offset = ($page - 1) * $resultsPerPage; // حساب الإزاحة

// // بناء استعلام SQL مع البحث النصي والترقيم
// $sql = "SELECT
//             podcast_id,
//             title,
//             description
//         FROM
//             podcasts
//         WHERE
//             MATCH(title, description) AGAINST('$searchTerm' IN NATURAL LANGUAGE MODE)
//         LIMIT $resultsPerPage OFFSET $offset";

// $result = $db->query($sql);
// $podcasts = [];
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $podcasts[] = $row;
//     }
// }

// // استعلام لحساب العدد الكلي للنتائج المطابقة للبحث (بدون LIMIT)
// $totalResultsSql = "SELECT COUNT(*) AS total
//                     FROM podcasts
//                     WHERE MATCH(title, description) AGAINST('$searchTerm' IN NATURAL LANGUAGE MODE)";
// $totalResult = $db->query($totalResultsSql);
// $totalRows = $totalResult->fetch_assoc()['total'];
// $totalPages = ceil($totalRows / $resultsPerPage);

// // عرض البودكاست
// if (!empty($podcasts)) {
//     echo "<ul>";
//     foreach ($podcasts as $podcast) {
//         echo "<li><h3>" . htmlspecialchars($podcast['title']) . "</h3>";
//         echo "<p>" . htmlspecialchars($podcast['description']) . "</p></li>";
//     }
//     echo "</ul>";

//     // إنشاء روابط الترقيم
//     echo "<div class='pagination'>";
//     if ($page > 1) {
//         echo "<a href='?search=" . urlencode($searchTerm) . "&page=" . ($page - 1) . "'>السابق</a> ";
//     }

//     for ($i = 1; $i <= $totalPages; $i++) {
//         $activeClass = ($i == $page) ? 'active' : '';
//         echo "<a class='$activeClass' href='?search=" . urlencode($searchTerm) . "&page=$i'>$i</a> ";
//     }

//     if ($page < $totalPages) {
//         echo "<a href='?search=" . urlencode($searchTerm) . "&page=" . ($page + 1) . "'>التالي</a>";
//     }
//     echo "</div>";

// } else {
//     echo "<p>لا توجد نتائج بحث مطابقة.</p>";
// }

// $db->close();
















// $heading = "All My tests";

// try {
//     // Fetch categories for the dropdown
//     $categories = $db->query("SELECT category_id, name FROM categories")->fetchAll();

//     // Get search and filter inputs
//     $search = $_GET['search'] ?? '';
//     $filter = $_Get['filter'] ?? 'all';

//     // Base Query
//     $query = "
//         SELECT 
//             g.campaign_id, 
//             g.category_id, 
//             g.partner_id, 
//             COALESCE(SUM(u.cost), 0) AS collected_money, 
//             g.name, 
//             g.photo, 
//             g.short_description, 
//             g.full_description, 
//             g.cost, 
//             g.state, 
//             g.start_at, 
//             g.stop_at, 
//             g.end_at
//         FROM campaigns g  
//         LEFT JOIN users_donate_campaigns u ON g.campaign_id = u.campaign_id 
//         WHERE 1=1 
//     ";

//     $params = [];

//     // 🔎 Add Search Filter
//     if (!empty($search)) {
//         $query .= " AND MATCH(g.name, g.short_description, g.full_description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
//         $params['search'] = $search;
//     }

//     // 🎯 Add Category Filter (if a valid category is selected)
//     if ($filter !== 'all' && is_numeric($filter)) {
//         $query .= " AND g.category_id = :category_id";
//         $params['category_id'] = $filter;
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




require "views/pages/charity_campaigns/manage_view.php";
