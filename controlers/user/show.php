<?php
$heading = "Podcast Details";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Get the podcast_id from the URL
$user_id = $_GET['user_id'] ?? null;

 if (!$user_id || !is_numeric($user_id)) {
    abort(400); // Bad Request: Invalid or missing book ID
}


try {
    // Fetch podcast details
    $user = $db->query("
        SELECT *
        FROM users where user_id = :user_id

    ", [
        'user_id' => $user_id
    ])->fetch();

    if (!$user) {
        abort(404); // Podcast not found or not published
    }


} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

 //dd($books);

require "views/pages/user/account_settings_view.php";












