<?php
$heading = "Add New Episode";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Validate Podcast ID
if (empty($_POST['podcast_id'])) {
    $errors['podcast_id'] = "Podcast ID is required.";
} elseif (!Validator::number($_POST['podcast_id'] ?? '', 1)) {
    $errors['podcast_id'] = "Invalid Podcast ID.";
} else {
    // Verify that the current user owns this podcast for security
    $podcastId = (int)$_POST['podcast_id'];
    $podcastOwner = $db->query("SELECT created_by FROM podcasts WHERE podcast_id = :podcast_id", [
        'podcast_id' => $podcastId
    ])->fetch();

    if (!$podcastOwner || $podcastOwner['created_by'] !== $currentUserId) {
        $errors['podcast_id'] = "You do not have permission to add episodes to this podcast.";
    }
}

// 2. Validate Episode Title
if (empty($_POST['title'])) {
    $errors['title'] = "Episode title is required.";
} elseif (!Validator::string($_POST['title'] ?? '', 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// 3. Validate Audio File (assuming it's a URL or file path)
// For file uploads, you'd need a separate file upload handler
if (empty($_POST['audio_file'])) {
    $errors['audio_file'] = "Audio file URL/path is required.";
} elseif (!Validator::string($_POST['audio_file'] ?? '', 5, 255)) {
    $errors['audio_file'] = "Invalid audio file path.";
}

// 4. Validate Duration
if (empty($_POST['duration'])) {
    $errors['duration'] = "Duration (in seconds) is required.";
} elseif (!Validator::number($_POST['duration'] ?? '', 1, 86400)) { // Max 24 hours in seconds
    $errors['duration'] = "Duration must be a positive number of seconds (max 86400).";
}

// 5. Validate Release Date
if (empty($_POST['release_date'])) {
    $errors['release_date'] = "Release date is required.";
} elseif (!Validator::string($_POST['release_date'] ?? '')) { // Assuming a Validator::date method
    $errors['release_date'] = "Invalid date format.";
}


// If there are validation errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

try {
    $db->query(
        "INSERT INTO episodes (
            podcast_id,
            title,
            audio_file,
            duration,
            release_date
        ) VALUES (
            :podcast_id,
            :title,
            :audio_file,
            :duration,
            :release_date
        )",
        [
            'podcast_id' => $podcastId, // Already validated and cast to int
            'title' => htmlspecialchars($_POST['title']),
            'audio_file' => htmlspecialchars($_POST['audio_file']),
            'duration' => (int)$_POST['duration'],
            'release_date' => $_POST['release_date']
        ]
    );

    // Redirect to the podcast's manage episodes page
    header("Location: /podcasts/episodes/manage?podcast_id=" . $podcastId);
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
