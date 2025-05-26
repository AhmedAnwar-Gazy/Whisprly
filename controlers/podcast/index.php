

<?php
//dd($categoryFilter);
// Set the heading for the page
$heading = "All Podcasts";
//dd($_GET['filter']);
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
    $allCategories = $db->query("SELECT * FROM categories")->fetchAll();

    // --- 2. Construct the Base SQL Query ---
    $query = "
        SELECT
            p.podcast_id,
            p.title,
            p.description,
            p.cover_image,
            p.created_at,
            u.name AS creator_name
        FROM podcasts p
        JOIN users u ON p.created_by = u.user_id
        LEFT JOIN episodes e ON p.podcast_id = e.podcast_id
        LEFT JOIN podcast_categories on p.podcast_id = podcast_categories.podcast_id 
        WHERE p.status = 'published'
    ";

    //Initialize an array to hold parameters for the prepared statement
    $params = [];

    // --- 3. Add Full-Text Search Filter ---
    // If a search term is provided, add the MATCH() AGAINST() clause.
    // IMPORTANT: For this to work efficiently, you MUST have a FULLTEXT index on
    // 'title' and 'description' columns in your 'podcasts' table.
    // Example SQL to add index: ALTER TABLE podcasts ADD FULLTEXT(title, description);
    if (!empty($search)) {
        ///dd("hi");
        $query .= " AND MATCH(p.title, p.description) AGAINST (:search IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION)";
        $params['search'] = $search; // Bind the search term parameter
    }

    // --- 4. Add Category Filtering ---
    // If a specific category is selected (not 'all'), add the category filter.
    
    if ($categoryFilter !== 'all' && !empty($categoryFilter)) {
        $query .= " AND  category_id = :category_filter";
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
