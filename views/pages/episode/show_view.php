<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>


<style>
    /* episode-listening.css */

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

    /* Universal Box Sizing for consistent layout behavior */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /* CSS for the main content wrapper to push the footer down */
    .main-content-wrapper {
        flex-grow: 1;
        /* Allow this section to grow and fill available space */
        padding: 1.5rem 1.5rem;
        /* Add padding */
    }

    /* Container for layout */
    .container-epi {
        max-width: 900px;
        /* Adjusted max-width for content focus */
        margin: 0 auto;
        /* Center the container */
        padding: 0 1rem;
        /* Add horizontal padding inside the container */
        display: flex;
        flex-direction: column;
        /* Stack children vertically */
        padding: 0 1.5rem;
        /* Padding for smaller screens */
    }

    /* Episode Info Header */
    .episode-info-header {
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #d1d5db;
        /* Separator */
    }

    .episode-title-large {
        font-size: 2.8rem;
        /* Larger title for episode */
        font-weight: bold;
        color: #00697B;
        /* Deep Teal title */
        margin-bottom: 0.5rem;
    }

    .series-link {
        font-size: 1.1rem;
        color: rgba(54, 69, 79, 0.9);
    }

    .series-name-link {
        color: #E2725B;
        /* Warm Coral/Terracotta link color */
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .series-name-link:hover {
        color: #00697B;
        /* Deep Teal on hover */
        text-decoration: underline;
    }

    /* Audio Player Area */
    .audio-player-area {
        background-color: #F8F5F0;
        /* Soft Cream/Off-White background */
        border: 1px solid #d1d5db;
        /* Light border */
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .audio-player audio {
        width: 100%;
        /* Make native audio player fill container */
        border-radius: 0.25rem;
        /* Styling native audio controls is limited and browser-dependent */
        /* You might need to use a custom audio player for full control */
    }

    .playback-speed-control {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        justify-content: center;
        /* Center on small screens */
    }

    .playback-speed-control label {
        font-size: 1rem;
        color: #36454F;
        font-weight: 500;
    }

    .speed-select {
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        font-size: 1rem;
        color: #36454F;
        background-color: white;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }

    .speed-select:hover,
    .speed-select:focus {
        border-color: #00697B;
        /* Deep Teal border on hover/focus */
        outline: none;
    }

    /* Show Notes Section */
    .show-notes {
        margin-bottom: 3rem;
    }

    .show-notes h2 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #00697B;
        /* Deep Teal heading */
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #d1d5db;
        /* Separator line */
        padding-bottom: 0.75rem;
    }

    .show-notes-content {
        background-color: #F8F5F0;
        /* Soft Cream/Off-White background */
        border: 1px solid #d1d5db;
        /* Light border */
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .show-notes-content p {
        margin-bottom: 1rem;
        color: #36454F;
    }

    .show-notes-content ul {
        list-style: disc;
        /* Default disc for unordered list */
        margin-left: 1.5rem;
        /* Indent list items */
        margin-bottom: 1rem;
        color: #36454F;
    }

    .show-notes-content li {
        margin-bottom: 0.5rem;
    }

    .show-notes-content a {
        color: #00697B;
        /* Deep Teal link color */
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .show-notes-content a:hover {
        color: #E2725B;
        /* Warm Coral/Terracotta on hover */
        text-decoration: underline;
    }


    /* Episode Actions Bottom */
    .episode-actions-bottom {
        display: flex;
        flex-direction: column;
        /* Stack buttons vertically on small screens */
        gap: 1rem;
        /* Space between buttons */
        justify-content: center;
        /* Center buttons horizontally */
        align-items: center;
        /* Center buttons horizontally */
        margin-bottom: 3rem;
    }

    .action-button {
        background-color: #E2725B;
        /* Warm Coral/Terracotta background */
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
        display: inline-flex;
        /* Align icon and text */
        align-items: center;
        gap: 0.5rem;
        /* Space between icon and text */
    }

    .action-button:hover {
        background-color: #d1624c;
        /* Slightly darker Coral on hover */
    }

    .add-to-library-button {
        background-color: #00697B;
        /* Deep Teal for add to library */
    }

    .add-to-library-button:hover {
        background-color: #005a6a;
        /* Darker Teal on hover */
    }


    /* Responsive Adjustments */
    @media (min-width: 768px) {

        /* Medium screens and up */
        .main-content-wrapper {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .episode-info-header {
            text-align: left;
            /* Align text to the left on larger screens */
        }

        .playback-speed-control {
            justify-content: flex-start;
            /* Align to the left on larger screens */
        }

        .episode-actions-bottom {
            flex-direction: row;
            /* Arrange buttons horizontally */
            justify-content: center;
            /* Center buttons */
        }
    }

    @media (min-width: 1024px) {

        /* Large screens and up */
        .main-content-wrapper {
            padding-left: 4rem;
            padding-right: 4rem;
        }
    }
</style>

<main class="main-content-wrapper">
    <section class="episode-listening-section">
        <div class="container-epi">
            <div class="episode-info-header">
                <h1 class="episode-title-large"><?php echo $episode[0]["title"] ?></h1>
                <p class="series-link">From: <a href="#" class="series-name-link"><?php echo $episode[0]["podcast_title"] ?></a></p>
                <p class="series-link">By <a href="#" class="series-name-link"><?php echo $episode[0]["creator_name"] ?></a></p>
                <p class="series-link">Duration: <a href="#" class="series-name-link"><?php echo $episode[0]["duration"] ?></a></p>
                <p class="series-link">Release date: <a href="#" class="series-name-link"><?php echo $episode[0]["release_date"] ?></a></p>
            </div>

            <div class="audio-player-area">
                <div class="audio-player">
                    <audio controls>
                        <source src="/views/media/sounds/<?php echo $episode[0]["audio_file"] ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>

                <div class="playback-speed-control">
                    <label for="speed">Playback Speed:</label>
                    <select id="speed" class="speed-select">
                        <option value="0.5">0.5x</option>
                        <option value="0.75">0.75x</option>
                        <option value="1.0" selected>1.0x</option>
                        <option value="1.25">1.25x</option>
                        <option value="1.5">1.5x</option>
                        <option value="2.0">2.0x</option>
                    </select>
                </div>
            </div>

            <!-- <div class="show-notes">
                    <h2>Show Notes</h2>
                    <div class="show-notes-content">
                        <p>This is where the detailed show notes or description for the episode will go. It can include summaries, timestamps, links to resources mentioned in the episode, and more.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <ul>
                            <li>Point 1 discussed in the episode.</li>
                            <li>Point 2 with a relevant link: <a href="#">Link to Resource</a></li>
                            <li>Point 3 and further details.</li>
                        </ul>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div> -->

            <div class="episode-actions-bottom">
                <button class="action-button add-to-library-button">
                    <i class="fas fa-plus"></i> Add to Library
                </button>
                <button class="action-button bookmark-button">
                    <i class="fas fa-bookmark"></i> Bookmark Position
                </button>
            </div>
        </div>
    </section>
</main>

<script>
    // Basic JavaScript to control playback speed
    const audio = document.querySelector('audio');
    const speedSelect = document.querySelector('.speed-select');

    if (audio && speedSelect) {
        speedSelect.addEventListener('change', (event) => {
            audio.playbackRate = event.target.value;
        });
    }

    // You would add more JavaScript here for bookmarking, add to library, etc.
</script>

<?php require('views/partials/footer.php') ?>