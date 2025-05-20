<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* book-detail.css */

/* General Body Styling (ensure consistency with header and footer) */
body {
    font-family: 'Inter', sans-serif; /* Apply Inter font */
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    color: #36454F; /* Charcoal Gray text */
    margin: 0;
    padding: 0;
    line-height: 1.6;
    display: flex; /* Use flexbox for layout */
    flex-direction: column; /* Stack children vertically */
    min-height: 100vh; /* Ensure body takes at least full viewport height */
}

/* CSS for the main content wrapper to push the footer down */
.main-content-wrapper {
    flex-grow: 1; /* Allow this section to grow and fill available space */
    padding: 1.5rem 1.5rem; /* Add padding */
}

/* Container for layout */
.container {
    max-width: 900px; /* Container width for book details */
    margin: 0 auto; /* Center the container */
}

/* Book Header Section */
.book-header {
    display: flex;
    flex-direction: column; /* Stack elements vertically on small screens */
    align-items: center; /* Center items horizontally */
    gap: 2rem; /* Space between cover and info */
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
}

.book-cover-large {
    width: 250px; /* Fixed width for the large cover */
    height: auto; /* Maintain aspect ratio */
    border-radius: 0.5rem; /* Rounded corners */
    object-fit: cover; /* Ensure cover fills the space */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    aspect-ratio: 2 / 3; /* Portrait aspect ratio */
}

.book-info-large {
    text-align: center; /* Center text on small screens */
}

.book-title-large {
    font-size: 2rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal title */
    margin-bottom: 0.5rem;
}

.book-author-large {
    font-size: 1.1rem;
    color: rgba(54, 69, 79, 0.9); /* Slightly lighter color for author */
    margin-bottom: 1rem;
}

.book-description-large {
    font-size: 1rem;
    color: #36454F; /* Charcoal Gray text */
    margin-bottom: 1.5rem;
    max-width: 700px; /* Limit description width */
    margin-left: auto;
    margin-right: auto;
}

.book-meta {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center; /* Center meta items */
    flex-wrap: wrap; /* Allow items to wrap */
    gap: 1rem; /* Space between meta items */
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8);
}

.book-access-options {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center; /* Center buttons */
    flex-wrap: wrap;
    gap: 1rem; /* Space between buttons */
}

.access-button {
    background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: inline-flex; /* Align icon and text */
    align-items: center;
    gap: 0.5rem; /* Space between icon and text */
    text-decoration: none; /* Remove underline for links */
}

.access-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}

.in-app-button {
    background-color: #00697B; /* Deep Teal for in-app */
}

.in-app-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}

.external-link-button {
    background-color: #FF7F50; /* Warm Coral/Terracotta for external link */
}

.external-link-button:hover {
     background-color: #e2725b; /* Slightly darker Coral on hover */
}


.action-button.add-to-library-button {
     background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: inline-flex; /* Align icon and text */
    align-items: center;
    gap: 0.5rem; /* Space between icon and text */
}

.action-button.add-to-library-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}


/* Related Podcasts Section */
.related-podcasts-section {
    margin-bottom: 3rem;
}

.related-podcasts-section h2 {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal heading */
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
    padding-bottom: 0.75rem;
}

.related-podcasts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Responsive grid for smaller podcast cards */
    gap: 1rem; /* Space between podcast cards */
}

.related-podcast-card {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border-radius: 0.5rem; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    overflow: hidden; /* Hide overflow for rounded corners */
    display: flex;
    flex-direction: column; /* Stack content vertically */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover */
    cursor: pointer; /* Indicate clickable */
}

.related-podcast-card:hover {
    transform: translateY(-5px); /* Lift card on hover */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Enhance shadow on hover */
}

.related-podcast-cover {
    width: 100%; /* Make image fill the card width */
    height: auto; /* Maintain aspect ratio */
    display: block; /* Remove extra space below image */
    aspect-ratio: 1 / 1; /* Square aspect ratio for podcast covers */
    object-fit: cover; /* Ensure cover fills the space without distortion */
}

.related-podcast-info {
    padding: 0.75rem; /* Padding inside the card */
    flex-grow: 1; /* Allow info section to grow */
    display: flex;
    flex-direction: column;
    text-align: center; /* Center text */
}

