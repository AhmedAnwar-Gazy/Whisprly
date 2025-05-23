<?php
$heading = "Create ";

use core\App ;
use core\Database ;


$db = App::resolve(Database::class);




require "views/pages/podcast/create_view.php";


