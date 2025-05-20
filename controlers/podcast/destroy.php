<?php
$heading = "one test";

use core\App;
use core\Database;


$db = App::resolve(Database::class);
try {
    $db->query(
        "DELETE FROM podcasts 
         WHERE podcast_id = :podcast_id ",
        [
            'podcast_id' => $_POST['podcast_id']
           
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['error'] = "حدث خطأ أثناء حفظ البعانات";
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}


header("Location: " . $_SERVER["HTTP_REFERER"]);
