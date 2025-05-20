<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$test = $db->query(
    "SELECT * FROM podcasts;"
)->fetchAll();

dd($test);

$page = "podcasts_index";
start_page:
$page_podcast_ids = [];
$heading = "All Podcasts";
if (!isset($_GET['page_number'])) $_GET['page_number'] = 1;

$search = $_GET['search'] ?? '';
$filter_category = $_GET['filter_category'] ?? 'all';
$filter_status = $_GET['filter_status'] ?? 'published'; // Default to 'published'

if (!isset($_SESSION['podcasts_count_all'])) {
    $_SESSION['podcasts_count_all'] = $db->query(
        "SELECT count(*) as count FROM podcasts WHERE status = 'published';"
    )->fetchAll()[0]['count'];
} else {
    $podcasts_current_count = $db->query("SELECT count(*) as count FROM podcasts WHERE status = 'published';")->fetchAll()[0]['count'];
    if ($podcasts_current_count != $_SESSION['podcasts_count_all']) {
        if ($podcasts_current_count > $_SESSION['podcasts_count_all']) {
            if (count($_SESSION['podcasts_pages'][$_GET['page_number']] ?? []) < 10) {
                $_SESSION['podcasts_pages'][$_GET['page_number']] = [];
            } else {
                $latest_page = intval($_SESSION['podcasts_count_all'] / 10 + 1);
                $_SESSION['podcasts_pages'][$latest_page] = [];
            }
        } else {
            $_SESSION['podcasts_pages'] = [];
        }
        $_SESSION['podcasts_count_all'] = $podcasts_current_count;
        goto start_page;
    }
}

$pages_count['podcasts'] = ceil($_SESSION['podcasts_count_all'] / 10);
if ($pages_count['podcasts'] == 0) $pages_count['podcasts'] = 1; // Ensure at least one page
$has_next = $_GET['page_number'] < $pages_count['podcasts'];

$filtered = (!empty($search) || ($filter_category !== 'all') || ($filter_status !== 'published'));

