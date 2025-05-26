<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php require('views/partials/search.php') ?>
<style>
    /* browse-books.css */

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
    .container-book {
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

    /* Book Grid View */
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        /* Responsive grid columns for book cards */
        gap: 1.5rem;
        /* Space between cards */
        margin-bottom: 2rem;
        width: 100%;
    }

    /* Individual Book Card Styling */
    .book-card {
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

    .book-card:hover {
        transform: translateY(-5px);
        /* Lift card on hover */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        /* Enhance shadow on hover */
    }

    .book-cover {
        width: 100%;
        /* Make image fill the card width */
        height: auto;
        /* Maintain aspect ratio */
        display: block;
        /* Remove extra space below image */
        aspect-ratio: 2 / 3;
        /* Portrait aspect ratio for book covers */
        object-fit: cover;
        /* Ensure cover fills the space without distortion */
    }

    .book-info {
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

    .book-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #36454F;
        /* Charcoal Gray title */
        margin-bottom: 0.5rem;
    }

    .book-author {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.8);
        /* Slightly lighter color for author */
        margin-bottom: 0.5rem;
    }

    .book-topic {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.8);
        /* Slightly lighter color for author */
        margin-bottom: 0.5rem;
    }

    .book-description {
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

    .book-access {
        margin-top: 0.75rem;
    }

    .access-type {
        display: inline-block;
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: 500;
    }

    .access-type.in-app {
        background-color: #00697B;
        /* Deep Teal background */
        color: white;
    }

    .access-type.external-link {
        background-color: #FF7F50;
        /* Warm Coral/Terracotta background */
        color: white;
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
<?php //dd($books) 
?>


<h1 class="page-title">Browse Books</h1>
<main class="main-content-wrapper">
    <section class="browse-books-section">
        <div class="container-book">


            <div class="book-grid">

                <?php if (isset($books)): foreach ($books as $book): ?>


                        <a href="/views/pages/podcast/show_view?id=<?= htmlspecialchars($book['book_id']) ?>">
                            <div class="book-card">
                                <img src="/views/midea/images/<?= htmlspecialchars($book['cover_image'] ?? "image.png") ?>" alt="Book Cover" class="book-cover">
                                <div class="book-info">
                                    <h3 class="book-title"><?= htmlspecialchars($book['title']) ?></h3>
                                    <p class="book-author"><?= htmlspecialchars($book['created_by']) ?></p>
                                    <p class="book-description"><?= htmlspecialchars($book['description']) ?></p>
                                    <div class="book-access">
                                        <span class="access-type in-app">Readable In-App</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- <div class="book-card">
                        <img src="https://placehold.co/300x450/00697B/F8F5F0?text=Book+Cover+2" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title">Another Interesting Read</h3>
                            <p class="book-author">By Another Author</p>
                            <p class="book-description">Dive into this captivating story...</p>
                             <div class="book-access">
                                <span class="access-type external-link">External Link</span>
                            </div>
                        </div>
                    </div>

                     <div class="book-card">
                        <img src="https://placehold.co/300x450/FF7F50/F8F5F0?text=Book+Cover+3" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title">A Guide to Something</h3>
                            <p class="book-author">By Expert</p>
                            <p class="book-description">Learn everything you need to know about this topic...</p>
                             <div class="book-access">
                                <span class="access-type in-app">Readable In-App</span>
                            </div>
                        </div>
                    </div>

                     <div class="book-card">
                        <img src="https://placehold.co/300x450/00697B/F8F5F0?text=Book+Cover+4" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title">Classic Novel</h3>
                            <p class="book-author">By Famous Writer</p>
                            <p class="book-description">A timeless piece of literature...</p>
                             <div class="book-access">
                                <span class="access-type in-app">Readable In-App</span>
                            </div>
                        </div>
                    </div>
                </div> -->

            <div class="pagination">
                <button class="pagination-button">&laquo; Previous</button>
                <button class="pagination-button active">1</button>
                <button class="pagination-button">2</button>
                <button class="pagination-button">3</button>
                <button class="pagination-button">Next &raquo;</button>
            </div>
        </div>
    </section>
</main>
<?php require('views/partials/footer.php') ?>