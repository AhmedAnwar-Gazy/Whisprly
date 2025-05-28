<?php


$heading = "Create ";

use core\App ;
use core\Database ;


$db = App::resolve(Database::class);
$allCategories = $db->query("SELECT * FROM categories")->fetchAll();



require "views/pages/book/create_view.php";


