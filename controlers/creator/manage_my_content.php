<?php
$heading = "Manage My Content";

use core\App;
use core\Database;
//use core\Validator; // Assuming you have a Validator class for ID checks

$db = App::resolve(Database::class);

// --- Authorization Check (Crucial for Creator Pages) ---
// Ensure the user is logged in and has the appropriate role ('creator' or 'admin').
$currentUserId = $_SESSION['user']['user_id'] ?? null;
$currentUserRole = $_SESSION['user']['role'] ?? 'listener';

// if (!$currentUserId || ($currentUserRole !== 'creator' && $currentUserRole !== 'admin')) {
//     // If unauthorized, stop execution and show a forbidden error page.
//     abort(403);
// }
// --- End Authorization Check ---

try {
    // --- 1. Get Filters and Search Terms ---
    $search = $_GET['search'] ?? '';
    // Filter by content type: 'all', 'podcasts', 'books', 'episodes'
    $contentTypeFilter = $_GET['type'] ?? 'all';
    // Filter podcasts by status: 'all', 'published', 'pending', 'rejected'
    $podcastStatusFilter = $_GET['podcast_status'] ?? 'all';
    // Specific podcast ID for filtering episodes (if managing episodes for one podcast)
    $filterByPodcastId = $_GET['podcast_id'] ?? null;

    $creatorPodcasts = []; // To hold podcasts created by the user
    $creatorEpisodes = []; // To hold episodes belonging to the user's podcasts
    $creatorBooks = [];    // To hold books uploaded by the user

    // --- 2. Fetch Podcasts created by this user ---
    if ($contentTypeFilter === 'all' || $contentTypeFilter === 'podcasts') {
        $podcastQuery = "
            SELECT
                podcast_id,
                title,
                description,
                category,
                cover_image,
                status,
                created_at
            FROM podcasts
            WHERE created_by = :user_id
        ";
        $podcastParams = [
            'user_id' => $currentUserId
        ];

        if (!empty($search)) {
            // Using MATCH AGAINST requires FULLTEXT indexes on title, description
            $podcastQuery .= " AND MATCH(title, description) AGAINST (:search IN NATURAL LANGUAGE MODE)";
            $podcastParams['search'] = $search;
        }

        if ($podcastStatusFilter !== 'all' && in_array($podcastStatusFilter, ['published', 'pending', 'rejected'])) {
            $podcastQuery .= " AND status = :status_filter";
            $podcastParams['status_filter'] = $podcastStatusFilter;
        }

        $podcastQuery .= " ORDER BY created_at DESC;";
        $creatorPodcasts = $db->query($podcastQuery, $podcastParams)->fetchAll();
    }

    // --- 3. Fetch Episodes belonging to this user's podcasts ---
    // Only execute if filter is 'all', 'episodes', or if a specific podcast is selected
    if ($contentTypeFilter === 'all' || $contentTypeFilter === 'episodes' || !empty($filterByPodcastId)) {
        $episodeQuery = "
            SELECT
                e.episode_id,
                e.podcast_id,
                e.title,
                e.audio_file,
                e.duration,
                e.release_date,
                p.title AS podcast_title -- Get parent podcast title for display
            FROM episodes e
            JOIN podcasts p ON e.podcast_id = p.podcast_id
            WHERE p.created_by = :user_id
        ";
        $episodeParams = [
            'user_id' => $currentUserId
        ];

        // If filtering by a specific podcast
        if (!empty($filterByPodcastId) && Validator::number($filterByPodcastId, 1)) {
            // Important: Re-verify that the specific podcast_id belongs to the current user
            $checkPodcastOwnership = $db->query("
                SELECT podcast_id FROM podcasts WHERE podcast_id = :pid AND created_by = :uid
            ", [
                'pid' => $filterByPodcastId,
                'uid' => $currentUserId
            ])->fetch();

            if ($checkPodcastOwnership) {
                $episodeQuery .= " AND e.podcast_id = :podcast_id_filter";
                $episodeParams['podcast_id_filter'] = $filterByPodcastId;
            } else {
                // Invalid podcast_id or not owned by user, clear filter or show error
                $filterByPodcastId = null; // Prevent applying an invalid filter
            }
        }

        if (!empty($search)) {
            $episodeQuery .= " AND MATCH(e.title) AGAINST (:search IN NATURAL LANGUAGE MODE)";
            $episodeParams['search'] = $search;
        }

        $episodeQuery .= " ORDER BY e.release_date DESC;";
        $creatorEpisodes = $db->query($episodeQuery, $episodeParams)->fetchAll();
    }

    // --- 4. Fetch Books uploaded by this user ---
    if ($contentTypeFilter === 'all' || $contentTypeFilter === 'books') {
        $bookQuery = "
            SELECT
                book_id,
                title,
                description,
                pdf_file,
                topic,
                linked_podcast_id,
                created_at
            FROM books
            WHERE uploaded_by = :user_id
        ";
        $bookParams = [
            'user_id' => $currentUserId
        ];

        if (!empty($search)) {
            $bookQuery .= " AND MATCH(title, description, topic) AGAINST (:search IN NATURAL LANGUAGE MODE)";
            $bookParams['search'] = $search;
        }

        $bookQuery .= " ORDER BY created_at DESC;";
        $creatorBooks = $db->query($bookQuery, $bookParams)->fetchAll();
    }

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500); // Internal Server Error
}

// Pass all fetched data and filter states to the view
require "views/pages/creator/manage_my_content_view.php";







