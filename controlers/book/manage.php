<?php
$heading = "Manage My Books";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Current logged-in user

try {
    $search = $_GET['search'] ?? '';
    $topicFilter = $_GET['topic'] ?? 'all';
    $allCategories = $db->query("SELECT * FROM categories")->fetchAll();
    // Optionally fetch distinct topics for a filter dropdown
    $topics = $db->query("SELECT DISTINCT topic FROM books WHERE uploaded_by = :current_user_id ORDER BY topic", [
        'current_user_id' => $currentUserId
    ])->fetchAll();

    $query = "
        SELECT
            book_id,
            title,
            description,
            pdf_file,
            topic,
            uploaded_by,
            linked_podcast_id,
            created_at
        FROM books
        WHERE uploaded_by = :current_user_id
    ";

    $params = [
        'current_user_id' => $currentUserId
    ];

    // Add Search Filter
    if (!empty($search)) {
        $query .= " AND MATCH(title, description, topic) AGAINST (:search IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION)";
        $params['search'] = $search;
    }

    // Add Topic Filter
    if ($topicFilter !== 'all' && !empty($topicFilter)) {
        $query .= " AND topic = :topic_filter";
        $params['topic_filter'] = $topicFilter;
    }

    // Finalize Query
    $query .= " ORDER BY created_at DESC;";

    $books = $db->query($query, $params)->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

require "views/pages/book/manage_view.php";





