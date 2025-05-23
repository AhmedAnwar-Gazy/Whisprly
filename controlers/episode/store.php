<?php
$heading = "Add New Episode";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Validate Podcast ID
if (empty($_POST['podcast_id'])) {
    $errors['podcast_id'] = "Podcast ID is required.";
} elseif (!Validator::number($_POST['podcast_id'] ?? '', 1)) {
    $errors['podcast_id'] = "Invalid Podcast ID.";
} else {
    // Verify that the current user owns this podcast for security
    $podcastId = (int)$_POST['podcast_id'];
    $podcastOwner = $db->query("SELECT created_by FROM podcasts WHERE podcast_id = :podcast_id", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcastOwner || $podcastOwner['created_by'] !== $currentUserId) {
        $errors['podcast_id'] = "You do not have permission to add episodes to this podcast.";
    }
}

// 2. Validate Episode Title
if (empty($_POST['title'])) {
    $errors['title'] = "Episode title is required.";
} elseif (!Validator::string($_POST['title'] ?? '', 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// 3. Validate Audio File (assuming it's a URL or file path)
// For file uploads, you'd need a separate file upload handler
if (empty($_POST['audio_file'])) {
    $errors['audio_file'] = "Audio file URL/path is required.";
} elseif (!Validator::string($_POST['audio_file'] ?? '', 5, 255)) {
    $errors['audio_file'] = "Invalid audio file path.";
}

// 4. Validate Duration
if (empty($_POST['duration'])) {
    $errors['duration'] = "Duration (in seconds) is required.";
} elseif (!Validator::number($_POST['duration'] ?? '', 1, 86400)) { // Max 24 hours in seconds
    $errors['duration'] = "Duration must be a positive number of seconds (max 86400).";
}

// 5. Validate Release Date
if (empty($_POST['release_date'])) {
    $errors['release_date'] = "Release date is required.";
} elseif (!Validator::string($_POST['release_date'] ?? '')) { // Assuming a Validator::date method
    $errors['release_date'] = "Invalid date format.";
}


// If there are validation errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

try {
    $db->query(
        "INSERT INTO episodes (
            podcast_id,
            title,
            audio_file,
            duration,
            release_date
        ) VALUES (
            :podcast_id,
            :title,
            :audio_file,
            :duration,
            :release_date
        )",
        [
            'podcast_id' => $podcastId, // Already validated and cast to int
            'title' => htmlspecialchars($_POST['title']),
            'audio_file' => htmlspecialchars($_POST['audio_file']),
            'duration' => (int)$_POST['duration'],
            'release_date' => $_POST['release_date']
        ]
    );

    // Redirect to the podcast's manage episodes page
    header("Location: /podcast/episode/manage?podcast_id=" . $podcastId);
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}











