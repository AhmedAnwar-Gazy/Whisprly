<?php
$heading = "Update Episode";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Get the episode_id and podcast_id from POST
$episodeId = $_POST['episode_id'] ?? null;
$podcastId = $_POST['podcast_id'] ?? null; // Also needed for authorization and redirect

if (!$episodeId || !Validator::number($episodeId, 1)) {
    $errors['episode_id'] = "Invalid episode ID provided.";
}
if (!$podcastId || !Validator::number($podcastId, 1)) {
    $errors['podcast_id'] = "Invalid podcast ID provided.";
}

// Perform authorization check
if (empty($errors)) {
    $podcastOwner = $db->query("SELECT created_by FROM podcasts WHERE podcast_id = :podcast_id", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcastOwner || $podcastOwner['created_by'] !== $currentUserId) {
        abort(403); // Forbidden: User does not own this podcast
    }

    // Also check if the episode actually belongs to the specified podcast
    $episodeCheck = $db->query("SELECT episode_id FROM episodes WHERE episode_id = :episode_id AND podcast_id = :podcast_id", [
        'episode_id' => $episodeId,
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$episodeCheck) {
        abort(404); // Episode not found for this podcast
    }
}

// 2. Validate incoming data
// Validate Episode Title
if (isset($_POST['title']) && !Validator::string($_POST['title'], 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// Validate Audio File
if (isset($_POST['audio_file']) && !Validator::string($_POST['audio_file'], 5, 255)) {
    $errors['audio_file'] = "Invalid audio file path.";
}

// Validate Duration
if (isset($_POST['duration'])) {
    if (!Validator::number($_POST['duration'], 1, 86400)) {
        $errors['duration'] = "Duration must be a positive number of seconds (max 86400).";
    }
}

// Validate Release Date
if (isset($_POST['release_date'])) {
    $date = DateTime::createFromFormat('Y-m-d', $_POST['release_date']);
    if ($date === false || $date->format('Y-m-d') !== $_POST['release_date']) {
        $errors['release_date'] = "Invalid date format. Please use YYYY-MM-DD.";
    }
}


// If there are validation errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: /episodes/edit?episode_id=" . $episodeId . "&podcast_id=" . $podcastId);
    exit();
}

try {
    $db->query(
        "UPDATE episodes
        SET
            title = COALESCE(:title, title),
            audio_file = COALESCE(:audio_file, audio_file),
            duration = COALESCE(:duration, duration),
            release_date = COALESCE(:release_date, release_date)
        WHERE episode_id = :episode_id AND podcast_id = :podcast_id",
        [
            'title' => $_POST['title'] ? htmlspecialchars($_POST['title']) : null,
            'audio_file' => $_POST['audio_file'] ? htmlspecialchars($_POST['audio_file']) : null,
            'duration' => $_POST['duration'] ? (int)$_POST['duration'] : null,
            'release_date' => $_POST['release_date'] ?? null,
            'episode_id' => $episodeId,
            'podcast_id' => $podcastId
        ]
    );

    // Redirect to the podcast's manage episodes page
    header("Location: /podcast/episode/manage?podcast_id=" . $podcastId);
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}




