try {
    // Get unique categories for filtering
    $categories = $db->query("SELECT DISTINCT category FROM podcasts WHERE category IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);

    $query = "SELECT * FROM podcasts WHERE status = :status_filter";
    $params = [':status_filter' => $filter_status];

    if ($filtered) {
        if (!empty($search)) {
            $query .= " AND MATCH(title, description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
            $params[':search'] = $search;
        }
        if ($filter_category !== 'all') {
            $query .= " AND category = :category";
            $params[':category'] = $filter_category;
        }
        $podcasts = $db->query($query, $params)->fetchAll();
    } elseif (isset($_SESSION['podcasts_pages']) && isset($_SESSION['podcasts_pages'][$_GET['page_number']]) && count($_SESSION['podcasts_pages'][$_GET['page_number']]) > 0) {
        $ids = implode(",", $_SESSION['podcasts_pages'][$_GET['page_number']]);
        $query .= " AND podcast_id IN ({$ids}) ORDER BY podcast_id;";
        $podcasts = $db->query($query, [':status_filter' => $filter_status])->fetchAll();
    } else {
        if (isset($_SESSION['podcasts_pages']) && !empty($_SESSION['podcasts_pages'])) {
            $excluded_ids = [];
            foreach ($_SESSION['podcasts_pages'] as $page_ids) {
                if (is_array($page_ids)) {
                    $excluded_ids = array_merge($excluded_ids, $page_ids);
                }
            }
            if (!empty($excluded_ids)) {
                $query .= " AND podcast_id NOT IN (" . implode(",", $excluded_ids) . ")";
            }
        }
        $query .= " ORDER BY created_at DESC LIMIT 10 OFFSET :offset;";
        $params[':offset'] = ($_GET['page_number'] - 1) * 10;
        $podcasts = $db->query($query, $params)->fetchAll();

        foreach ($podcasts as $podcast) {
            $page_podcast_ids[] = $podcast['podcast_id'];
        }
        $_SESSION['podcasts_pages'][$_GET['page_number']] = $page_podcast_ids;
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}

require "views/pages/podcast/index_view.php";




















// <?php

// use core\App;
// use core\Database;
// use models\Campaign;

// $db = App::resolve(Database::class);
// $errors = [];

// if (empty($_POST['title'])) {
//     $errors['title'] = "حقل العنوان مطلوب.";
// } elseif (strlen($_POST['title']) > 150) {
//     $errors['title'] = "يجب أن يكون العنوان أقل من 150 حرفًا.";
// }

// $description = $_POST['description'] ?? '';
// if (strlen($description) > 65535) {
//     $errors['description'] = "يجب أن يكون الوصف أقل من 65535 حرفًا.";
// }

// $category = $_POST['category'] ?? '';
// if (strlen($category) > 100) {
//     $errors['category'] = "يجب أن تكون الفئة أقل من 100 حرفًا.";
// }

// $cover_image = $_POST['cover_image'] ?? '';
// if (strlen($cover_image) > 255) {
//     $errors['cover_image'] = "يجب أن يكون رابط صورة الغلاف أقل من 255 حرفًا.";
// }

// if (empty($_POST['created_by'])) {
//     $errors['created_by'] = "حقل المنشئ مطلوب.";
// } elseif (!filter_var($_POST['created_by'], FILTER_VALIDATE_INT) || filter_var($_POST['created_by'], FILTER_VALIDATE_INT) <= 0) {
//     $errors['created_by'] = "يجب أن يكون معرف المنشئ عددًا صحيحًا موجبًا.";
// }

// $status = $_POST['status'] ?? 'pending';
// if (!in_array($status, ['published', 'pending', 'rejected'])) {
//     $errors['status'] = "الحالة المحددة غير صالحة.";
// }

// if (empty($errors)) {
//     try {
//         $sql = "INSERT INTO podcasts (title, description, category, cover_image, created_by, status) VALUES (:title, :description, :category, :cover_image, :created_by, :status)";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute([
//             'title' => htmlspecialchars($_POST['title']),
//             'description' => htmlspecialchars($description),
//             'category' => htmlspecialchars($category),
//             'cover_image' => htmlspecialchars($cover_image),
//             'created_by' => filter_var($_POST['created_by'], FILTER_SANITIZE_NUMBER_INT),
//             'status' => $status
//         ]);
//         echo "تم إضافة البودكاست بنجاح.";
//     } catch (PDOException $e) {
//         error_log("خطأ في إضافة البودكاست: " . $e->getMessage());
//         echo "حدث خطأ أثناء إضافة البودكاست: " . htmlspecialchars($e->getMessage());
//     }
// } else {
//     echo "<ul>";
//     foreach ($errors as $error) {
//         echo "<li>" . $error . "</li>";
//     }
//     echo "</ul>";
//  }






 // from bader
 
// $page = "charity_campaigns_index" ;
// start_page:
// $page_campaigns_ids = [];
// $heading = "All My tests";
// if(!isset($_GET['page_number'])) $_GET['page_number'] = 1; // if page_number not set in $_GET

// $search = $_GET['search'] ?? '';
// $filter = $_GET['filter'] ?? 'all';

// if(!isset($_SESSION['campaigns_count_all'])){
//     $page_campaigns_ids = [];
//     $_SESSION['campaigns_count_all'] = $db->query(
//         "select count(*) as count from campaigns where state = 'active';"
//     )->fetchAll()['0']['count'];
// }else{
//     $campaigns_current_count = $db->query( "select count(*) as count from campaigns where state = 'active';")->fetchAll()['0']['count'];
//     if($campaigns_current_count != $_SESSION['campaigns_count_all']){
//         if($campaigns_current_count > $_SESSION['campaigns_count_all']){// changes are adding
//             if(count($_SESSION['campaigns_pages'][$_GET['page_number']]) < '10'){ // there is an empty place for the added value
//                 $_SESSION['campaigns_pages'][$_GET['page_number']] = [];
//             }else{// no empty place for the new item added
//                 $latest_page = intval($_SESSION['campaigns_count_all']/10 + 1);
//                 $_SESSION['campaigns_pages'][$latest_page] = [];
//             }
//         }else{// changes are deleting
//             $_SESSION['campaigns_pages'] = [];
//         }
//         $_SESSION['campaigns_count_all'] = $campaigns_current_count;
//         goto start_page;
//     }
// }
// $pages_count['campaigns'] = $_SESSION['campaigns_count_all']/10 + 1;
// $has_next = !isset($_GET['page_number']) || $_GET['page_number'] + 1 >= $pages_count['campaigns'];
// $filtered = (!empty($search) || ($filter !== 'all') || (isset($_GET['submit']) && $_GET['submit'] == "foryou"));

// try {
//     // Fetch categories for the dropdown
//     $categories = $db->query("SELECT category_id, name FROM categories")->fetchAll();

//     // Get search and filter inputs
    
//     $query = 
//     "SELECT
//     p.podcast_id,
//     p.title AS podcast_title,
//     u.name AS creator_name,
//     COUNT(s.user_id) AS subscriber_count
// FROM
//     podcasts p
// JOIN
//     users u ON p.created_by = u.user_id
// LEFT JOIN
//     subscriptions s ON p.podcast_id = s.podcast_id
// GROUP BY
//     p.podcast_id, p.title, u.name
// ORDER BY
//     subscriber_count DESC;


    
    
  
//     ";
//     if($filtered){
//         $params = [];
//         if (!empty($search)) {
//             $query .= " AND MATCH(g.name, g.short_description, g.full_description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
//             $params['search'] = $search;
//         }
//         // 🎯 Add Category Filter (if a valid category is selected)
//         if ($filter !== 'all' && is_numeric($filter)) {
//             $query .= " AND g.category_id = :category_id";
//             $params['category_id'] = $filter - 1 ;
//         }
//         if(isset($_GET['submit']) && $_GET['submit'] == "foryou"){
//             $query .= " AND u.user_id = :user_id";
//             $params['user_id'] = $_SESSION['user']['id'];
//         }
//         $campaigns = $db->query($query, $params)->fetchAll();
//     }elseif/*ides are stored in session */(isset($_SESSION['campaigns_pages']) && isset($_SESSION['campaigns_pages'][$_GET['page_number']]) && count($_SESSION['campaigns_pages'][$_GET['page_number']]) > 0){
//         $query .= " AND g.campaign_id IN (".implode(separator: ",",array: $_SESSION['campaigns_pages'][$_GET['page_number']]).") order by g.campaign_id;";
//         $campaigns = $db->query($query)->fetchAll();
//     }else{// list of items arent stored yet in session
//         if(isset($_SESSION['campaigns_pages'])){
//             $query .= " AND g.campaign_id NOT IN (-1,-2 ";
//             foreach($_SESSION['campaigns_pages'] as $key => $value){
//                     if(isset($value) && count($value) > 0){
//                         $query .= ",".implode(",", $value);
//                     }
//                 }
//                 $query .= ")";
//             }
//             $query.= " ORDER BY RAND() limit 10;";
//         $campaigns = $db->query($query)->fetchAll();
//         foreach($campaigns as $campaign){
//             $page_campaigns_ids[] = $campaign['campaign_id'];
//         }
//         $_SESSION['campaigns_pages'][$_GET['page_number']] = $page_campaigns_ids;
//     }
//     // 👌 Finalize Query

//     // Execute the query
    

// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }





// require "views/pages/charity_campaigns/index_view.php";
