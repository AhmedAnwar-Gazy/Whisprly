<?php
$heading = "Update Podcast";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Get the podcast_id from the POST data
$podcastId = $_POST['podcast_id'] ?? null;

if (!$podcastId || !Validator::number($podcastId, 1)) {
    $errors['podcast_id'] = "Invalid podcast ID provided.";
} else {
    // Verify the podcast exists and belongs to the current user
    $existingPodcast = $db->query("SELECT created_by FROM podcasts WHERE podcast_id = :id", [
        'id' => $podcastId
    ])->fetch();

    if (!$existingPodcast) {
        abort(404); // Podcast not found
    }
    if ($existingPodcast['created_by'] !== $currentUserId) {
        abort(403); // Forbidden: User does not own this podcast
    }
}

// 2. Validate incoming data (only validate if provided, respecting COALESCE)

// Validate Podcast Title
if (isset($_POST['title']) && !Validator::string($_POST['title'], 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// Validate Podcast Description
if (isset($_POST['description']) && !Validator::string($_POST['description'], 20, 65535)) {
    $errors['description'] = "Description must be at least 20 characters.";
}

// Validate Category
if (isset($_POST['category']) && !Validator::string($_POST['category'], 2, 100)) {
    $errors['category'] = "Category must be between 2 and 100 characters.";
}

// Validate Cover Image (assuming it's a URL or file path)
// If file upload, integrate your image_loader.php
if (isset($_POST['cover_image']) && !Validator::string($_POST['cover_image'], 5, 255)) {
    $errors['cover_image'] = "Invalid cover image path.";
}

// If an admin can change status, you might validate that here
// if (isset($_POST['status']) && !in_array($_POST['status'], ['published', 'pending', 'rejected'])) {
//     $errors['status'] = "Invalid status value.";
// }


// If there are validation errors, redirect back to the edit form
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    // You might want to redirect with the podcast_id in the URL
    header("Location: /podcasts/edit?id=" . $podcastId);
    exit();
}

try {
    // Handle image upload if a new file is provided
    $coverImagePath = null;
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        // Assume image_loader.php handles saving the file and returns its path
        require('controllers/parts/image_loader.php'); // Or wherever your image upload logic is
        $coverImagePath = $filenamenew ?? null; // Adjust variable name as per your loader
    } elseif (isset($_POST['cover_image'])) {
        $coverImagePath = htmlspecialchars($_POST['cover_image']); // If path is submitted directly
    }

    $db->query(
        "UPDATE podcasts
        SET
            title = COALESCE(:title, title),
            description = COALESCE(:description, description),
            category = COALESCE(:category, category),
            cover_image = COALESCE(:cover_image, cover_image),
            status = COALESCE(:status, status)
        WHERE podcast_id = :podcast_id",
        [
            'title' => $_POST['title'] ? htmlspecialchars($_POST['title']) : null,
            'description' => $_POST['description'] ? htmlspecialchars($_POST['description']) : null,
            'category' => $_POST['category'] ? htmlspecialchars($_POST['category']) : null,
            'cover_image' => $coverImagePath, // Use the new path or null
            'status' => $_POST['status'] ?? null, // Allow status update if provided
            'podcast_id' => $podcastId
        ]
    );

    // Redirect to the manage podcasts page or the podcast's show page
    header("Location: /podcasts/manage");
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}








// <?php
// $heading = "Create test";

// use core\App;
// use core\Database;

// $db = App::resolve(Database::class);

// $errors = [];



// $podcast_id = $_POST['podcast_id'] ?? null;
// $title = $_POST['title'] ?? null;
// $description = $_POST['description'] ?? null;
// $category = $_POST['category'] ?? null;
// $cover_image = $_POST['cover_image'] ?? null;
// $created_by = $_POST['created_by'] ?? null;
// $status = $_POST['status'] ?? 'pending'; // قيمة افتراضية

// $errors = [];

// if (empty($title)) {
//     $errors['title'] = "حقل العنوان مطلوب";
// } elseif (strlen($title) > 150) {
//     $errors['title'] = "يجب أن يكون العنوان أقل من 150 حرفًا";
// }

// if (empty($created_by)) {
//     $errors['created_by'] = "حقل المنشئ مطلوب";
// } elseif (!is_numeric($created_by)) {
//     $errors['created_by'] = "حقل المنشئ يجب أن يكون رقمًا";
// }

// if (!empty($status) && !in_array($status, ['published', 'pending', 'rejected'])) {
//     $errors['status'] = "الحالة غير صالحة";
// }

// // يمكنك إضافة المزيد من التحقق للحقول الأخرى

// if (empty($errors) && $podcast_id !== null) {
//     $sql = "UPDATE podcasts SET
//             title = :title,
//             description = :description,
//             category = :category,
//             cover_image = :cover_image,
//             created_by = :created_by,
//             status = :status,
//             created_at = CURRENT_TIMESTAMP()
//         WHERE podcast_id = :podcast_id";

//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':podcast_id', $podcast_id, PDO::PARAM_INT);
//     $stmt->bindParam(':title', $title, PDO::PARAM_STR);
//     $stmt->bindParam(':description', $description, PDO::PARAM_STR);
//     $stmt->bindParam(':category', $category, PDO::PARAM_STR);
//     $stmt->bindParam(':cover_image', $cover_image, PDO::PARAM_STR);
//     $stmt->bindParam(':created_by', $created_by, PDO::PARAM_INT);
//     $stmt->bindParam(':status', $status, PDO::PARAM_STR);

