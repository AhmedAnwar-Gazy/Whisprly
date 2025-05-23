<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<style>
  body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    background-color: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    color: #333;
}

.podcast-player-container {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 25px;
    width: 100%;
    max-width: 500px;
    box-sizing: border-box;
}

.podcast-header {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
}

.podcast-cover {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 15px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.episode-info {
    display: flex;
    flex-direction: column;
}

.podcast-title {
    font-size: 0.9em;
    color: #555;
    margin-bottom: 3px;
}

.episode-title {
    font-size: 1.2em;
    font-weight: 600;
    color: #222;
}

/* Controls Section */
.controls {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.control-button {
    background: none;
    border: none;
    font-size: 2.2em;
    color: #333;
    cursor: pointer;
    padding: 0;
    margin: 0;
    transition: color 0.2s ease-in-out;
    outline: none; /* Remove outline on focus */
}

.control-button:hover {
    color: #007aff; /* Apple Blue */
}

.control-button:active {
    transform: translateY(1px); /* Slight press effect */
}

/* Progress Bar */
.progress-container {
    display: flex;
    align-items: center;
    width: 100%;
    gap: 10px;
    margin-top: 10px;
}

.time-display {
    font-size: 0.8em;
    color: #777;
    width: 40px; /* Fixed width to prevent jumping */
    text-align: center;
}

.progress-bar {
    -webkit-appearance: none; /* Remove default styling */
    width: 100%;
    height: 6px;
    background: #e0e0e0;
    border-radius: 3px;
    outline: none;
    cursor: pointer;
    position: relative;
    overflow: hidden; /* For filled background */
}

/* Custom thumb for progress bar */
.progress-bar::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #007aff; /* Apple Blue */
    cursor: pointer;
    box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.3); /* Ring around thumb */
    transition: background 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.progress-bar::-moz-range-thumb {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #007aff;
    cursor: pointer;
    box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.3);
    transition: background 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

/* Custom track for progress bar (filled portion) */
.progress-bar::-webkit-slider-runnable-track {
    background: linear-gradient(to right, #007aff 0%, #007aff var(--progress-value, 0%), #e0e0e0 var(--progress-value, 0%), #e0e0e0 100%);
    border-radius: 3px;
    height: 6px;
}

.progress-bar::-moz-range-track {
    background: linear-gradient(to right, #007aff 0%, #007aff var(--progress-value, 0%), #e0e0e0 var(--progress-value, 0%), #e0e0e0 100%);
    border-radius: 3px;
    height: 6px;
}


/* Volume Control */
.volume-container {
    display: flex;
    align-items: center;
    width: 100%;
    gap: 10px;
    margin-top: 10px;
}

.volume-container .fas {
    font-size: 1.1em;
    color: #777;
}

.volume-slider {
    -webkit-appearance: none;
    width: 100%;
    height: 4px;
    background: #e0e0e0;
    border-radius: 2px;
    outline: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.volume-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #007aff;
    cursor: pointer;
    box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.2);
    transition: background 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.volume-slider::-moz-range-thumb {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #007aff;
    cursor: pointer;
    box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.2);
    transition: background 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.volume-slider::-webkit-slider-runnable-track {
    background: linear-gradient(to right, #007aff 0%, #007aff var(--volume-value, 0%), #e0e0e0 var(--volume-value, 0%), #e0e0e0 100%);
    border-radius: 2px;
    height: 4px;
}

.volume-slider::-moz-range-track {
    background: linear-gradient(to right, #007aff 0%, #007aff var(--volume-value, 0%), #e0e0e0 var(--volume-value, 0%), #e0e0e0 100%);
    border-radius: 2px;
    height: 4px;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .podcast-player-container {
        margin: 20px;
        padding: 20px;
    }
    .podcast-header {
        flex-direction: column;
        text-align: center;
    }
    .podcast-cover {
        margin-right: 0;
        margin-bottom: 15px;
    }
}
</style>
<main>
  <h1></h1>
  <section>

<!-- <body>
  
  <iframe src="views/midea/pdfs/modern-java-in-action-lambda-streams-functional-and-reactive-programming_compress (4).pdf#toolbar=1&navpanes=0&scrollbar=0&zoom=page-width" width="90%" height="1000hv" frameborder="0">
    This browser does not support PDFs. Please <a href="views/midea/pdfs/modern-java-in-action-lambda-streams-functional-and-reactive-programming_compress (4).pdf">download the PDF</a> instead.
  </iframe>

</body> -->


<body>

    <div class="podcast-player-container">
        <div class="podcast-header">
            <img src="https://via.placeholder.com/100x100?text=Podcast+Cover" alt="Podcast Episode Cover" class="podcast-cover">
            <div class="episode-info">
                <span class="podcast-title">My Awesome Podcast</span>
                <span class="episode-title">Episode 1: The Beginning</span>
            </div>
        </div>

        <audio id="audioPlayer" src="your-audio-file.mp3" preload="metadata"></audio>

        <div class="controls">
            <button id="playPauseButton" class="control-button" aria-label="Play/Pause">
                <i class="fas fa-play"></i>
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

    <!-- <script src="script.js"></script> -->
</body>


<script>
  // --- Event Listeners ---

// Play/Pause functionality
playPauseButton.addEventListener('click', () => {
    if (audioPlayer.paused) {
        audioPlayer.play();
        playPauseIcon.classList.remove('fa-play');
        playPauseIcon.classList.add('fa-pause');
        playPauseButton.setAttribute('aria-label', 'Pause');
    } else {
        audioPlayer.pause();
        playPauseIcon.classList.remove('fa-pause');
        playPauseIcon.classList.add('fa-play');
        playPauseButton.setAttribute('aria-label', 'Play');
    }
});

// Update progress bar and current time
audioPlayer.addEventListener('timeupdate', () => {
    if (!isSeeking) {
        const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        progressBar.value = progress;
        progressBar.style.setProperty('--progress-value', `${progress}%`); // For custom track fill
        currentTimeSpan.textContent = formatTime(audioPlayer.currentTime);
    }
});

// Set duration when audio metadata is loaded
audioPlayer.addEventListener('loadedmetadata', () => {
    durationTimeSpan.textContent = formatTime(audioPlayer.duration);
    progressBar.max = 100; // Ensure max is 100 for percentage
    progressBar.value = 0; // Reset progress bar
    progressBar.style.setProperty('--progress-value', '0%');
});

// Handle audio ending
audioPlayer.addEventListener('ended', () => {
    playPauseIcon.classList.remove('fa-pause');
    playPauseIcon.classList.add('fa-play');
    playPauseButton.setAttribute('aria-label', 'Play');
    audioPlayer.currentTime = 0; // Reset to start
    progressBar.value = 0; // Reset progress bar
    progressBar.style.setProperty('--progress-value', '0%');
    currentTimeSpan.textContent = formatTime(0);
});

// Manual scrubbing (drag/click on progress bar)
progressBar.addEventListener('input', () => { // 'input' fires continuously while dragging
    isSeeking = true;
    const seekTime = (progressBar.value / 100) * audioPlayer.duration;
    currentTimeSpan.textContent = formatTime(seekTime);
    progressBar.style.setProperty('--progress-value', `${progressBar.value}%`); // Update visual fill
});

progressBar.addEventListener('change', () => { // 'change' fires when drag is released
    const seekTime = (progressBar.value / 100) * audioPlayer.duration;
    audioPlayer.currentTime = seekTime;
    isSeeking = false;
});

// Volume control
volumeControl.addEventListener('input', () => {
    const volume = volumeControl.value / 100;
    audioPlayer.volume = volume;
    volumeControl.style.setProperty('--volume-value', `${volumeControl.value}%`); // For custom track fill
});

// Initialize volume slider position based on default audio volume
volumeControl.value = audioPlayer.volume * 100;
volumeControl.style.setProperty('--volume-value', `${volumeControl.value}%`);
</script>

  </section>
</main>
<?php require('views/partials/footer.php') ?>