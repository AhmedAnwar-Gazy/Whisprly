<?php
$heading = "Create New Podcast";

use core\App;
use core\Database;
//use core\Validator; // Assuming you have this Validator class

$db = App::resolve(Database::class);

$errors = [];

// Assuming the current user is the 'creator'
$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Validate Podcast Title
if (empty($_POST['title'])) {
    $errors['title'] = "Podcast title is required.";
} elseif (!Validator::string($_POST['title'] ?? '', 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// 2. Validate Podcast Description
if (empty($_POST['description'])) {
    $errors['description'] = "Description is required.";
} elseif (!Validator::string($_POST['description'] ?? '', 20, 65535)) { // TEXT field length
    $errors['description'] = "Description must be at least 20 characters.";
}

// 

// 4. Validate Cover Image (assuming it's a URL or file path)
// For file uploads, you'd need a separate file upload handler like your image_loader.php



// If there are validation errors, store them in session and redirect back
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: " . $_SERVER["HTTP_REFERER"]); // Redirect back to the form
    exit();
}

try {
    require "controlers/parts/image_loader.php"; 

    $db->query(
        "INSERT INTO podcasts (
            title,
            description,
            cover_image,
            created_by,
            status
        ) VALUES (
            :title,
            :description,
            :cover_image,
            :created_by,
            :status
        )",
        [
            'title' => htmlspecialchars($_POST['title']),
            'description' => htmlspecialchars($_POST['description']),
            'cover_image' => $filenamenew,
            'created_by' => $currentUserId,
            'status' => 'pending' // New podcasts usually start as 'pending' for admin review
        ]
    );

    // Redirect to a success page or the manage podcasts page
    header("Location: " . $_SERVER["HTTP_REFERER"]); 
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500); // Internal Server Error
}



header("Location: " . $_SERVER["HTTP_REFERER"]); // Redirect back to the form
exit();










