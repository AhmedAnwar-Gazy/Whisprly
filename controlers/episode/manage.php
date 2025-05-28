<?php
//dd("episode");
$heading = "Manage Episodes";

use core\App;
use core\Database;

$db = App::resolve(Database::class);
$episodes=$db->query(" SELECT episodes.* ,podcasts.title as podcast_title from episodes LEFT join podcasts on episodes.podcast_id = podcasts.podcast_id ;")->fetchAll();









// $podcastId = $_GET['podcast_id'] ?? null; // Get podcast ID from URL
// $currentUserId = $_SESSION['user']['user_id'] ?? 1; // Current logged-in user

//  if (!$podcastId || !is_numeric($podcastId)) {
//     abort(400); // Bad Request: Invalid or missing book ID
// }

// try {
//     // Verify the current user owns this podcast (security measure)
//     $podcastOwner = $db->query("SELECT created_by, title FROM podcasts WHERE podcast_id = :podcast_id", [
//         'podcast_id' => $podcastId
//     ])->fetch();

//     if (!$podcastOwner || $podcastOwner['created_by'] !== $currentUserId) {
//         abort(403); // Forbidden access
//     }

//     $heading = "Manage Episodes for: " . htmlspecialchars($podcastOwner['title']);
//     $search = $_GET['search'] ?? '';

//     $query = "
//         SELECT
//             episode_id,
//             podcast_id,
//             title,
//             audio_file,
//             duration,
//             release_date
//         FROM episodes
//         WHERE podcast_id = :podcast_id
//     ";

//     $params = [
//         'podcast_id' => $podcastId
//     ];

//     // Add Search Filter
//     if (!empty($search)) {
//         $query .= " AND MATCH(title) AGAINST (:search IN NATURAL LANGUAGE MODE)";
//         $params['search'] = $search;
//     }

//     // Finalize Query
//     $query .= " ORDER BY release_date DESC;";

//     $episodes = $db->query($query, $params)->fetchAll();

// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }

require "views/pages/episode/manage_view.php";















