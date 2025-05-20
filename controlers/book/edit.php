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
            book_id,
            title,
            description,
            pdf_file,
            topic,
            uploaded_by,
            linked_podcast_id
        FROM books
        WHERE book_id = :book_id
    ", [
        'book_id' => $bookId
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









// <?php
// $heading = "Create ";

// use core\App;
// use core\Database;


// $db = App::resolve(Database::class);


// try {
//     $categories = $db->query(
//         "SELECT * FROM categories"
//     )->fetchAll(); // Fetch all rows from the query result 
//     $partners = $db->query(
//         "SELECT * FROM partners"
//     )->fetchAll(); // Fetch all rows from the query result
//     $book = $db->query("
//     SELECT
//     b.book_id,
//     b.title AS book_title,
//     u.name AS uploader_name,
//     b.topic,
//     p.title AS linked_podcast
// FROM
//     books b
// JOIN
//     users u ON b.uploaded_by = u.user_id
// LEFT JOIN
//     podcasts p ON b.linked_podcast_id = :p.podcast_id", [
//         'p.podcast_id' => $_GET['podcast_id'],
//     ])->findOrFail();
// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }


// require "views/pages/charity_campaigns/edit_view.php";
