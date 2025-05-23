<?php
$heading = "Episode Details";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Get the episode_id from the URL
$episodeId = $_GET['episode_id'] ?? null;


 if (!$episodeId || !is_numeric($episodeId)) {
    abort(400); // Bad Request: Invalid or missing book ID
}
if (!$episodeId) {
    echo "Error: Episode ID not specified.";
    exit();
}

try {
    // Fetch episode details
    $episode = $db->query("
        SELECT
            e.episode_id,
            e.podcast_id,
            e.title,
            e.audio_file,
            e.duration,
            e.release_date,
            p.title AS podcast_title,
            u.name AS creator_name
        FROM episodes e
        JOIN podcasts p ON e.podcast_id = p.podcast_id
        JOIN users u ON p.created_by = u.user_id
        WHERE e.episode_id = :episode_id AND p.status = 'published'
    ", [
        'episode_id' => $episodeId
    ])->fetch();

    if (!$episode) {
        abort(404); // Episode not found or associated podcast not published
    }

    $heading = htmlspecialchars($episode['title']);

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}
dd($episode);
require "views/pages/episode/show_view.php";
















