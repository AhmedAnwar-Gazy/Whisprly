<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php $errors = ($_SESSION['errors'] ?? '');
unset($_SESSION['errors']); ?>

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