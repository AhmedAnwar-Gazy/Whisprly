<?php
$heading = "All Books";

use core\App;
use core\Database;

$db = App::resolve(Database::class);
$allCategories = $db->query("SELECT * FROM categories")->fetchAll();
// Fetch all books
$books = $db->query("        
        SELECT
        b.* 
        FROM books b
        WHERE 1=1"
        )->fetchAll();

                    

require "views/pages/book/list_view.php";










