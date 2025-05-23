<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>


<style>

/* podcast-series.css */

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

/* Universal Box Sizing for consistent layout behavior */
*, *::before, *::after {
    box-sizing: border-box;
}

/* CSS for the main content wrapper to push the footer down */
.main-content-wrapper {
    flex-grow: 1; /* Allow this section to grow and fill available space */
    padding: 1.5rem 1.5rem; /* Add padding */
}

/* Container for layout */
.containerr {
    max-width: 1200px; /* Max width similar to Tailwind container */
    margin: 0 auto; /* Center the container */
    display: flex;
    flex-direction: column; /* Stack children vertically */
    padding: 0 1.5rem; /* Padding for smaller screens */
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
    flex-grow: 1; /* Allow info to grow on larger screens */
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

.action-buttons-group { /* New: Group for subscribe and read book buttons */
    display: flex;
    flex-direction: column; /* Stack buttons vertically on small screens */
    gap: 1rem; /* Space between buttons */
    justify-content: center; /* Center buttons horizontally */
    align-items: center; /* Center buttons horizontally */
}

.subscribe-button,
.read-book-button { /* Combined styles for both buttons */
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
    text-decoration: none; /* For anchor tag if used */
}

.subscribe-button:hover,
.read-book-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}

/* Specific style for read book button if it needs different color */
.read-book-button {
    background-color: #E2725B; /* Warm Coral/Terracotta background, similar to play/download */
}

.read-book-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}


/* --- Custom Podcast Audio Player Styles --- */
.podcast-player-container {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 2.5rem; /* Space below the player */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.podcast-player-container .podcast-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e5e7eb; /* Separator for header */
}

.podcast-player-container .podcast-cover {
    width: 60px;
    height: 60px;
    border-radius: 0.25rem;
    object-fit: cover;
    flex-shrink: 0; /* Prevent cover from shrinking */
}

.podcast-player-container .episode-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    min-width: 0; /* Allows text to ellipsis */
}

.podcast-player-container .podcast-title {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.7);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.podcast-player-container .episode-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #36454F;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.podcast-player-container .controls {
    display: flex;
    flex-wrap: wrap; /* Allow controls to wrap on small screens */
    align-items: center;
    gap: 1rem;
}

.podcast-player-container .control-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px; /* Size for play/pause button */
    height: 45px;
    border-radius: 50%; /* Make it round */
    background-color: #E2725B; /* Warm Coral background */
    transition: background-color 0.3s ease;
    flex-shrink: 0;
}

.podcast-player-container .control-button:hover {
    background-color: #d1624c; /* Darker coral on hover */
}

.podcast-player-container .control-button .play-pause-icon {
    width: 24px;
    height: 24px;
    filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(288deg) brightness(102%) contrast(102%); /* White icon */
}


.podcast-player-container .progress-container {
    display: flex;
    align-items: center;
    flex-grow: 1; /* Allow progress bar to take space */
    gap: 0.75rem;
    min-width: 150px; /* Ensure it doesn't get too small */
}

.podcast-player-container .time-display {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8);
    flex-shrink: 0; /* Prevent time from shrinking */
}

/* Custom styling for range input (progress bar) */
.podcast-player-container .progress-bar {
    -webkit-appearance: none; /* Remove default styling */
    width: 100%;
    height: 8px; /* Height of the track */
    background: linear-gradient(to right, #00697B var(--progress-value, 0%), #d1d5db var(--progress-value, 0%)); /* Filled track */
    border-radius: 4px;
    outline: none;
    cursor: pointer;
    transition: background 0.2s ease;
    --progress-value: 0%; /* Custom property for filled part */
}

.podcast-player-container .progress-bar::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #E2725B; /* Warm Coral thumb */
    cursor: pointer;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
    margin-top: -6px; /* Center thumb vertically */
}

.podcast-player-container .progress-bar::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #E2725B; /* Warm Coral thumb */
    cursor: pointer;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
}

.podcast-player-container .progress-bar::-webkit-slider-runnable-track {
    background: transparent; /* Track is handled by linear-gradient on the input itself */
}

.podcast-player-container .progress-bar::-moz-range-track {
    background: transparent; /* Track is handled by linear-gradient on the input itself */
}

/* Volume Control */
.podcast-player-container .volume-container {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-shrink: 0; /* Prevent volume control from shrinking */
    width: 150px; /* Fixed width for volume control */
}

.podcast-player-container .volume-container .fas {
    color: #00697B; /* Deep Teal icons */
    font-size: 1.1rem;
}

/* Custom styling for volume slider */
.podcast-player-container .volume-slider {
    -webkit-appearance: none;
    width: 100%;
    height: 6px;
    background: linear-gradient(to right, #00697B var(--volume-value, 100%), #d1d5db var(--volume-value, 100%)); /* Filled track */
    border-radius: 3px;
    outline: none;
    cursor: pointer;
    transition: background 0.2s ease;
    --volume-value: 100%; /* Custom property for filled part */
}

.podcast-player-container .volume-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #E2725B; /* Warm Coral thumb */
    cursor: pointer;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
    margin-top: -5px; /* Center thumb vertically */
}

