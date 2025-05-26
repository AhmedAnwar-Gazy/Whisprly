<?php
$heading = "Edit Book";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// Get the book_id from the URL
$bookId = $_GET['book_id'] ?? null;

 if (!$bookId || !is_numeric($bookId)) {
    abort(400); // Bad Request: Invalid or missing book ID
}

try {
    // Fetch the book details
    $book = $db->query("
        SELECT
            category_id,
            name,
            description,
            created_at,
        FROM categories
        WHERE category_id = :category_id
    ", [
        'category_id' => $bookId
    ])->fetch();

    if (!$book) {
        abort(404); // Book not found
    }

   // Authorization: Ensure the current user uploaded this book
     if ($book['uploaded_by'] !== $currentUserId) {
         abort(403); // Forbidden: User does not own this book
    }

    // Fetch a list of all podcasts to populate the "linked_podcast_id" dropdown (optional linking)
    $podcasts = $db->query("SELECT podcast_id, title FROM podcasts ORDER BY title")->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}


require "views/pages/book/edit_view.php";








