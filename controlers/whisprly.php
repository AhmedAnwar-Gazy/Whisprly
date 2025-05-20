<?php
$heading = "Home";

$_SESSION['name'] = "ahmed";
use core\App;
use core\Database;


$db = App::resolve(Database::class);


$podcasts=$db->query(" select * from podcasts;")->fetchAll(); 

require "views/pages/whisprly_view.php";
