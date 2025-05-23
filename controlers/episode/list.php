<?php
$heading = "Episodes";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Get the podcast_id from the URL, or default to null/handle error
$podcastId = $_GET['podcast_id'] ?? null;


 if (!$podcastId || !is_numeric($podcastId)) {
    abort(400); // Bad Request: Invalid or missing book ID
}



// Fetch episodes for a specific podcast
$episodes = $db->query("SELECT
                            episode_id,
                            podcast_id,
                            title,
                            audio_file,
                            duration,
                            release_date
                        FROM episodes
                        WHERE podcast_id = :podcast_id
                        ORDER BY release_date DESC", [
                            'podcast_id' => $podcastId
                        ])->fetchAll();

// Optionally, fetch podcast title for the heading
$podcast = $db->query("SELECT title FROM podcasts WHERE podcast_id = :podcast_id", [
    'podcast_id' => $podcastId
])->fetch();

if ($podcast) {
    $heading = "Episodes for: " . htmlspecialchars($podcast['title']);
} else {
    $heading = "Episodes (Podcast not found)";
}


require "views/pages/episode/list_view.php";












