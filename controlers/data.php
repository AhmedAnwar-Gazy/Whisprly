<?php 

use core\App;
use core\Database;
$limit = 5; 
$offset = 0 ;

$db = App::resolve(Database::class);

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Number of items to load per request
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Starting point for fetching

// Basic validation to prevent negative values
if ($limit <= 0) $limit = 5;
if ($offset < 0) $offset = 0;



$podcasts=$db->query(" select * from podcasts ORDER BY podcast_id ASC LIMIT $limit OFFSET $offset")->fetchAll(); 

// $sql = "SELECT * FROM products ORDER BY podcast_id ASC LIMIT $limit OFFSET $offset";
// $result = $conn->query($sql);

$products = [];
// if ($podcasts->array_column > 0) {
//     dd("good");
//     while ($row = $result->fetch_assoc()) {
//         $products[] = $row;
//     }
// }
    

    foreach ($podcasts as $podcast){
        $products[] =$podcast ;
    }

    // $servername = "localhost";
    // $username = "root";
    // $password = "730673145"; // Your database password
    // $dbname = "whisprly"; // Your database name
    
    // $conn = new mysqli($servername, $username, $password, $dbname);
    
    // if ($conn->connect_error) {
    //     echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    //     exit();
    // }
    
    // $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Number of items to load per request
    // $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Starting point for fetching
    
    // // Basic validation to prevent negative values
    // if ($limit <= 0) $limit = 5;
    // if ($offset < 0) $offset = 0;
    
    // $sql = "select * from podcasts ORDER BY podcast_id ASC LIMIT $limit OFFSET $offset";
    // $result = $conn->query($sql);
    
    // $products = [];
    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         $products[] = $row;
    //     }
    // }
    
    // $conn->close();


echo json_encode(['success' => true, 'products' =>$products]);
?>