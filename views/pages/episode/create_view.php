<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php $errors = ($_SESSION['errors'] ?? '');
unset($_SESSION['errors']); ?>

<main class="main-content-wrapper">
        <section class="upload-episode-section">
            <div class="container">
                <h1 class="page-title">Upload Podcast Episode</h1>

                <form class="upload-form">

                    <div class="form-group">
                        <label for="podcast-series" class="form-label">Select Podcast Series or Create New:</label>
                        <select id="podcast-series" class="form-select">
                            <option value="">-- Select an existing series --</option>
                            <option value="series-1">Existing Podcast Series One</option>
                            <option value="series-2">Existing Podcast Series Two</option>
                            <option value="new-series">-- Create New Series --</option>
                        </select>
                        <input type="text" id="new-series-name" class="form-input" placeholder="Enter New Series Name" style="display: none; margin-top: 0.75rem;">
                    </div>

                    <div class="form-group">
                        <label for="episode-title" class="form-label">Episode Title:</label>
                        <input type="text" id="episode-title" class="form-input" required>
                    </div>

                     <div class="form-group">
                        <label for="episode-number" class="form-label">Episode Number:</label>
                        <input type="number" id="episode-number" class="form-input" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="episode-description" class="form-label">Episode Description:</label>
                        <textarea id="episode-description" class="form-textarea" rows="6" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="audio-file" class="form-label">Audio File (MP3, etc.):</label>
                        <input type="file" id="audio-file" class="form-input-file" accept=".mp3,.wav,.aac" required>
                    </div>

                    <div class="form-group">
                        <label for="episode-tags" class="form-label">Tags (comma-separated):</label>
                        <input type="text" id="episode-tags" class="form-input" placeholder="e.g., technology, business, interview">
                    </div>

                     <div class="form-group">
                        <label for="episode-speaker" class="form-label">Speaker(s):</label>
                        <input type="text" id="episode-speaker" class="form-input" placeholder="e.g., John Doe, Jane Smith">
                    </div>

                    <div class="form-group">
                        <h2 class="form-section-heading">Link Related Books</h2>
                        <div class="related-books-linking">
                            <input type="text" id="book-search" class="form-input" placeholder="Search for existing books or enter details for a new one">
                            <button type="button" class="search-book-button"><i class="fas fa-search"></i> Search/Add Book</button>
                        </div>
                        <div class="linked-books-list">
                            <div class="linked-book-item">
                                <img src="https://placehold.co/50x75/FF7F50/F8F5F0?text=Book" alt="Book Cover" class="linked-book-cover">
                                <span class="linked-book-title">Linked Book Title</span>
                                <button type="button" class="remove-linked-book"><i class="fas fa-times-circle"></i></button>
                            </div>
                            </div>
                         <div id="new-book-fields" style="display: none; margin-top: 1.5rem; border-top: 1px dashed #d1d5db; padding-top: 1.5rem;">
                              <h3 class="form-subsection-heading">Add New Book Details</h3>
                              <div class="form-group">
                                   <label for="new-book-title" class="form-label">New Book Title:</label>
                                   <input type="text" id="new-book-title" class="form-input">
                              </div>
                               <div class="form-group">
                                   <label for="new-book-author" class="form-label">New Book Author:</label>
                                   <input type="text" id="new-book-author" class="form-input">
                              </div>
                               <div class="form-group">
                                   <label for="new-book-affiliate-link" class="form-label">Affiliate Link:</label>
                                   <input type="url" id="new-book-affiliate-link" class="form-input" placeholder="e.g., https://amazon.com/...">
                              </div>
                               </div>
                    </div>

                    <div class="form-group submit-group">
                        <button type="submit" class="submit-button"><i class="fas fa-paper-plane"></i> Submit for Review</button>
                    </div>

                </form>
            </div>
        </section>
    </main>

    <script>
        // Basic JavaScript to show/hide new series name input
        document.addEventListener('DOMContentLoaded', () => {
            const seriesSelect = document.getElementById('podcast-series');
            const newSeriesInput = document.getElementById('new-series-name');

            if (seriesSelect && newSeriesInput) {
                seriesSelect.addEventListener('change', (event) => {
                    if (event.target.value === 'new-series') {
                        newSeriesInput.style.display = 'block';
                        newSeriesInput.setAttribute('required', 'required');
                    } else {
                        newSeriesInput.style.display = 'none';
                        newSeriesInput.removeAttribute('required');
                    }
                });
            }

            // You would add more JavaScript here for:
            // - Searching/adding related books
            // - Handling file uploads
            // - Submitting the form data to your backend
            // - Showing/hiding new book fields
        });
    </script>
<?php require('views/partials/footer.php') ?>