//     if ($stmt->execute()) {
//         echo "تم تحديث البودكاست بنجاح.";
//     } else {
//         echo "حدث خطأ أثناء تحديث البودكاست.";
//     }
// } else {
//     if (!empty($errors)) {
//         echo "<ul>";
//         foreach ($errors as $error) {
//             echo "<li>" . $error . "</li>";
//         }
//         echo "</ul>";
//     } elseif ($podcast_id === null) {
//         echo "معرف البودكاست غير متوفر للتحديث.";
//     }
// }

// // // . التحقق من تصنيف الحملة
// // if (empty($_POST['category_id'])) {
// //     $errors['category_id'] = "حقل التصنيف مطلوب";
// // } elseif (!Validator::number($_POST['category_id']?? '', 1, 255)) {
// //     $errors['category_id'] = "يجب اختيار تصنيف صحيح من القائمة";

// // }
// // // . التحقق من الشريك
// // if (empty($_POST['partner_id'])) {
// //     $errors['partner_id'] = "حقل الشريك مطلوب";
// // } elseif (!Validator::number($_POST['partner_id'] ?? '', 1, 1000)) {
// //     $errors['partner_id'] = "يجب اختيار شريك صحيح من القائمة";
// // }

// // // . التحقق من اسم الحملة
// // if (empty($_POST['name'])) {
// //     $errors['name'] = "حقل اسم الحملة مطلوب";
// // } elseif (!Validator::string($_POST['name'] ?? '', 3, 255)) {
// //     $errors['name'] = "يجب أن يكون اسم الحملة بين 3 إلى 255 حرفاً";
// // }
// // // . التحقق من الوصف المختصر
// // if (empty($_POST['short_description'])) {
// //     $errors['short_description'] = "حقل الوصف المختصر مطلوب";
// // } elseif (!Validator::string($_POST['short_description'] ?? '', 20, 1000)) {
// //     $errors['short_description'] = "يجب أن يكون الوصف المختصر بين 20 إلى 1000 حرفاً";
// // }

// // // . التحقق من الوصف الكامل
// // if (empty($_POST['full_description'])) {
// //     $errors['full_description'] = "حقل الوصف الكامل مطلوب";
// // } elseif (!(Validator::string($_POST['full_description'] ?? '', 50, 5000))) {
// //     $errors['full_description'] = "يجب أن يكون الوصف الكامل بين 50 إلى 5000 حرفاً";
// // }
// // // و. التحقق من التكلفة

// // if (empty($_POST['cost'])) {
// //     $errors['cost'] = "حقل التكلفة مطلوب";
// // } elseif (!(Validator::number($_POST['cost'] ?? 0, 1, 10000000))) {
// //     $errors['cost'] = "يجب أن تكون التكلفة بين 1 إلى 10,000,000";
// // }


// // // ط. التحقق من الصورة (إذا تم إدخالها)
// // // if (empty($filenamenew)) {
// // //     $errors['photo'] = "رابط الصورة غير صالح. يجب أن يكون رابطاً صحيحاً";
// // // }
// // //dd($errors);
// // // إذا كان هناك أخطاء، عرضها
// // // if (!empty($errors)) {
// // //     require "views/pages/charity_campaigns/edit_view.php";
// // //     die();
// // // }

// // if (!empty($errors)) {
// //     $_SESSION['errors'] = $errors;
// //     header("Location:". $_SERVER["HTTP_REFERER"]);
// //     exit();
// // }

// // try {
// //     require('controllers/parts/image_loader.php') ;
// //     $db->query(
// //         "UPDATE campaigns
// //         SET 
// //             category_id = COALESCE(:category_id, category_id),
// //             partner_id = COALESCE(:partner_id, partner_id),
// //             name = COALESCE(:name, name),
// //             short_description = COALESCE(:short_description, short_description),
// //             full_description = COALESCE(:full_description, full_description),
// //             cost = COALESCE(:cost, cost),
// //             state = COALESCE(:state, state),
// //             start_at = COALESCE(:start_at, start_at),
// //             stop_at = COALESCE(:stop_at, stop_at),
// //             end_at = COALESCE(:end_at, end_at),
// //             photo = COALESCE(:photo, photo)
// //         WHERE campaign_id = :campaign_id",
// //         [
// //             'category_id' => $_POST['category_id'] ?? null,
// //             'partner_id' => $_POST['partner_id'] ?? null,
// //             'name' => isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null,
// //             'short_description' => isset($_POST['short_description']) ? htmlspecialchars($_POST['short_description']) : null,
// //             'full_description' => isset($_POST['full_description']) ? htmlspecialchars($_POST['full_description']) : null,
// //             'cost' => isset($_POST['cost']) ? filter_var($_POST['cost'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null,
// //             'state' => $_POST['state'] ?? null,
// //             'start_at' => $_POST['start_at'] ?? null,
// //             'stop_at' => $_POST['stop_at'] ?? null,
// //             'end_at' => $_POST['end_at'] ?? null,
// //             'photo' => $filenamenew ?? null,
// //             'campaign_id' => $_POST['campaign_id']
// //         ]
// //     );

// // } catch (PDOException $e) {
// //     error_log($e->getMessage());
// //     abort(500);
// // }



// header("Location:". $_SERVER["HTTP_REFERER"]);
// die();