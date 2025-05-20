<?php
$heading = "one test";

use core\App;
use core\Database;


$db = App::resolve(Database::class);

try {
    $db->query(
        "DELETE FROM episodes WHERE episode_id = :episode_id",
        [
            'episode_id' => $_POST['episode_id']
        ]
    );
    http_response_code(204);
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}


header("Location: " . $_SERVER["HTTP_REFERER"]);
