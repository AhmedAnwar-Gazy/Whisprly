<?php
$heading = "Upload New Book";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Validate Book Title
if (empty($_POST['title'])) {
    $errors['title'] = "Book title is required.";
} elseif (!Validator::string($_POST['title'] ?? '', 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// 2. Validate Book Description
// Description is optional, but if present, validate length
if (!empty($_POST['description']) && !Validator::string($_POST['description'] ?? '', 10, 65535)) {
    $errors['description'] = "Description must be at least 10 characters.";
}

// 3. Validate PDF File (assuming it's a URL or file path)
// For file uploads, you'd need a separate file upload handler
if (empty($_POST['pdf_file'])) {
    $errors['pdf_file'] = "PDF file URL/path is required.";
} elseif (!Validator::string($_POST['pdf_file'] ?? '', 5, 255)) {
    $errors['pdf_file'] = "Invalid PDF file path.";
}

// 4. Validate Topic
if (empty($_POST['topic'])) {
    $errors['topic'] = "Topic is required.";
} elseif (!Validator::string($_POST['topic'] ?? '', 2, 100)) {
    $errors['topic'] = "Topic must be between 2 and 100 characters.";
}

// 5. Validate Linked Podcast ID (Optional)
$linkedPodcastId = null;
if (!empty($_POST['linked_podcast_id'])) {
    if (!Validator::number($_POST['linked_podcast_id'] ?? '', 1)) {
        $errors['linked_podcast_id'] = "Invalid Linked Podcast ID.";
    } else {
        $linkedPodcastId = (int)$_POST['linked_podcast_id'];
        // Optionally, check if this podcast_id actually exists
        $podcastExists = $db->query("SELECT podcast_id FROM podcasts WHERE podcast_id = :id", [
            'id' => $linkedPodcastId
        ])->fetch();
        if (!$podcastExists) {
            $errors['linked_podcast_id'] = "Linked podcast does not exist.";
            $linkedPodcastId = null; // Reset if invalid
        }
    }
}


// If there are validation errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

try {
    $db->query(
        "INSERT INTO books (
            title,
            description,
            pdf_file,
            topic,
            uploaded_by,
            linked_podcast_id
        ) VALUES (
            :title,
            :description,
            :pdf_file,
            :topic,
            :uploaded_by,
            :linked_podcast_id
        )",
        [
            'title' => htmlspecialchars($_POST['title']),
            'description' => htmlspecialchars($_POST['description'] ?? ''), // Use null if empty
            'pdf_file' => htmlspecialchars($_POST['pdf_file']),
            'topic' => htmlspecialchars($_POST['topic']),
            'uploaded_by' => $currentUserId,
            'linked_podcast_id' => $linkedPodcastId // Will be null if not provided or invalid
        ]
    );

    // Redirect to a success page or the manage books page
    header("Location: /book/manage");
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}











