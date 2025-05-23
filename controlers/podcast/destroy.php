<?php
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
    $_SESSION['error'] = "حدث خطأ أثناء حفظ البعانات";
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}


header("Location: " . $_SERVER["HTTP_REFERER"]);
