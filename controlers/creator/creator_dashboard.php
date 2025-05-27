<?php
$heading = "Creator Dashboard";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// --- Authorization Check ---
// Assume $_SESSION['user']['user_id'] and $_SESSION['user']['role'] are set after login
$currentUserId = $_SESSION['user']['user_id'] ?? null;
$currentUserRole = $_SESSION['user']['role'] ?? 'listener'; // Default to listener if not set

// Only allow 'creator' or 'admin' roles to access this dashboard
// if (!$currentUserId || ($currentUserRole !== 'creator' && $currentUserRole !== 'admin')) {
//     abort(403); // Forbidden: User not logged in or not authorized
// }
// --- End Authorization Check ---

try {
    // 1. Get total podcasts created by this user
    $totalPodcasts = $db->query("
        SELECT COUNT(podcast_id) AS count
        FROM podcasts
        WHERE created_by = :user_id
    ", [
        'user_id' => $currentUserId
    ])->fetch()['count'];

    // 2. Get total podcasts in 'pending' status by this user
    $pendingPodcasts = $db->query("
        SELECT COUNT(podcast_id) AS count
        FROM podcasts
        WHERE created_by = :user_id AND status = 'pending'
    ", [
        'user_id' => $currentUserId
    ])->fetch()['count'];

    // 3. Get total episodes across all podcasts created by this user
    $totalEpisodes = $db->query("
        SELECT COUNT(e.episode_id) AS count
        FROM episodes e
        JOIN podcasts p ON e.podcast_id = p.podcast_id
        WHERE p.created_by = :user_id
    ", [
        'user_id' => $currentUserId
    ])->fetch()['count'];

    // 4. Get total books uploaded by this user
    $totalBooks = $db->query("
        SELECT COUNT(book_id) AS count
        FROM books
        WHERE uploaded_by = :user_id
    ", [
        'user_id' => $currentUserId
    ])->fetch()['count'];
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500); // Internal Server Error
}

require "views/pages/creator/dashboard_view.php";





















// <?php

// use core\App;
// use core\Database;

// $db = App::resolve(Database::class);


// $page = "charity_campaigns_manage" ;

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




// require "views/pages/charity_campaigns/manage_view.php";
