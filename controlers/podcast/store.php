<?php
$heading = "Create New Podcast";

use core\App;
use core\Database;
//use core\Validator; // Assuming you have this Validator class

$db = App::resolve(Database::class);

$errors = [];

// Assuming the current user is the 'creator'
$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Validate Podcast Title
if (empty($_POST['title'])) {
    $errors['title'] = "Podcast title is required.";
} elseif (!Validator::string($_POST['title'] ?? '', 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// 2. Validate Podcast Description
if (empty($_POST['description'])) {
    $errors['description'] = "Description is required.";
} elseif (!Validator::string($_POST['description'] ?? '', 20, 65535)) { // TEXT field length
    $errors['description'] = "Description must be at least 20 characters.";
}

// 3. Validate Category
if (empty($_POST['category'])) {
    $errors['category'] = "Category is required.";
} elseif (!Validator::string($_POST['category'] ?? '', 2, 100)) {
    $errors['category'] = "Category must be between 2 and 100 characters.";
}

// 4. Validate Cover Image (assuming it's a URL or file path)
// For file uploads, you'd need a separate file upload handler like your image_loader.php
if (empty($_POST['cover_image'])) {
    // This could be optional, or you could require it and validate as a URL/path
    $errors['cover_image'] = "Cover image URL/path is required.";
} elseif (!Validator::string($_POST['cover_image'] ?? '', 5, 255)) { // Simple string validation
    $errors['cover_image'] = "Invalid cover image path.";
}


// If there are validation errors, store them in session and redirect back
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: " . $_SERVER["HTTP_REFERER"]); // Redirect back to the form
    exit();
}

try {
    // Assuming you have an image_loader.php or similar for file uploads if needed
    // For now, let's just use the URL provided. If it's a file upload, integrate that logic here.
    $cover_image_path = htmlspecialchars($_POST['cover_image']);

    $db->query(
        "INSERT INTO podcasts (
            title,
            description,
            category,
            cover_image,
            created_by,
            status
        ) VALUES (
            :title,
            :description,
            :category,
            :cover_image,
            :created_by,
            :status
        )",
        [
            'title' => htmlspecialchars($_POST['title']),
            'description' => htmlspecialchars($_POST['description']),
            'category' => htmlspecialchars($_POST['category']),
            'cover_image' => $cover_image_path,
            'created_by' => $currentUserId,
            'status' => 'pending' // New podcasts usually start as 'pending' for admin review
        ]
    );

    // Redirect to a success page or the manage podcasts page
    header("Location: /podcasts/manage");
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500); // Internal Server Error
}























// <?php
// $heading = "Create test";

// use core\App;
// use core\Database;

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
// }








// $errors = [];


// // . التحقق من تصنيف الحملة
// if (empty($_POST['category_id'])) {
//     $errors['category_id'] = "حقل التصنيف مطلوب";
// } elseif (!Validator::number($_POST['category_id'] ?? '', 1, 255)) {
//     $errors['category_id'] = "يجب اختيار تصنيف صحيح من القائمة";
// }
// // . التحقق من الشريك
// if (empty($_POST['partner_id'])) {
//     $errors['partner_id'] = "حقل الشريك مطلوب";
// } elseif (!Validator::number($_POST['partner_id'] ?? '', 1, 1000)) {
//     $errors['partner_id'] = "يجب اختيار شريك صحيح من القائمة";
// }

// // . التحقق من اسم الحملة
// if (empty($_POST['name'])) {
//     $errors['name'] = "حقل اسم الحملة مطلوب";
// } elseif (!Validator::string($_POST['name'] ?? '', 3, 255)) {
//     $errors['name'] = "يجب أن يكون اسم الحملة بين 3 إلى 255 حرفاً";
// }
// // . التحقق من الوصف المختصر
// if (empty($_POST['short_description'])) {
//     $errors['short_description'] = "حقل الوصف المختصر مطلوب";
// } elseif (!Validator::string($_POST['short_description'] ?? '', 20, 1000)) {
//     $errors['short_description'] = "يجب أن يكون الوصف المختصر بين 20 إلى 1000 حرفاً";
// }

// // . التحقق من الوصف الكامل
// if (empty($_POST['full_description'])) {
//     $errors['full_description'] = "حقل الوصف الكامل مطلوب";
// } elseif (!(Validator::string($_POST['full_description'] ?? '', 50, 5000))) {
//     $errors['full_description'] = "يجب أن يكون الوصف الكامل بين 50 إلى 5000 حرفاً";
// }
// // و. التحقق من التكلفة

// if (empty($_POST['cost'])) {
//     $errors['cost'] = "حقل التكلفة مطلوب";
// } elseif (!(Validator::number($_POST['cost'] ?? 0, 1, 10000000))) {
//     $errors['cost'] = "يجب أن تكون التكلفة بين 1 إلى 10,000,000";
// }


// // ط. التحقق من الصورة (إذا تم إدخالها)
// // if (empty($filenamenew)) {
// //     $errors['photo'] = "رابط الصورة غير صالح. يجب أن يكون رابطاً صحيحاً";
// // }
// //dd($errors);
// // إذا كان هناك أخطاء، عرضها
// // if (!empty($errors)) {
// //     require "views/pages/charity_campaigns/create_view.php";
// //     die();
// // }

// if (!empty($errors)) {
//     $_SESSION['errors'] = $errors;
//     header("Location:" . $_SERVER["HTTP_REFERER"]);
//     exit();
// }

// try {
//     require('controllers/parts/image_loader.php');
//     $db->query(
//         "INSERT INTO campaigns (
//             category_id,
//             partner_id,
//             name,
//             short_description,
//             full_description,
//             cost,
//             state,
//             photo
//         ) VALUES (
//             :category_id,
//             :partner_id,
//             :name,
//             :short_description,
//             :full_description,
//             :cost,
//             :state,
//             :photo
//         )",
//         [
//             'category_id' => $_POST['category_id'],
//             'partner_id' => $_POST['partner_id'],
//             'name' => htmlspecialchars($_POST['name']),
//             'short_description' => htmlspecialchars($_POST['short_description']),
//             'full_description' => htmlspecialchars($_POST['full_description']),
//             'cost' => filter_var($_POST['cost'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
//             'state' => $_POST['state'] ?? 'active', // Default value if not provided
//             'photo' => $filenamenew
//         ]
//     );
// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }



// header("Location: " . $_SERVER["HTTP_REFERER"]);
