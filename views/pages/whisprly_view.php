<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>
    /* browse.css */

    /* General Body Styling (ensure consistency with header and footer) */
    body {
        font-family: 'Inter', sans-serif;
        /* Apply Inter font */
        background-color: #F8F5F0;
        /* Soft Cream/Off-White background */
        color: #36454F;
        /* Charcoal Gray text */
        margin: 0;
        padding: 0;
        line-height: 1.6;
        display: flex;
        /* Use flexbox for layout */
        flex-direction: column;
        /* Stack children vertically */
        min-height: 100vh;
        /* Ensure body takes at least full viewport height */
    }

    /* CSS for the main content wrapper to push the footer down */
    .main-content-wrapper {
        flex-grow: 1;
        /* Allow this section to grow and fill available space */
        padding: 1.5rem 1.5rem;
        /* Add padding */
    }

    /* Container for layout */
    .container-pod {
        max-width: 1200px;
        /* Max width similar to Tailwind container */
        margin: 0 auto;
        /* Center the container */
        display: flex;
        flex-direction: column;
        /* Stack children vertically */
        padding: 0 1.5rem;
        /* Padding for smaller screens */
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #00697B;
        /* Deep Teal for page title */
        margin-bottom: 2rem;
        text-align: center;
        /* Center the title */
    }

    /* Search and Filtering Area */
    .search-filter-area {
        display: flex;
        flex-direction: column;
        /* Stack search and filters vertically on small screens */
        gap: 1rem;
        /* Space between search and filters */
        margin-bottom: 2rem;
    }

    .search-bar {
        display: flex;
        gap: 0.5rem;
        /* Space between input and button */
        flex-grow: 1;
        /* Allow search bar to grow */
    }

    .search-input {
        flex-grow: 1;
        /* Allow input to fill space */
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        /* Light gray border */
        border-radius: 0.25rem;
        /* Slightly rounded corners */
        font-size: 1rem;
        color: #36454F;
    }

    .search-button {
        background-color: #00697B;
        /* Deep Teal background */
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }


    .search-button:hover {
        background-color: #005a6a;
        /* Slightly darker Teal on hover */
    }

    .filter-options {
        display: flex;
        gap: 1rem;
        /* Space between filter selects */
        flex-wrap: wrap;
        /* Allow filters to wrap on smaller screens */
    }

    .filter-select {
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        /* Light gray border */
        border-radius: 0.25rem;
        font-size: 1rem;
        color: #36454F;
        background-color: #F8F5F0;
        cursor: pointer;
    }

    /* Podcast Series Grid View */
    .podcast-series-grid {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 2fr));
        /* Responsive grid columns for series cards */
        gap: 1.5rem;
        /* Space between cards */
        margin-bottom: 2rem;
        width: 100%;
    }

    /* Individual Podcast Series Card Styling */
    .podcast-series-card {
        background-color: #F8F5F0;
        /* Soft Cream/Off-White background */
        border-radius: 0.5rem;
        /* Rounded corners */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        overflow: hidden;
        /* Hide overflow for rounded corners */
        display: flex;
        flex-direction: column;
        /* Stack content vertically */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Smooth transition for hover */
        cursor: pointer;
        /* Indicate clickable */
    }

    .podcast-series-card:hover {
        transform: translateY(-5px);
        /* Lift card on hover */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        /* Enhance shadow on hover */
    }

    .series-cover {
        width: 100%;
        /* Make image fill the card width */
        height: auto;
        /* Maintain aspect ratio */
        display: block;
        /* Remove extra space below image */
        aspect-ratio: 1 / 1;
        /* Square aspect ratio for podcast covers */
        object-fit: cover;
        /* Ensure cover fills the space without distortion */
    }

    .series-info {
        padding: 1rem;
        /* Padding inside the card */
        flex-grow: 1;
        /* Allow info section to grow */
        display: flex;
        flex-direction: column;
        white-space: nowrap;
        /* FIX: Prevent title from wrapping */
        overflow: hidden;
        /* FIX: Hide overflow */
        text-overflow: ellipsis;
        /* FIX: Add ellipsis for overflowed text */

    }

    .series-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #36454F;
        /* Charcoal Gray title */
        margin-bottom: 0.5rem;
    }

    .series-creator {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.8);
        /* Slightly lighter color for creator */
        margin-bottom: 0.5rem;
    }

    .series-description {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.8);
        /* Slightly lighter color for creator */
        margin-bottom: 0.5rem;
    }

    .series-category {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.8);
        /* Slightly lighter color for creator */
        margin-bottom: 0.5rem;
    }

    .series-episode {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.8);
        /* Slightly lighter color for creator */
        margin-bottom: 0.5rem;
    }

    .series-description {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.7);
        /* Lighter color for description */
        margin-top: auto;
        /* Push description to the bottom */
        /* Optional: Limit description lines */
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* Limit to 3 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        /* Center pagination buttons */
        gap: 0.5rem;
        /* Space between buttons */
        margin-top: 2rem;
    }

    .pagination-button {
        background-color: #E2725B;
        /* Warm Coral/Terracotta background */
        color: white;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .pagination-button:hover:not(.active) {
        background-color: #d1624c;
        /* Slightly darker Coral on hover */
    }

    .pagination-button.active {
        background-color: #00697B;
        /* Deep Teal for active button */
        cursor: default;
    }


    /* Responsive Adjustments for padding */
    @media (min-width: 768px) {

        /* Medium screens and up */
        .main-content-wrapper {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .search-filter-area {
            flex-direction: row;
            /* Arrange search and filters horizontally */
            align-items: center;
            /* Align items vertically */
        }

        .search-bar {
            flex-grow: 2;
            /* Allow search bar to take more space */
        }

        .filter-options {
            flex-grow: 1;
            /* Allow filters to take remaining space */
            justify-content: flex-end;
            /* Align filters to the right */
        }
    }

    @media (min-width: 1024px) {

        /* Large screens and up */
        .main-content-wrapper {
            padding-left: 4rem;
            padding-right: 4rem;
        }
    }

    a {
        text-decoration: none;
    }
</style>
<?php //dd($podcasts) 
?>
<?php require('views/partials/search.php') ?>

<h1 class="page-title">Whisprly Home</h1>


<main class="main-content-wrapper">
    <section class="browse-podcasts-section">

        <div class="container-prod">
            <div class="podcast-series-grid" id="content-container">
                <?php if (isset($podcasts)): foreach ($podcasts as $podcast): ?>

                        <a href="/views/pages/podcast/show_view?id=<?= htmlspecialchars($podcast['podcast_id']) ?>">
                            <div class="podcast-series-card">
                                <img src="/views/midea/images/<?= htmlspecialchars($podcast['cover_image'] ?? "image.png") ?>" alt="Podcast Series Cover" class="series-cover">
                                <div class="series-info">
                                    <h3 class="series-title"><?= htmlspecialchars($podcast['title']) ?></h3>
                                    <p class="series-creator"><?= htmlspecialchars($podcast['creator_name']) ?></p>
                                    <p class="series-description"><?= htmlspecialchars($podcast['description']) ?></p>
                                    <!-- <p class="series-episode"><?= htmlspecialchars($podcast['episode_count']) ?></p> -->
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <div id="loading-spinner" style="display: none; text-align: center; padding: 20px;">
        Loading more products...
    </div>
</main>

<script>
    // Set initial offset for JavaScript to pick up
    var initialOffset = <?php echo $limit; ?>;
</script>
<script src="views/js/infinite_scroll.js"></script>


<?php require('views/partials/footer.php') ?>