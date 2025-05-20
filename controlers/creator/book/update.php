<?php
$heading = "Update Book";

use core\App;
use core\Database;
//use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$currentUserId = $_SESSION['user']['user_id'] ?? 1; // Replace with your actual user ID retrieval

// 1. Get the book_id from the POST data
$bookId = $_POST['book_id'] ?? null;

if (!$bookId || !Validator::number($bookId, 1)) {
    $errors['book_id'] = "Invalid book ID provided.";
} else {
    // Verify the book exists and belongs to the current user
    $existingBook = $db->query("SELECT uploaded_by FROM books WHERE book_id = :id", [
        'id' => $bookId
    ])->fetch();

    if (!$existingBook) {
        abort(404); // Book not found
    }
    if ($existingBook['uploaded_by'] !== $currentUserId) {
        abort(403); // Forbidden: User does not own this book
    }
}

// 2. Validate incoming data
// Validate Book Title
if (isset($_POST['title']) && !Validator::string($_POST['title'], 3, 150)) {
    $errors['title'] = "Title must be between 3 and 150 characters.";
}

// Validate Book Description
// Description is optional, so only validate if it's provided and not empty
if (isset($_POST['description']) && !empty($_POST['description']) && !Validator::string($_POST['description'], 10, 65535)) {
    $errors['description'] = "Description must be at least 10 characters.";
}

// Validate PDF File (assuming it's a URL or file path)
// If file upload, integrate your file upload handler
if (isset($_POST['pdf_file']) && !Validator::string($_POST['pdf_file'], 5, 255)) {
    $errors['pdf_file'] = "Invalid PDF file path.";
}

// Validate Topic
if (isset($_POST['topic']) && !Validator::string($_POST['topic'], 2, 100)) {
    $errors['topic'] = "Topic must be between 2 and 100 characters.";
}

// Validate Linked Podcast ID (Optional)
$linkedPodcastId = null;
if (isset($_POST['linked_podcast_id']) && !empty($_POST['linked_podcast_id'])) {
    if (!Validator::number($_POST['linked_podcast_id'], 1)) {
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
} elseif (isset($_POST['linked_podcast_id']) && empty($_POST['linked_podcast_id'])) {
    // If the field was provided but empty, it means the user wants to unlink the podcast
    $linkedPodcastId = null;
} else {
    // If the field was not set in POST at all, COALESCE will keep the old value.
    // No action needed here as COALESCE handles it.
}


// If there are validation errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: /book/edit?id=" . $bookId);
    exit();
}

try {
    // Handle PDF file upload if a new file is provided
    $pdfFilePath = null;
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        // Assume your file upload logic for PDFs (similar to image_loader)
        // For demonstration, let's just use a placeholder
        // In a real app, this would involve moving the uploaded file to a safe directory
        $pdfFilePath = "/uploads/pdfs/" . basename($_FILES['pdf_file']['name']); // Placeholder
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], $pdfFilePath);
    } elseif (isset($_POST['pdf_file'])) {
        $pdfFilePath = htmlspecialchars($_POST['pdf_file']); // If path is submitted directly
    }

    $db->query(
        "UPDATE books
        SET
            title = COALESCE(:title, title),
            description = COALESCE(:description, description),
            pdf_file = COALESCE(:pdf_file, pdf_file),
            topic = COALESCE(:topic, topic),
            linked_podcast_id = COALESCE(:linked_podcast_id, linked_podcast_id)
        WHERE book_id = :book_id",
        [
            'title' => $_POST['title'] ? htmlspecialchars($_POST['title']) : null,
            'description' => $_POST['description'] ? htmlspecialchars($_POST['description']) : null,
            'pdf_file' => $pdfFilePath, // Use the new path or null
            'topic' => $_POST['topic'] ? htmlspecialchars($_POST['topic']) : null,
            'linked_podcast_id' => ($linkedPodcastId !== null) ? $linkedPodcastId : (isset($_POST['linked_podcast_id']) && empty($_POST['linked_podcast_id']) ? null : null), // Handle unlinking explicitly, or leave to COALESCE
            'book_id' => $bookId
        ]
    );

    // Redirect to the manage books page or the book's show page
    header("Location: /book/manage");
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
// } elseif (!Validator::number($_POST['category_id']?? '', 1, 255)) {
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
// //     require "views/pages/charity_campaigns/edit_view.php";
// //     die();
// // }

// if (!empty($errors)) {
//     $_SESSION['errors'] = $errors;
//     header("Location:". $_SERVER["HTTP_REFERER"]);
//     exit();
// }

// try {
//     require('controllers/parts/image_loader.php') ;
//     $db->query(
//         "UPDATE campaigns
//         SET 
//             category_id = COALESCE(:category_id, category_id),
//             partner_id = COALESCE(:partner_id, partner_id),
//             name = COALESCE(:name, name),
//             short_description = COALESCE(:short_description, short_description),
//             full_description = COALESCE(:full_description, full_description),
//             cost = COALESCE(:cost, cost),
//             state = COALESCE(:state, state),
//             start_at = COALESCE(:start_at, start_at),
//             stop_at = COALESCE(:stop_at, stop_at),
//             end_at = COALESCE(:end_at, end_at),
//             photo = COALESCE(:photo, photo)
//         WHERE campaign_id = :campaign_id",
//         [
//             'category_id' => $_POST['category_id'] ?? null,
//             'partner_id' => $_POST['partner_id'] ?? null,
//             'name' => isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null,
//             'short_description' => isset($_POST['short_description']) ? htmlspecialchars($_POST['short_description']) : null,
//             'full_description' => isset($_POST['full_description']) ? htmlspecialchars($_POST['full_description']) : null,
//             'cost' => isset($_POST['cost']) ? filter_var($_POST['cost'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null,
//             'state' => $_POST['state'] ?? null,
//             'start_at' => $_POST['start_at'] ?? null,
//             'stop_at' => $_POST['stop_at'] ?? null,
//             'end_at' => $_POST['end_at'] ?? null,
//             'photo' => $filenamenew ?? null,
//             'campaign_id' => $_POST['campaign_id']
//         ]
//     );

// } catch (PDOException $e) {
//     error_log($e->getMessage());
//     abort(500);
// }



// header("Location:". $_SERVER["HTTP_REFERER"]);
// die();