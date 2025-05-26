<?php
$heading = "Upload New Book";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval




// 1. Validate Category Name
if (empty($_POST['name'])) {
    $errors['name'] = "Category name is required.";
} elseif (!Validator::string($_POST['name'] ?? '', 1, 100)) { // Min length 1, Max length 100
    $errors['name'] = "Name must be between 1 and 100 characters.";
}


if (!empty($_POST['description'])) {
    // If you want a minimum length for description if it's provided:
    if (!Validator::string($_POST['description'] ?? '', 10, 65535)) { // Assuming min 10 characters if provided
        $errors['description'] = "Description must be at least 10 characters if provided.";
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
        "INSERT INTO categories (
            name,
            description
        ) VALUES (
            :name,
            :description
        )",
        [
            'name' => htmlspecialchars($_POST['name']),
            'description' => !empty($_POST['description']) ? htmlspecialchars($_POST['description']) : null
        ]
    );

    // Redirect to a success page or the manage books page
    header("Location: /book/manage");
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}