.podcast-player-container .volume-slider::-moz-range-thumb {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #E2725B; /* Warm Coral thumb */
    cursor: pointer;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
}

/* --- End Custom Podcast Audio Player Styles --- */


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
    transition: background-color 0.2s ease;
}

.episode-item:hover {
    background-color: #F0EDE8; /* Slightly darker cream on hover */
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
    width: 100%;
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

/* --- PDF Viewer Styles --- */
.pdf-viewer-section {
    margin-bottom: 3rem;
    /* Initially hidden */
    display: none; /* Hide by default */
}

/* Style to show the PDF viewer when active */
.pdf-viewer-section.pdf-viewer-visible {
    display: block; /* Or flex, depending on its internal layout */
}


.pdf-viewer-section h2 {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal heading */
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
    padding-bottom: 0.75rem;
}

.pdf-viewer-container {
    background-color: white; /* White background for the viewer area */
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    overflow: hidden; /* Ensure iframe respects border-radius */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    display: flex; /* To center iframe if needed, or simply contain it */
    justify-content: center;
    align-items: center;
    /* max-width: 100%; Not strictly needed with width: 100% on iframe */
}

.pdf-viewer-container iframe {
    width: 100%; /* Full width of its container */
    height: 700px; /* Fixed height, adjust as needed */
    display: block; /* Remove extra space below iframe */
    border: none; /* Remove iframe's default border */
}
/* --- End PDF Viewer Styles --- */


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

    .action-buttons-group { /* Group buttons horizontally on larger screens */
        flex-direction: row;
        justify-content: flex-start; /* Align buttons to the left */
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

    .podcast-player-container .controls {
        flex-wrap: nowrap; /* Prevent controls from wrapping on larger screens */
    }

    .podcast-player-container .progress-container {
        min-width: 250px; /* Give more space on larger screens */
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
        <div class="containerr">
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
                    <div class="action-buttons-group"> <button class="subscribe-button">
                            <i class="fas fa-plus-circle"></i> Subscribe
                        </button>
                        <button id="readBookButton" class="read-book-button" data-pdf-src="/views/midea/pdfs/modern-java-in-action-lambda-streams-functional-and-reactive-programming_compress (4).pdf#toolbar=1&navpanes=0&scrollbar=0&zoom=page-width">
                            <i class="fas fa-book-reader"></i> Read Full Book
                        </button>
                    </div>
                </div>
            </div>

            <div class="podcast-player-container">
                <div class="podcast-header">
                    <img src="/views/midea/images/image.png" alt="Podcast Episode Cover" class="podcast-cover">
                    <div class="episode-info">
                        <span class="podcast-title">My Awesome Podcast</span>
                        <span class="episode-title">Episode 1: The Beginning</span>
                    </div>
                </div>

                <audio id="audioPlayer" src="/views/midea/sounds/JavaThreading.mp3" preload="metadata"></audio>

                <div class="controls">
                    <button id="playPauseButton" class="control-button" aria-label="Play/Pause">
                        <img src="/views/midea/icons/play.png" alt="Play Icon" class="play-pause-icon">
                    </button>

                    <div class="progress-container">
                        <span id="currentTime" class="time-display">0:00</span>
                        <input type="range" id="progressBar" class="progress-bar" value="0" min="0" max="100">
                        <span id="durationTime" class="time-display">0:00</span>
                    </div>

                    <div class="volume-container">
                        <i class="fas fa-volume-down"></i>
                        <input type="range" id="volumeControl" class="volume-slider" value="100" min="0" max="100">
                        <i class="fas fa-volume-up"></i>
                    </div>
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

            <div id="pdfViewerSection" class="pdf-viewer-section"> <h2>Read Along (Example Book)</h2>
                <div class="pdf-viewer-container">
                    <iframe id="pdfViewerIframe" src="" width="100%" height="700px" frameborder="0">
                        This browser does not support PDFs. Please <a href="/views/midea/pdfs/modern-java-in-action-lambda-streams-functional-and-reactive-programming_compress (4).pdf">download the PDF</a> instead.
                    </iframe>
                </div>
            </div>
            </div>
    </section>
</main>


<script>
    // --- Utility Functions ---
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = Math.floor(seconds % 60);
        return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    }

    // Wrap your code in DOMContentLoaded to ensure elements are loaded
    document.addEventListener('DOMContentLoaded', () => {
        // --- Get references to HTML elements ---
        const audioPlayer = document.getElementById('audioPlayer');
        const playPauseButton = document.getElementById('playPauseButton');
        const playPauseIcon = playPauseButton.querySelector('.play-pause-icon');
        const progressBar = document.getElementById('progressBar');
        const currentTimeSpan = document.getElementById('currentTime');
        const durationTimeSpan = document.getElementById('durationTime');
        const volumeControl = document.getElementById('volumeControl');

        const readBookButton = document.getElementById('readBookButton');
        const pdfViewerSection = document.getElementById('pdfViewerSection');
        const pdfViewerIframe = document.getElementById('pdfViewerIframe');

        // Initially hide the PDF viewer section
        pdfViewerSection.classList.add('pdf-viewer-hidden'); // Ensure it's hidden on load

        let isSeeking = false; // Flag to prevent timeupdate from overriding manual seek


        // --- Event Listeners ---

        // Play/Pause functionality
        playPauseButton.addEventListener('click', () => {
            if (audioPlayer.paused) {
                audioPlayer.play();
                playPauseIcon.src = '/views/midea/icons/pause.png';
                playPauseButton.setAttribute('aria-label', 'Pause');
            } else {
                audioPlayer.pause();
                playPauseIcon.src = '/views/midea/icons/play.png';
                playPauseButton.setAttribute('aria-label', 'Play');
            }
        });

        // Update progress bar and current time
        audioPlayer.addEventListener('timeupdate', () => {
            if (!isSeeking && audioPlayer.duration) {
                const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                progressBar.value = progress;
                progressBar.style.setProperty('--progress-value', `${progress}%`);
                currentTimeSpan.textContent = formatTime(audioPlayer.currentTime);
            }
        });

        // Set duration when audio metadata is loaded
        audioPlayer.addEventListener('loadedmetadata', () => {
            durationTimeSpan.textContent = formatTime(audioPlayer.duration);
            progressBar.max = 100;
            progressBar.value = 0;
            progressBar.style.setProperty('--progress-value', '0%');
            currentTimeSpan.textContent = formatTime(0);
        });

        // Handle audio ending
        audioPlayer.addEventListener('ended', () => {
            playPauseIcon.src = '/views/midea/icons/play.png';
            playPauseButton.setAttribute('aria-label', 'Play');
            audioPlayer.currentTime = 0;
            progressBar.value = 0;
            progressBar.style.setProperty('--progress-value', '0%');
            currentTimeSpan.textContent = formatTime(0);
        });

        // Manual scrubbing (drag/click on progress bar)
        progressBar.addEventListener('input', () => {
            isSeeking = true;
            if (audioPlayer.duration) {
                const seekTime = (progressBar.value / 100) * audioPlayer.duration;
                currentTimeSpan.textContent = formatTime(seekTime);
                progressBar.style.setProperty('--progress-value', `${progressBar.value}%`);
            }
        });

        progressBar.addEventListener('change', () => {
            if (audioPlayer.duration) {
                const seekTime = (progressBar.value / 100) * audioPlayer.duration;
                audioPlayer.currentTime = seekTime;
            }
            isSeeking = false;
        });

        // Volume control
        volumeControl.addEventListener('input', () => {
            const volume = volumeControl.value / 100;
            audioPlayer.volume = volume;
            volumeControl.style.setProperty('--volume-value', `${volumeControl.value}%`);
        });

        // Initialize volume slider position based on default audio volume
        volumeControl.value = audioPlayer.volume * 100;
        volumeControl.style.setProperty('--volume-value', `${volumeControl.value}%`);

        // Handle cases where metadata might already be loaded before listener
        if (audioPlayer.readyState >= 2) {
            durationTimeSpan.textContent = formatTime(audioPlayer.duration);
            progressBar.max = 100;
        }

        // New: Event listener for "Read Full Book" button
        if (readBookButton && pdfViewerSection && pdfViewerIframe) {
            readBookButton.addEventListener('click', () => {
                // FIX: Corrected dataset access from dataset.pdf-src to dataset.pdfSrc
                const pdfSrc = readBookButton.dataset.pdfSrc;
                const isHidden = pdfViewerSection.classList.contains('pdf-viewer-hidden');

                if (isHidden) {
                    // Show the PDF viewer
                    pdfViewerSection.classList.remove('pdf-viewer-hidden');
                    pdfViewerSection.classList.add('pdf-viewer-visible');
                    pdfViewerIframe.src = pdfSrc; // Load PDF into the iframe
                    readBookButton.innerHTML = '<i class="fas fa-book-open"></i> Hide Book'; // Change button text/icon
                    pdfViewerSection.scrollIntoView({ behavior: 'smooth', block: 'start' }); // Scroll to it
                } else {
                    // Hide the PDF viewer
                    pdfViewerSection.classList.remove('pdf-viewer-visible');
                    pdfViewerSection.classList.add('pdf-viewer-hidden');
                    pdfViewerIframe.src = ''; // Clear iframe src to stop loading/free resources
                    readBookButton.innerHTML = '<i class="fas fa-book-reader"></i> Read Full Book'; // Change button text/icon
                }
            });
        }
    }); // End of DOMContentLoaded
</script>

    <?php require('views/partials/footer.php') ?>