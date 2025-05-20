<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="episode-listening-section">
            <div class="container">
                <div class="episode-info-header">
                    <h1 class="episode-title-large">Episode Title Goes Here</h1>
                    <p class="series-link">From: <a href="#" class="series-name-link">[Podcast Series Name]</a></p>
                </div>

                <div class="audio-player-area">
                    <div class="audio-player">
                        <audio controls>
                            <source src="your-episode-audio.mp3" type="audio/mpeg">
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

                <div class="show-notes">
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
                </div>

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