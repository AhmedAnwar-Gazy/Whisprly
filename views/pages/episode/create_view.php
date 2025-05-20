<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php $errors = ($_SESSION['errors'] ?? '');
unset($_SESSION['errors']); ?>

<style>/* upload-episode.css */

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
    max-width: 800px; /* Container width for the form */
    margin: 0 auto; /* Center the container */
}

.page-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal for page title */
    margin-bottom: 2rem;
    text-align: center; /* Center the title */
}

/* Upload Form Styling */
.upload-form {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.form-group {
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px dashed #e5e7eb; /* Dashed separator */
}

.form-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none; /* No border for the last item */
}

.form-label {
    display: block; /* Make label a block element */
    font-size: 1rem;
    font-weight: 500;
    color: #36454F;
    margin-bottom: 0.75rem;
}

.form-input,
.form-select,
.form-textarea {
    display: block; /* Make inputs block elements */
    width: 100%; /* Full width */
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.25rem;
    font-size: 1rem;
    color: #36454F;
    background-color: white; /* White background for inputs */
    box-sizing: border-box; /* Include padding and border in element's total width and height */
}

.form-textarea {
    resize: vertical; /* Allow vertical resizing */
}

.form-input-file {
    display: block;
    width: 100%;
    padding: 0.75rem 0; /* Adjust padding for file input */
    font-size: 1rem;
    color: #36454F;
    box-sizing: border-box;
}

.form-section-heading {
    font-size: 1.3rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal heading */
    margin-top: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e5e7eb; /* Light separator */
}

.form-subsection-heading {
    font-size: 1.1rem;
    font-weight: bold;
    color: #36454F; /* Charcoal Gray heading */
    margin-bottom: 1rem;
}

/* Related Books Linking */
.related-books-linking {
    display: flex;
    gap: 0.75rem; /* Space between input and button */
    align-items: center;
    margin-bottom: 1rem;
}

.related-books-linking .form-input {
    flex-grow: 1; /* Allow input to grow */
    margin-bottom: 0; /* Remove bottom margin */
}

.search-book-button {
    background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    flex-shrink: 0; /* Prevent button from shrinking */
}

.search-book-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}

.linked-books-list {
    margin-top: 1rem;
}

.linked-book-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background-color: #F8F5F0;
    border: 1px solid #d1d5db;
    border-radius: 0.25rem;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.linked-book-cover {
    width: 40px;
    height: 60px;
    object-fit: cover;
    border-radius: 0.125rem;
    flex-shrink: 0;
}

.linked-book-title {
    flex-grow: 1;
    font-size: 0.9rem;
    font-weight: 500;
    color: #36454F;
}

.remove-linked-book {
    background: none;
    border: none;
    cursor: pointer;
    color: #E2725B; /* Warm Coral/Terracotta icon */
    font-size: 1rem;
    transition: color 0.3s ease;
    flex-shrink: 0;
}

.remove-linked-book:hover {
    color: #d1624c; /* Slightly darker Coral on hover */
}


/* Submit Button Styling */
.submit-group {
    text-align: center;
    margin-top: 2rem;
}

.submit-button {
    background-color: #00697B; /* Deep Teal background */
    color: white;
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1.1rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.submit-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}


/* Responsive Adjustments */
@media (min-width: 600px) { /* Adjust breakpoint as needed */
    /* Adjust layout for form elements if needed on larger screens */
}

@media (min-width: 768px) { /* Medium screens and up */
    .main-content-wrapper {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
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