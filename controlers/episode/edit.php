<?php
$heading = "Edit Episode";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// Get the episode_id and podcast_id from the URL
$episodeId = $_GET['episode_id'] ?? null;
$podcastId = $_GET['podcast_id'] ?? null; // Needed for authorization

if (!$episodeId || !is_numeric($episodeId) || !$podcastId || !is_numeric($podcastId)) {
    abort(400); // Bad Request: Invalid or missing IDs
}

try {
    // First, verify the user owns the parent podcast
    $podcastOwner = $db->query("SELECT created_by FROM podcasts WHERE podcast_id = :podcast_id", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcastOwner || $podcastOwner['created_by'] !== $currentUserId) {
        abort(403); // Forbidden: User does not own this podcast, thus cannot edit its episodes
    }

    // Fetch the episode details, ensuring it belongs to the specified podcast
    $episode = $db->query("
        SELECT
            episode_id,
            podcast_id,
            title,
            audio_file,
            duration,
            release_date
        FROM episodes
        WHERE episode_id = :episode_id AND podcast_id = :podcast_id
    ", [
        'episode_id' => $episodeId,
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$episode) {
        abort(404); // Episode not found or does not belong to this podcast
    }

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

require "views/pages/episode/edit_view.php";











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
//     $campaign = $db->query("select g.campaign_id, g.category_id, g.partner_id, sum(u.cost) as collected_money, g.name, 
//         g.short_description, g.full_description, g.cost, g.state, g.start_at, g.stop_at, g.end_at,g.photo
//         from campaigns g left join users_donate_campaigns u on (g.campaign_id = u.campaign_id) group by(u.campaign_id) having g.campaign_id = :campaign_id ", [
//         'campaign_id' => $_GET['campaign_id'],
//     ])->findOrFail();
// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }


// require "views/pages/charity_campaigns/edit_view.php";
