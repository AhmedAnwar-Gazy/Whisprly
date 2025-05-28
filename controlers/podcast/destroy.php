<?php
//dd($_POST['podcast_id']);
$heading = "one test";

use core\App;
use core\Database;


$db = App::resolve(Database::class);
$podcastId=$_POST['podcast_id'];

if (!$podcastId || !is_numeric($podcastId)) {
    abort(400); // Bad Request: Invalid or missing book ID
}

try {
    $db->query(
        "DELETE FROM podcasts 
         WHERE podcast_id = :podcast_id ",
        [
            'podcast_id' => $podcastId
           
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}


header("Location: " . $_SERVER["HTTP_REFERER"]);
