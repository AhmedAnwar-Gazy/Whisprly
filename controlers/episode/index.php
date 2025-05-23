<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);
$episodes=$db->query(" select * from episodes;")->fetchAll();





require "views/pages/episode/index_view.php";
















