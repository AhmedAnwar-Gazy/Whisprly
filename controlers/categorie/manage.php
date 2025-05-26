<?php
$heading = "Manage My Books";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Current logged-in user

try {
    $search = $_GET['search'] ?? '';
    $topicFilter = $_GET['topic'] ?? 'all';

    // Optionally fetch distinct topics for a filter dropdown
    $topics = $db->query("SELECT DISTINCT topic FROM books WHERE uploaded_by = :current_user_id ORDER BY topic", [
        'current_user_id' => $currentUserId
    ])->fetchAll();

    $query = "
        SELECT
        *
        FROM categories
    ";

    $books = $db->query($query)->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

require "views/pages/book/manage_view.php";





