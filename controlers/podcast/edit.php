<?php
$heading = "Edit Podcast";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// Get the podcast_id from the URL
$podcastId = $_GET['podcast_id'] ?? null;

if (!$podcastId || !is_numeric($podcastId)) {
    abort(400); // Bad Request: Invalid or missing podcast ID
}

try {
    // Fetch the podcast details
    $podcast = $db->query("
        SELECT
            podcast_id,
            title,
            description,
            category,
            cover_image,
            created_by,
            status
        FROM podcasts
        WHERE podcast_id = :podcast_id
    ", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcast) {
        abort(404); // Podcast not found
    }

    // Authorization: Ensure the current user created this podcast
    if ($podcast['created_by'] !== $currentUserId) {
        abort(403); // Forbidden: User does not own this podcast
    }


} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}


require "views/pages/podcast/edit_view.php";







