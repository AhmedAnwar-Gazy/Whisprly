<?php
$heading = "Edit Podcast";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// Get the podcast_id from the URL
$podcastId = $_GET['podcast_id'] ?? null;

if (!$podcastId || !is_numeric($podcastId)) {
    abort(400); // Bad Request: Invalid or missing podcast ID
}

try {
    // Fetch the podcast details
    $podcast = $db->query("
        SELECT
            podcast_id,
            title,
            description,
            category,
            cover_image,
            created_by,
            status
        FROM podcasts
        WHERE podcast_id = :podcast_id
    ", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcast) {
        abort(404); // Podcast not found
    }

    // Authorization: Ensure the current user created this podcast
    if ($podcast['created_by'] !== $currentUserId) {
        abort(403); // Forbidden: User does not own this podcast
    }

    // You might want to fetch a list of possible categories if you have a separate categories table
    // $categories = $db->query("SELECT category_id, name FROM categories")->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

require "views/pages/podcast/edit_view.php";








// <?php
// $heading = "Create ";

// use core\App;
// use core\Database;


// $db = App::resolve(Database::class);


// try {
//     $categories = $db->query(
//         "SELECT * FROM categories"
//     )->fetchAll(); // Fetch all rows from the query result 
//     $partners = $db->query(
//         "SELECT * FROM partners"
//     )->fetchAll(); // Fetch all rows from the query result
//     $campaign = $db->query("SELECT
//     p.podcast_id,
//     p.title AS podcast_title,
//     u.name AS creator_name,
//     COUNT(s.user_id) AS subscriber_count
// FROM
//     podcasts p
// JOIN
//     users u ON p.created_by = u.user_id
// LEFT JOIN
//     subscriptions s ON p.podcast_id = :podcast_id
// GROUP BY
//     p.podcast_id, p.title, u.name
// ORDER BY
//     subscriber_count DESC;
    
// ", [
//         'podcast_id' => $_GET['podcast_id'],
//     ])->findOrFail();
// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }


// require "views/pages/charity_campaigns/edit_view.php";
