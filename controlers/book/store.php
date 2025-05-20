<?php
$heading = "Upload New Book";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Validate Book Title
if (empty($_POST['title'])) {
    $errors['title'] = "Book title is required.";
} elseif (!Validator::string($_POST['title'] ?? '', 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// 2. Validate Book Description
// Description is optional, but if present, validate length
if (!empty($_POST['description']) && !Validator::string($_POST['description'] ?? '', 10, 65535)) {
    $errors['description'] = "Description must be at least 10 characters.";
}

// 3. Validate PDF File (assuming it's a URL or file path)
// For file uploads, you'd need a separate file upload handler
if (empty($_POST['pdf_file'])) {
    $errors['pdf_file'] = "PDF file URL/path is required.";
} elseif (!Validator::string($_POST['pdf_file'] ?? '', 5, 255)) {
    $errors['pdf_file'] = "Invalid PDF file path.";
}

// 4. Validate Topic
if (empty($_POST['topic'])) {
    $errors['topic'] = "Topic is required.";
} elseif (!Validator::string($_POST['topic'] ?? '', 2, 100)) {
    $errors['topic'] = "Topic must be between 2 and 100 characters.";
}

// 5. Validate Linked Podcast ID (Optional)
$linkedPodcastId = null;
if (!empty($_POST['linked_podcast_id'])) {
    if (!Validator::number($_POST['linked_podcast_id'] ?? '', 1)) {
        $errors['linked_podcast_id'] = "Invalid Linked Podcast ID.";
    } else {
        $linkedPodcastId = (int)$_POST['linked_podcast_id'];
        // Optionally, check if this podcast_id actually exists
        $podcastExists = $db->query("SELECT podcast_id FROM podcasts WHERE podcast_id = :id", [
            'id' => $linkedPodcastId
        ])->fetch();
        if (!$podcastExists) {
            $errors['linked_podcast_id'] = "Linked podcast does not exist.";
            $linkedPodcastId = null; // Reset if invalid
        }
    }
}


// If there are validation errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

try {
    $db->query(
        "INSERT INTO books (
            title,
            description,
            pdf_file,
            topic,
            uploaded_by,
            linked_podcast_id
        ) VALUES (
            :title,
            :description,
            :pdf_file,
            :topic,
            :uploaded_by,
            :linked_podcast_id
        )",
        [
            'title' => htmlspecialchars($_POST['title']),
            'description' => htmlspecialchars($_POST['description'] ?? ''), // Use null if empty
            'pdf_file' => htmlspecialchars($_POST['pdf_file']),
            'topic' => htmlspecialchars($_POST['topic']),
            'uploaded_by' => $currentUserId,
            'linked_podcast_id' => $linkedPodcastId // Will be null if not provided or invalid
        ]
    );

    // Redirect to a success page or the manage books page
    header("Location: /books/manage");
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