.related-podcast-title {
    font-size: 0.9rem;
    font-weight: bold;
    color: #36454F; /* Charcoal Gray title */
    margin-bottom: 0.25rem;
     /* Optional: Limit title lines */
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Limit to 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.related-podcast-creator {
    font-size: 0.8rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color for creator */
    margin-bottom: 0.5rem;
}

.related-podcast-link {
    display: inline-block;
    margin-top: auto; /* Push link to the bottom */
    font-size: 0.8rem;
    color: #00697B; /* Deep Teal link color */
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.related-podcast-link:hover {
    color: #E2725B; /* Warm Coral/Terracotta on hover */
}


/* Responsive Adjustments */
@media (min-width: 768px) { /* Medium screens and up */
    .main-content-wrapper {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
    }

    .book-header {
        flex-direction: row; /* Arrange elements horizontally */
        text-align: left; /* Align text to the left */
        align-items: flex-start; /* Align items to the top */
    }

    .book-info-large {
        text-align: left; /* Align text to the left */
        flex-grow: 1; /* Allow info to grow */
    }

    .book-meta,
    .book-access-options {
        justify-content: flex-start; /* Align items to the left */
    }
}

@media (min-width: 1024px) { /* Large screens and up */
    .main-content-wrapper {
        padding-left: 4rem;
        padding-right: 4rem;
    }
}



</style>

 <main class="main-content-wrapper">
        <section class="book-detail-section">
            <div class="container">
                <div class="book-header">
                    <img src="https://placehold.co/300x450/FF7F50/F8F5F0?text=Book+Cover" alt="Book Cover" class="book-cover-large">
                    <div class="book-info-large">
                        <h1 class="book-title-large">Book Title Goes Here</h1>
                        <p class="book-author-large">By Author Name</p>
                        <p class="book-description-large">A detailed description of the book, covering its plot, themes, and style. This section provides potential readers with enough information to decide if they want to read it.</p>
                        <div class="book-meta">
                            <span class="meta-item"><strong>Genre:</strong> [Genre]</span>
                            <span class="meta-item"><strong>Publication Date:</strong> [Date]</span>
                        </div>

                        <div class="book-access-options">
                            <button class="access-button in-app-button">
                                <i class="fas fa-book-reader"></i> Read In-App
                            </button>
                            </div>

                        <button class="action-button add-to-library-button">
                            <i class="fas fa-plus"></i> Add to Library
                        </button>
                    </div>
                </div>

                <div class="related-podcasts-section">
                    <h2>Related Podcasts</h2>
                    <div class="related-podcasts-grid">
                        <div class="related-podcast-card">
                             <img src="https://placehold.co/150x150/00697B/F8F5F0?text=Podcast+Cover" alt="Related Podcast Cover" class="related-podcast-cover">
                            <div class="related-podcast-info">
                                <h3 class="related-podcast-title">Related Podcast Title</h3>
                                <p class="related-podcast-creator">By Creator Name</p>
                                <a href="#" class="related-podcast-link">Listen Now</a>
                            </div>
                        </div>
                         <div class="related-podcast-card">
                             <img src="https://placehold.co/150x150/FF7F50/F8F5F0?text=Podcast+Cover+2" alt="Related Podcast Cover" class="related-podcast-cover">
                            <div class="related-podcast-info">
                                <h3 class="related-podcast-title">Another Related Podcast</h3>
                                <p class="related-podcast-creator">By Another Creator</p>
                                <a href="#" class="related-podcast-link">Listen Now</a>
                            </div>
                        </div>
                         <div class="related-podcast-card">
                             <img src="https://placehold.co/150x150/00697B/F8F5F0?text=Podcast+Cover+3" alt="Related Podcast Cover" class="related-podcast-cover">
                            <div class="related-podcast-info">
                                <h3 class="related-podcast-title">Third Related Podcast</h3>
                                <p class="related-podcast-creator">By Third Creator</p>
                                <a href="#" class="related-podcast-link">Listen Now</a>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </section>
    </main>

<?php require('views/partials/footer.php') ?>