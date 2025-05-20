<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* podcast-series.css */

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
    max-width: 1200px; /* Max width similar to Tailwind container */
    margin: 0 auto; /* Center the container */
}

/* Series Header Section */
.series-header {
    display: flex;
    flex-direction: column; /* Stack elements vertically on small screens */
    align-items: center; /* Center items horizontally */
    gap: 2rem; /* Space between cover and info */
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
}

.series-cover-large {
    width: 200px; /* Fixed width for the large cover */
    height: 200px; /* Fixed height */
    border-radius: 0.5rem; /* Rounded corners */
    object-fit: cover; /* Ensure cover fills the space */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.series-info-large {
    text-align: center; /* Center text on small screens */
}

.series-title-large {
    font-size: 2rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal title */
    margin-bottom: 0.5rem;
}

.series-creator-large {
    font-size: 1.1rem;
    color: rgba(54, 69, 79, 0.9); /* Slightly lighter color for creator */
    margin-bottom: 1rem;
}

.series-description-large {
    font-size: 1rem;
    color: #36454F; /* Charcoal Gray text */
    margin-bottom: 1.5rem;
    max-width: 800px; /* Limit description width */
    margin-left: auto;
    margin-right: auto;
}

.series-meta-tags {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center; /* Center tags */
    flex-wrap: wrap; /* Allow tags to wrap */
    gap: 0.5rem; /* Space between tags */
}

.meta-tag {
    display: inline-block;
    background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    font-size: 0.8rem;
    padding: 0.25rem 0.75rem;
    border-radius: 0.75rem; /* More rounded pills */
    font-weight: 500;
}

.subscribe-button {
    background-color: #00697B; /* Deep Teal background */
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

.subscribe-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}

/* Episodes List Section */
.episodes-list {
    margin-bottom: 3rem;
}

.episodes-list h2 {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal heading */
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
    padding-bottom: 0.75rem;
}

.episodes-list ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.episode-item {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.25rem;
    padding: 1rem;
    margin-bottom: 0.75rem;
    display: flex;
    flex-direction: column; /* Stack details and actions vertically on small screens */
    gap: 1rem; /* Space between details and actions */
    align-items: flex-start; /* Align items to the start */
}

.episode-details {
    flex-grow: 1; /* Allow details to take available space */
}

.episode-number {
    font-size: 1rem;
    font-weight: bold;
    color: #E2725B; /* Warm Coral/Terracotta number */
    margin-right: 0.5rem;
}

.episode-title {
    font-size: 1.1rem;
    font-weight: 600; /* Semi-bold */
    color: #36454F; /* Charcoal Gray title */
    margin-bottom: 0.25rem;
}

.episode-duration,
.episode-date {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.7); /* Lighter color */
    margin-right: 1rem;
}

.episode-actions {
    display: flex;
    gap: 0.75rem; /* Space between buttons */
    flex-shrink: 0; /* Prevent actions from shrinking */
}

.play-button,
.download-button {
    background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: inline-flex; /* Align icon and text */
    align-items: center;
    gap: 0.25rem; /* Space between icon and text */
}

.play-button:hover,
.download-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}


/* Related Books Section */
.related-books-section {
    margin-bottom: 3rem;
}

.related-books-section h2 {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal heading */
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
    padding-bottom: 0.75rem;
}

.related-books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); /* Responsive grid for smaller book cards */
    gap: 1rem; /* Space between book cards */
}

.related-book-card {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border-radius: 0.5rem; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    overflow: hidden; /* Hide overflow for rounded corners */
    display: flex;
    flex-direction: column; /* Stack content vertically */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover */
    cursor: pointer; /* Indicate clickable */
}

.related-book-card:hover {
    transform: translateY(-5px); /* Lift card on hover */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Enhance shadow on hover */
}

.related-book-cover {
    width: 100%; /* Make image fill the card width */
    height: auto; /* Maintain aspect ratio */
    display: block; /* Remove extra space below image */
    aspect-ratio: 2 / 3; /* Portrait aspect ratio for book covers */
    object-fit: cover; /* Ensure cover fills the space without distortion */
}

.related-book-info {
    padding: 0.75rem; /* Padding inside the card */
    flex-grow: 1; /* Allow info section to grow */
    display: flex;
    flex-direction: column;
    text-align: center; /* Center text */
}

