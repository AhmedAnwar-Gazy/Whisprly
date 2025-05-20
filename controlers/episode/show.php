<?php
$heading = "Episode Details";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Get the episode_id from the URL
$episodeId = $_GET['episode_id'] ?? null;

if (!$episodeId) {
    echo "Error: Episode ID not specified.";
    exit();
}

try {
    // Fetch episode details
    $episode = $db->query("
        SELECT
            e.episode_id,
            e.podcast_id,
            e.title,
            e.audio_file,
            e.duration,
            e.release_date,
            p.title AS podcast_title,
            u.name AS creator_name
        FROM episodes e
        JOIN podcasts p ON e.podcast_id = p.podcast_id
        JOIN users u ON p.created_by = u.user_id
        WHERE e.episode_id = :episode_id AND p.status = 'published'
    ", [
        'episode_id' => $episodeId
    ])->fetch();

    if (!$episode) {
        abort(404); // Episode not found or associated podcast not published
    }

    $heading = htmlspecialchars($episode['title']);

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

require "views/pages/episode/show_view.php";

















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



// require "views/pages/charity_campaigns/show_view.php";
