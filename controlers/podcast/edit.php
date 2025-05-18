<?php


use core\App ;
use core\Database ;


$db = App::resolve(Database::class);


//edit 




require "views/podcast/edit_view.php";
