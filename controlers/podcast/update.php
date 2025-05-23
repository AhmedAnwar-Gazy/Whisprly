<?php
$heading = "Update Podcast";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Get the podcast_id from the POST data
$podcastId = $_POST['podcast_id'] ?? null;

if (!$podcastId || !Validator::number($podcastId, 1)) {
    $errors['podcast_id'] = "Invalid podcast ID provided.";
} else {
    // Verify the podcast exists and belongs to the current user
    $existingPodcast = $db->query("SELECT created_by FROM podcasts WHERE podcast_id = :id", [
        'id' => $podcastId
    ])->fetch();

    if (!$existingPodcast) {
        abort(404); // Podcast not found
    }
    if ($existingPodcast['created_by'] !== $currentUserId) {
        abort(403); // Forbidden: User does not own this podcast
    }
}

// 2. Validate incoming data (only validate if provided, respecting COALESCE)

// Validate Podcast Title
if (isset($_POST['title']) && !Validator::string($_POST['title'], 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// Validate Podcast Description
if (isset($_POST['description']) && !Validator::string($_POST['description'], 20, 65535)) {
    $errors['description'] = "Description must be at least 20 characters.";
}

// Validate Category
if (isset($_POST['category']) && !Validator::string($_POST['category'], 2, 100)) {
    $errors['category'] = "Category must be between 2 and 100 characters.";
}

// Validate Cover Image (assuming it's a URL or file path)
// If file upload, integrate your image_loader.php
if (isset($_POST['cover_image']) && !Validator::string($_POST['cover_image'], 5, 255)) {
    $errors['cover_image'] = "Invalid cover image path.";
}

//If an admin can change status, you might validate that here

if (isset($_POST['status']) && !in_array($_POST['status'], ['published', 'pending', 'rejected'])) {
    $errors['status'] = "Invalid status value.";
}


// If there are validation errors, redirect back to the edit form
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    // You might want to redirect with the podcast_id in the URL
    header("Location: /podcasts/edit?id=" . $podcastId);
    exit();
}

try {
    // Handle image upload if a new file is provided
    $coverImagePath = null;
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        // Assume image_loader.php handles saving the file and returns its path
        require('controllers/parts/image_loader.php'); // Or wherever your image upload logic is
        $coverImagePath = $filenamenew ?? null; // Adjust variable name as per your loader
    } elseif (isset($_POST['cover_image'])) {
        $coverImagePath = htmlspecialchars($_POST['cover_image']); // If path is submitted directly
    }

    $db->query(
        "UPDATE podcasts
        SET
            title = COALESCE(:title, title),
            description = COALESCE(:description, description),
            category = COALESCE(:category, category),
            cover_image = COALESCE(:cover_image, cover_image),
            status = COALESCE(:status, status)
        WHERE podcast_id = :podcast_id",
        [
            'title' => $_POST['title'] ? htmlspecialchars($_POST['title']) : null,
            'description' => $_POST['description'] ? htmlspecialchars($_POST['description']) : null,
            'category' => $_POST['category'] ? htmlspecialchars($_POST['category']) : null,
            'cover_image' => $coverImagePath, // Use the new path or null
            'status' => $_POST['status'] ?? null, // Allow status update if provided
            'podcast_id' => $podcastId
        ]
    );

    // Redirect to the manage podcasts page or the podcast's show page
    header("Location: /podcast/manage");
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}






