<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php $errors = ($_SESSION['errors'] ?? '');
unset($_SESSION['errors']); ?>

<style>/* upload-book.css */

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

/* Upload Method Toggle */
.upload-method-toggle {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.toggle-button {
    background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.toggle-button:hover:not(.active) {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}

.toggle-button.active {
    background-color: #00697B; /* Deep Teal for active button */
    cursor: default;
}

/* Content Fields (Toggled) */
.content-fields {
    display: none; /* Hide by default */
    /* Remove padding-bottom and border-bottom from these groups as they are part of the toggle section */
    padding-bottom: 0;
    border-bottom: none;
}

.content-fields.active {
    display: block; /* Show when active */
}

.content-fields .form-group {
    /* Restore padding and border for groups *within* the active content fields */
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px dashed #e5e7eb;
}

.content-fields .form-group:last-child {
     margin-bottom: 0;
     padding-bottom: 0;
     border-bottom: none;
}


/* Related Podcasts Linking */
.related-podcasts-linking {
    display: flex;
    gap: 0.75rem; /* Space between input and button */
    align-items: center;
    margin-bottom: 1rem;
}

.related-podcasts-linking .form-input {
    flex-grow: 1; /* Allow input to grow */
    margin-bottom: 0; /* Remove bottom margin */
}

.search-podcast-button {
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

.search-podcast-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}

.linked-podcasts-list {
    margin-top: 1rem;
}

.linked-podcast-item {
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

.linked-podcast-cover {
    width: 40px;
    height: 40px; /* Square for podcast covers */
    object-fit: cover;
    border-radius: 0.125rem;
    flex-shrink: 0;
}

.linked-podcast-title {
    flex-grow: 1;
    font-size: 0.9rem;
    font-weight: 500;
    color: #36454F;
}

.remove-linked-podcast {
    background: none;
    border: none;
    cursor: pointer;
    color: #E2725B; /* Warm Coral/Terracotta icon */
    font-size: 1rem;
    transition: color 0.3s ease;
    flex-shrink: 0;
}

.remove-linked-podcast:hover {
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
        <section class="upload-book-section">
            <div class="container">
                <h1 class="page-title">Upload Book</h1>

                <form class="upload-form">

                    <div class="form-group">
                        <label for="book-title" class="form-label">Book Title:</label>
                        <input type="text" id="book-title" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="book-author" class="form-label">Author:</label>
                        <input type="text" id="book-author" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="book-description" class="form-label">Description:</label>
                        <textarea id="book-description" class="form-textarea" rows="6" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="book-genre" class="form-label">Genre:</label>
                        <select id="book-genre" class="form-select" required>
                            <option value="">-- Select Genre --</option>
                            <option value="fiction">Fiction</option>
                            <option value="non-fiction">Non-Fiction</option>
                            <option value="mystery">Mystery</option>
                            <option value="self-help">Self-Help</option>
                            </select>
                    </div>

                    <div class="form-group">
                         <h2 class="form-section-heading">Book Content</h2>
                         <div class="upload-method-toggle">
                             <button type="button" class="toggle-button active" data-method="upload-pdf">Upload PDF</button>
                             <button type="button" class="toggle-button" data-method="link-external">Link Externally</button>
                         </div>
                    </div>


                    <div id="upload-pdf-fields" class="form-group content-fields active">
                        <label for="book-pdf" class="form-label">Book File (PDF):</label>
                        <input type="file" id="book-pdf" class="form-input-file" accept=".pdf" required>
                    </div>

                    <div id="link-external-fields" class="form-group content-fields">
                         <div class="form-group">
                            <label for="external-link" class="form-label">External Link (e.g., Amazon, Google Books):</label>
                            <input type="url" id="external-link" class="form-input" placeholder="https://...">
                         </div>
                          <div class="form-group">
                            <label for="affiliate-id" class="form-label">Affiliate ID (Optional):</label>
                            <input type="text" id="affiliate-id" class="form-input" placeholder="Your Affiliate ID">
                         </div>
                         <div class="form-group">
                             <label for="book-cover-external" class="form-label">Book Cover Image:</label>
                             <input type="file" id="book-cover-external" class="form-input-file" accept="image/*" required>
                         </div>
                     </div>


                    <div id="upload-cover-fields" class="form-group content-fields active">
                        <label for="book-cover-pdf" class="form-label">Book Cover Image:</label>
                        <input type="file" id="book-cover-pdf" class="form-input-file" accept="image/*" required>
                    </div>


                    <div class="form-group">
                        <h2 class="form-section-heading">Link Related Podcasts</h2>
                        <div class="related-podcasts-linking">
                            <input type="text" id="podcast-search" class="form-input" placeholder="Search for existing podcast series">
                            <button type="button" class="search-podcast-button"><i class="fas fa-search"></i> Search Podcast</button>
                        </div>
                        <div class="linked-podcasts-list">
                            <div class="linked-podcast-item">
                                <img src="https://placehold.co/50x50/00697B/F8F5F0?text=Podcast" alt="Podcast Cover" class="linked-podcast-cover">
                                <span class="linked-podcast-title">Linked Podcast Title</span>
                                <button type="button" class="remove-linked-podcast"><i class="fas fa-times-circle"></i></button>
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
        // Basic JavaScript to toggle upload method fields
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButtons = document.querySelectorAll('.upload-method-toggle .toggle-button');
            const contentFields = document.querySelectorAll('.content-fields');

            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetMethod = button.dataset.method;

                    // Deactivate all buttons and hide all content fields
                    toggleButtons.forEach(btn => btn.classList.remove('active'));
                    contentFields.forEach(fields => fields.classList.remove('active'));

                    // Activate the clicked button
                    button.classList.add('active');

                    // Show the corresponding content fields and manage required attributes
                    const targetFields = document.getElementById(targetMethod + '-fields');
                    if (targetFields) {
                        targetFields.classList.add('active');
                        // Manage required attributes based on active section
                        targetFields.querySelectorAll('[required]').forEach(input => {
                             input.removeAttribute('required'); // Remove required from all first
                        });
                         if (targetMethod === 'upload-pdf') {
                            document.getElementById('book-pdf').setAttribute('required', 'required');
                            document.getElementById('book-cover-pdf').setAttribute('required', 'required');
                         } else if (targetMethod === 'link-external') {
                            document.getElementById('external-link').setAttribute('required', 'required');
                             document.getElementById('book-cover-external').setAttribute('required', 'required'); // Cover might still be required
                         }
                    }
                });
            });

             // Initialize required attributes for the default active section
             const initialActiveFields = document.querySelector('.content-fields.active');
             if (initialActiveFields) {
                  if (initialActiveFields.id === 'upload-pdf-fields') {
                      document.getElementById('book-pdf').setAttribute('required', 'required');
                      document.getElementById('book-cover-pdf').setAttribute('required', 'required');
                   } else if (initialActiveFields.id === 'link-external-fields') {
                       document.getElementById('external-link').setAttribute('required', 'required');
                       document.getElementById('book-cover-external').setAttribute('required', 'required');
                   }
             }


            // You would add more JavaScript here for:
            // - Searching/linking related podcasts
            // - Handling file uploads
            // - Submitting the form data to your backend
        });
    </script>
<?php require('views/partials/footer.php') ?>