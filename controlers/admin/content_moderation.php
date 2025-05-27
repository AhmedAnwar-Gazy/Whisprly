<?php
$heading = "Content Moderation";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// --- Authorization Check (Admin Only) ---
// Assume $_SESSION['user']['role'] holds the user's role
$currentUserRole = $_SESSION['user']['role'] ?? 'listener';
// if ($currentUserRole !== 'admin') {
//     abort(403); // Forbidden: Only admins can access this page
// }
// --- End Authorization Check ---

try {
    // Get search and filter inputs
    $search = $_GET['search'] ?? '';
    // Filter by content type: 'all', 'podcasts', 'books'
    $contentTypeFilter = $_GET['type'] ?? 'all';

    $pendingPodcasts = [];
    $pendingBooks = [];

    // --- Fetch Pending Podcasts ---
    $podcastQuery = "
        SELECT
            p.podcast_id,
            p.title,
            p.description,
            p.created_at,
            u.name AS creator_name,
            u.user_id AS creator_id
        FROM podcasts p
        JOIN users u ON p.created_by = u.user_id
        WHERE p.status = 'pending'
    ";
    $podcastParams = [];

    if (!empty($search)) {
        $podcastQuery .= " AND MATCH(p.title, p.description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
        $podcastParams['search'] = $search;
    }
    $podcastQuery .= " ORDER BY p.created_at ASC;";

    if ($contentTypeFilter === 'all' || $contentTypeFilter === 'podcasts') {
        $pendingPodcasts = $db->query($podcastQuery, $podcastParams)->fetchAll();
    }

    // --- Fetch Pending Books ---
    $bookQuery = "
      SELECT books.* FROM books LEFT JOIN book_categories on books.book_id = book_categories.book_id 
        WHERE 1=1   
    ";
    $bookParams = [];

    if (!empty($search)) {
        $bookQuery .= " AND MATCH(b.title, b.description, b.topic) AGAINST (:search IN NATURAL LANGUAGE MODE)";
        $bookParams['search'] = $search;
    }
    $bookQuery .= " ORDER BY books.created_at ASC;";

    // NOTE: Your 'books' table does not have a 'status' column.
    // If books also require moderation (e.g., 'pending', 'approved', 'rejected'),
    // you should add a `status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending'`
    // column to the `books` table. For now, this query fetches all books.
    // If you add the status column, change `b.uploaded_by IS NOT NULL` to `b.status = 'pending'`.

    if ($contentTypeFilter === 'all' || $contentTypeFilter === 'books') {
        $pendingBooks = $db->query($bookQuery, $bookParams)->fetchAll();
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500); // Internal Server Error
}

require "views/pages/admin/content_moderation_view.php";











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




// require "views/pages/admin/manage_view.php";
