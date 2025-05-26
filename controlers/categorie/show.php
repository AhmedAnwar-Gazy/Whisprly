<?php
$heading = "Book Details";

use core\App;
use core\Database;

$db = App::resolve(Database::class);


$bookId = $_GET['book_id'] ?? null;

 if (!$bookId || !is_numeric($bookId)) {
    abort(400); // Bad Request: Invalid or missing book ID
}


try {
    // Fetch book details
    $book = $db->query("
        SELECT
            *
        FROM categories 
        WHERE category_id = :category_id
    ", [
        'category_id' => $bookId
    ])->fetch();

    if (!$book) {
        abort(404); // Book not found
    }

    $heading = htmlspecialchars($book['title']);

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}


require "views/pages/book/show_view.php";










// <?php
// $heading = "one test";
// use core\App ;
// use core\Database ;


// $db = App::resolve(Database::class);




// try{
//   $campaigns = $db->query("select g.campaign_id, g.category_id, g.partner_id, sum(u.cost) as collected_money, count(u.user_id) as donators_count,g.name, g.short_description, g.full_description, g.cost, g.state, g.start_at, g.stop_at, g.end_at,g.photo
//   from campaigns g left join users_donate_campaigns u on (g.campaign_id = u.campaign_id) group by(g.campaign_id) having g.campaign_id = :campaign_id ", [
//     'campaign_id' => $_GET['campaign_id'],
//   ])->fetchAll();
  
// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }




// visible($campaigns);



// require "views/pages/charity_campaigns/show_view.php";
