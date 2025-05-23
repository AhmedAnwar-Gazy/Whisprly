<?php
$heading = "one test";

use core\App;
use core\Database;


$db = App::resolve(Database::class);
$episodeId = $_GET['episode_id'] ?? null;

 if (!$bookId || !is_numeric($bookId)) {
    abort(400); // Bad Request: Invalid or missing book ID
}

try {
    $db->query(
        "DELETE FROM episodes WHERE episode_id = :episode_id",
        [
            'episode_id' => $episodeId
        ]
    );
    http_response_code(204);
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}


header("Location: " . $_SERVER["HTTP_REFERER"]);
