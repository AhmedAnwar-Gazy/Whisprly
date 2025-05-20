<?php
$heading = "All Books";

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Fetch all books
$books = $db->query("SELECT
                        book_id,
                        title,
                        description,
                        pdf_file,
                        topic,
                        uploaded_by,
                        linked_podcast_id,
                        created_at
                    FROM books
                    ORDER BY created_at DESC")->fetchAll();

                    

require "views/pages/book/list_view.php";










