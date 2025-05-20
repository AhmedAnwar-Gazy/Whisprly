<?php
// Set the heading for the page
$heading = "All Books";

// Include necessary core classes
use core\App;
use core\Database;

// Resolve the Database instance from the application container
$db = App::resolve(Database::class);

try {
    // Get the search term from the URL query parameter 'search'. Default to empty string.
    $search = $_GET['search'] ?? '';
    // Get the topic filter from the URL query parameter 'topic'. Default to 'all'.
    $topicFilter = $_GET['topic'] ?? 'all';
    // Get the sorting order for 'created_at'. Default to 'desc' (newest first).
    $sortByCreatedAt = $_GET['sort_by_created_at'] ?? 'desc'; // 'asc' for oldest first, 'desc' for newest first

    // --- 1. Fetch all distinct topics for the filter dropdown ---
    // This allows you to populate a <select> dropdown in your HTML view.
    $allTopics = $db->query("SELECT DISTINCT topic FROM books ORDER BY topic ASC")->fetchAll();

    // --- 2. Construct the Base SQL Query ---
    // This query selects essential book information, joins with users for the uploader's name,
    // and left joins with podcasts if the book is linked to one.
    $query = "
        SELECT
            b.book_id,
            b.title,
            b.description,
            b.pdf_file,
            b.topic,
            b.created_at,
            u.name AS uploader_name,
            p.title AS linked_podcast_title, -- Title of the linked podcast
            p.podcast_id AS linked_podcast_id
        FROM books b
        JOIN users u ON b.uploaded_by = u.user_id
        LEFT JOIN podcasts p ON b.linked_podcast_id = p.podcast_id
        WHERE 1=1 -- A placeholder for easy addition of WHERE clauses
    ";

    // Initialize an array to hold parameters for the prepared statement
    $params = [];

    // --- 3. Add Full-Text Search Filter ---
    // If a search term is provided, add the MATCH() AGAINST() clause.
    // IMPORTANT: For this to work efficiently, you MUST have a FULLTEXT index on
    // 'title', 'description', and 'topic' columns in your 'books' table.
    // Example SQL to add index: ALTER TABLE books ADD FULLTEXT(title, description, topic);
    if (!empty($search)) {
        $query .= " AND MATCH(b.title, b.description, b.topic) AGAINST (:search IN NATURAL LANGUAGE MODE)";
        $params['search'] = $search; // Bind the search term parameter
    }

    // --- 4. Add Topic Filtering ---
    // If a specific topic is selected (not 'all'), add the topic filter.
    if ($topicFilter !== 'all' && !empty($topicFilter)) {
        $query .= " AND b.topic = :topic_filter";
        $params['topic_filter'] = $topicFilter; // Bind the topic filter parameter
    }

    // --- 5. Finalize Query with Ordering ---
    // Add ordering by 'created_at' based on the 'sort_by_created_at' parameter
    if ($sortByCreatedAt === 'asc') {
        $query .= " ORDER BY b.created_at ASC;";
    } else {
        // Default to descending order (newest first)
        $query .= " ORDER BY b.created_at DESC;";
    }

    // --- 6. Execute the Query ---
    $books = $db->query($query, $params)->fetchAll();

} catch (PDOException $e) {
    // Log any database errors for debugging
    error_log($e->getMessage());
    // Abort and show a 500 error page to the user
    abort(500); // Assumes your application has an 'abort' function for error handling
}

// --- 7. Render the View ---
// This line includes the HTML view file, passing all the fetched data and filter states
// to be rendered in the browser.
require "views/public/books/index_view.php";







// <?php

// use core\App;
// use core\Database;

// $db = App::resolve(Database::class);

// $books=$db->query(" select * from books;")->fetchAll();

// $page = "books_index";
// start_page:
// $page_book_ids = [];
// $heading = "All Books";
// if(!isset($_GET['page_number'])) $_GET['page_number'] = 1;

// $search = $_GET['search'] ?? '';
// $filter_topic = $_GET['filter_topic'] ?? 'all';

// if(!isset($_SESSION['books_count_all'])){
//     $_SESSION['books_count_all'] = $db->query(
//         "SELECT count(*) as count FROM books;"
//     )->fetchAll()[0]['count'];
// } else {
//     $books_current_count = $db->query( "SELECT count(*) as count FROM books;")->fetchAll()[0]['count'];
//     if($books_current_count != $_SESSION['books_count_all']){
//         if($books_current_count > $_SESSION['books_count_all']){
//             if(count($_SESSION['books_pages'][$_GET['page_number']] ?? []) < 10){
//                 $_SESSION['books_pages'][$_GET['page_number']] = [];
//             } else {
//                 $latest_page = intval($_SESSION['books_count_all']/10 + 1);
//                 $_SESSION['books_pages'][$latest_page] = [];
//             }
//         } else {
//             $_SESSION['books_pages'] = [];
//         }
//         $_SESSION['books_count_all'] = $books_current_count;
//         goto start_page;
//     }
// }

// $pages_count['books'] = ceil($_SESSION['books_count_all'] / 10);
// if ($pages_count['books'] == 0) $pages_count['books'] = 1; // Ensure at least one page
// $has_next = $_GET['page_number'] < $pages_count['books'];

// $filtered = (!empty($search) || ($filter_topic !== 'all'));

// try {
//     // Get unique topics for filtering
//     $topics = $db->query("SELECT DISTINCT topic FROM books WHERE topic IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);

//     $query = "SELECT * FROM books WHERE 1=1"; // Start with a true condition
//     $params = [];

//     if ($filtered) {
//         if (!empty($search)) {
//             $query .= " AND MATCH(title, description, topic) AGAINST (:search IN NATURAL LANGUAGE MODE)";
//             $params[':search'] = $search;
//         }
//         if ($filter_topic !== 'all') {
//             $query .= " AND topic = :topic";
//             $params[':topic'] = $filter_topic;
//         }
//         $books = $db->query($query, $params)->fetchAll();
//     } elseif(isset($_SESSION['books_pages']) && isset($_SESSION['books_pages'][$_GET['page_number']]) && count($_SESSION['books_pages'][$_GET['page_number']]) > 0){
//         $ids = implode(",", $_SESSION['books_pages'][$_GET['page_number']]);
//         $query .= " AND book_id IN ({$ids}) ORDER BY book_id;";
//         $books = $db->query($query)->fetchAll();
//     } else {
//         if(isset($_SESSION['books_pages']) && !empty($_SESSION['books_pages'])){
//             $excluded_ids = [];
//             foreach($_SESSION['books_pages'] as $page_ids){
//                 if(is_array($page_ids)) {
//                     $excluded_ids = array_merge($excluded_ids, $page_ids);
//                 }
//             }
//             if (!empty($excluded_ids)) {
//                 $query .= " AND book_id NOT IN (".implode(",", $excluded_ids).")";
//             }
//         }
//         $query .= " ORDER BY created_at DESC LIMIT 10 OFFSET :offset;";
//         $params[':offset'] = ($_GET['page_number'] - 1) * 10;
//         $books = $db->query($query, $params)->fetchAll();

//         foreach($books as $book){
//             $page_book_ids[] = $book['book_id'];
//         }
//         $_SESSION['books_pages'][$_GET['page_number']] = $page_book_ids;
//     }

// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }

require "views/pages/book/index_view.php";





















// <?php

// use core\App;
// use core\Database;
// use models\Campaign;

// $db = App::resolve(Database::class);
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
//         GROUP BY g.campaign_id 
//         HAVING g.state ='active' 
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
