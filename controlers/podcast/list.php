<?php
$heading = "All Podcasts";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Fetch all published podcasts
$podcasts = $db->query("SELECT
                            podcast_id,
                            title,
                            description,
                            category,
                            cover_image,
                            created_at
                        FROM podcasts
                        WHERE status = 'published'
                        ORDER BY created_at DESC")->fetchAll();

require "views/pages/podcasts/list_view.php";



// <?php
// $heading = "one test";

// use core\App;
// use core\Database;


// $db = App::resolve(Database::class);


// $userID = 1;


// // يعرض الحملات التي قد تبرعت له
// // يعني ششجمع العناصر بي النسبه لي علاقت المستخدم بهم
// // $note = $db->query("SELECT * from charity_campaigns where id = :id ", [
// //   'id' => $_GET['id'],
// // ])->findOrFail();




// $pudcast = $db->query("SELECT podcast_id,
//     title,
//     description,
//     category,
//     cover_image,
//     created_by,
//     status,
//     created_at
// FROM podcasts;
// where podcast_id = :podcast_id ", [
//   'podcast_id' => $_GET['podcast_id'],
// ])->fetchAll();





//require "views/pages/charity_campaigns/list_view.php";
