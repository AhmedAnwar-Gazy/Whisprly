<?php
$heading = "Podcast Details";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Get the podcast_id from the URL
$podcastId = $_GET['podcast_id'] ?? null;

 if (!$podcastId || !is_numeric($podcastId)) {
    abort(400); // Bad Request: Invalid or missing book ID
}


try {
    // Fetch podcast details
    $podcast = $db->query("
        SELECT
            p.podcast_id,
            p.title,
            p.description,
            p.cover_image,
            p.created_at,
            u.name AS creator_name
        FROM podcasts p
        JOIN users u ON p.created_by = u.user_id
        WHERE p.podcast_id = :podcast_id AND p.status = 'published'
    ", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcast) {
        abort(404); // Podcast not found or not published
    }

    $heading = htmlspecialchars($podcast['title']);

    // Fetch episodes for this podcast
    $episodes = $db->query("
        SELECT
            episode_id,
            title,
            audio_file,
            duration,
            release_date
        FROM episodes
        WHERE podcast_id = :podcast_id
        ORDER BY release_date DESC
    ", [
        'podcast_id' => $podcastId
    ])->fetchAll();

    $books = $db->query("
        SELECT
            b.*
        FROM books b
        left JOIN book_categories bc  ON bc.book_id = b.book_id
        WHERE bc.category_id = 1 ;
")->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

 //dd($books);

require "views/pages/podcast/show_view.php";