.related-book-title {
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

.related-book-author {
    font-size: 0.8rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color for author */
    margin-bottom: 0.5rem;
}

.related-book-link {
    display: inline-block;
    margin-top: auto; /* Push link to the bottom */
    font-size: 0.8rem;
    color: #00697B; /* Deep Teal link color */
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.related-book-link:hover {
    color: #E2725B; /* Warm Coral/Terracotta on hover */
}


/* Responsive Adjustments */
@media (min-width: 768px) { /* Medium screens and up */
    .main-content-wrapper {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
    }

    .series-header {
        flex-direction: row; /* Arrange elements horizontally */
        text-align: left; /* Align text to the left */
        align-items: flex-start; /* Align items to the top */
    }

    .series-info-large {
        text-align: left; /* Align text to the left */
        flex-grow: 1; /* Allow info to grow */
    }

    .series-meta-tags {
        justify-content: flex-start; /* Align tags to the left */
    }

    .episode-item {
         flex-direction: row; /* Arrange details and actions horizontally */
         align-items: center; /* Align items vertically */
    }

    .episode-details {
        flex-grow: 1; /* Allow details to take available space */
    }

    .episode-actions {
        flex-shrink: 0; /* Prevent actions from shrinking */
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
        <section class="podcast-series-detail-section">
            <div class="container">
                <div class="series-header">
                    <img src="https://placehold.co/300x300/00697B/F8F5F0?text=Series+Cover" alt="Podcast Series Cover" class="series-cover-large">
                    <div class="series-info-large">
                        <h1 class="series-title-large">Podcast Series Title</h1>
                        <p class="series-creator-large">By Creator Name</p>
                        <p class="series-description-large">A detailed description of the podcast series, covering its themes, format, and target audience. This section provides potential listeners with enough information to decide if they want to subscribe.</p>
                        <div class="series-meta-tags">
                            <span class="meta-tag">Technology</span>
                            <span class="meta-tag">Innovation</span>
                            <span class="meta-tag">Business</span>
                        </div>
                        <button class="subscribe-button">
                            <i class="fas fa-plus-circle"></i> Subscribe
                        </button>
                    </div>
                </div>

                <div class="episodes-list">
                    <h2>Episodes</h2>
                    <ul>
                        <li class="episode-item">
                            <div class="episode-details">
                                <span class="episode-number">#1</span>
                                <h3 class="episode-title">Episode Title One</h3>
                                <span class="episode-duration">35 min</span>
                                <span class="episode-date">Released: 2023-10-27</span>
                            </div>
                            <div class="episode-actions">
                                <button class="play-button"><i class="fas fa-play"></i> Play</button>
                                <button class="download-button"><i class="fas fa-download"></i> Download</button>
                            </div>
                        </li>
                         <li class="episode-item">
                            <div class="episode-details">
                                <span class="episode-number">#2</span>
                                <h3 class="episode-title">Episode Title Two: Deep Dive</h3>
                                <span class="episode-duration">50 min</span>
                                <span class="episode-date">Released: 2023-11-03</span>
                            </div>
                            <div class="episode-actions">
                                <button class="play-button"><i class="fas fa-play"></i> Play</button>
                                <button class="download-button"><i class="fas fa-download"></i> Download</button>
                            </div>
                        </li>
                         <li class="episode-item">
                            <div class="episode-details">
                                <span class="episode-number">#3</span>
                                <h3 class="episode-title">Episode Title Three: Future Trends</h3>
                                <span class="episode-duration">40 min</span>
                                <span class="episode-date">Released: 2023-11-10</span>
                            </div>
                            <div class="episode-actions">
                                <button class="play-button"><i class="fas fa-play"></i> Play</button>
                                <button class="download-button"><i class="fas fa-download"></i> Download</button>
                            </div>
                        </li>
                        </ul>
                </div>

                <div class="related-books-section">
                    <h2>Related Books</h2>
                    <div class="related-books-grid">
                        <div class="related-book-card">
                            <img src="https://placehold.co/150x225/FF7F50/F8F5F0?text=Book+Cover" alt="Related Book Cover" class="related-book-cover">
                            <div class="related-book-info">
                                <h3 class="related-book-title">Related Book Title</h3>
                                <p class="related-book-author">By Author Name</p>
                                <a href="#" class="related-book-link">View Book</a>
                            </div>
                        </div>
                         <div class="related-book-card">
                            <img src="https://placehold.co/150x225/00697B/F8F5F0?text=Book+Cover+2" alt="Related Book Cover" class="related-book-cover">
                            <div class="related-book-info">
                                <h3 class="related-book-title">Another Related Book</h3>
                                <p class="related-book-author">By Another Author</p>
                                <a href="#" class="related-book-link">View Book</a>
                            </div>
                        </div>
                          <div class="related-book-card">
                            <img src="https://placehold.co/150x225/FF7F50/F8F5F0?text=Book+Cover+3" alt="Related Book Cover" class="related-book-cover">
                            <div class="related-book-info">
                                <h3 class="related-book-title">Third Related Book</h3>
                                <p class="related-book-author">By Third Author</p>
                                <a href="#" class="related-book-link">View Book</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require('views/partials/footer.php') ?>