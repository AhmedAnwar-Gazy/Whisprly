<?php
$heading = "Podcast Details";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Get the podcast_id from the URL
$podcastId = $_GET['podcast_id'] ?? null;

if (!$podcastId) {
    echo "Error: Podcast ID not specified.";
    exit();
}

try {
    // Fetch podcast details
    $podcast = $db->query("
        SELECT
            p.podcast_id,
            p.title,
            p.description,
            p.category,
            p.cover_image,
            p.created_at,
            u.name AS creator_name
        FROM podcasts p
        JOIN users u ON p.created_by = u.user_id
        WHERE p.podcast_id = :podcast_id AND p.status = 'published'
    ", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcast) {
        abort(404); // Podcast not found or not published
    }

    $heading = htmlspecialchars($podcast['title']);

    // Fetch episodes for this podcast
    $episodes = $db->query("
        SELECT
            episode_id,
            title,
            audio_file,
            duration,
            release_date
        FROM episodes
        WHERE podcast_id = :podcast_id
        ORDER BY release_date DESC
    ", [
        'podcast_id' => $podcastId
    ])->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

require "views/pages/podcast/show_view.php";

















// <?php
// $heading = "one test";
// use core\App ;
// use core\Database ;


// $db = App::resolve(Database::class);




// try{
//   $campaigns = $db->query("select g.campaign_id, g.category_id, g.partner_id, sum(u.cost) as collected_money, count(u.user_id) as donators_count,g.name, g.short_description, g.full_description, g.cost, g.state, g.start_at, g.stop_at, g.end_at,g.photo
//   from campaigns g left join users_donate_campaigns u on (g.campaign_id = u.campaign_id) group by(g.campaign_id) having g.campaign_id = :campaign_id ", [
//     'campaign_id' => $_GET['campaign_id'],
//   ])->fetchAll();
  
// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }




// visible($campaigns);



// require "views/podcasts/show_view.php";
