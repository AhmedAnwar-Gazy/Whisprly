<?php
$heading = "Home";

$_SESSION['name'] = "ahmed";
use core\App;
use core\Database;
$limit = 5; 
$offset = 0 ;

$db = App::resolve(Database::class);


$podcasts=$db->query(" select * from podcasts ORDER BY podcast_id ASC LIMIT $limit OFFSET $offset ;")->fetchAll(); 
//dd($podcasts);
require "views/pages/whisprly_view.php";
