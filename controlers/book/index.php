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
    $allTopics = $db->query("SELECT DISTINCT topic FROM books ORDER BY topic ASC")->fetchAll();

    // --- 2. Construct the Base SQL Query ---

    $query = "
        SELECT
            b.book_id,
            b.title,
            b.description,
            b.pdf_file,
            b.created_at,
            u.name AS uploader_name,
            p.title AS linked_podcast_title, 
            p.podcast_id AS linked_podcast_id
        FROM books b
        JOIN users u ON b.uploaded_by = u.user_id
        LEFT JOIN podcasts p ON b.linked_podcast_id = p.podcast_id
        WHERE 1=1
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


require "views/pages/book/index_view.php";




