<?php
$heading = "All Books";

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
    $allTopics = $db->query("SELECT name FROM categories")->fetchAll();

    // --- 2. Construct the Base SQL Query ---

    $query = "
        SELECT
            * 
        FROM categories
    ";

    // --- 6. Execute the Query ---
    $books = $db->query($query)->fetchAll();

} catch (PDOException $e) {
    // Log any database errors for debugging
    error_log($e->getMessage());
    // Abort and show a 500 error page to the user
    abort(500); // Assumes your application has an 'abort' function for error handling
}
//dd($books);

require "views/pages/book/index_view.php";




