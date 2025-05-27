<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php $errors = ($_SESSION['errors'] ?? '');
unset($_SESSION['errors']); ?>

<style>
    /* create-book.css */

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
    .containerb {
        max-width: 700px;
        /* Container width for the form */
        margin: 0 auto;
        /* Center the container */
        display: flex;
        flex-direction: column;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #00697B;
        /* Deep Teal for page title */
        margin-bottom: 2rem;
        text-align: center;
        /* Center the title */
    }

    /* Form Styling */
    .create-book-form {
        background-color: #F8F5F0;
        /* Soft Cream/Off-White background */
        border: 1px solid #d1d5db;
        /* Light border */
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        /* Subtle shadow */
    }

    .form-group {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed #e5e7eb;
        /* Dashed separator */
    }

    .form-group:last-of-type {
        /* Target the last form-group before the submit button/note */
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
        /* No border for the last item */
    }

    .form-label {
        display: block;
        /* Make label a block element */
        font-size: 1rem;
        font-weight: 500;
        color: #36454F;
        margin-bottom: 0.75rem;
    }

    .form-input,
    .form-select,
    .form-textarea {
        display: block;
        /* Make inputs block elements */
        width: 100%;
        /* Full width */
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        font-size: 1rem;
        color: #36454F;
        background-color: white;
        /* White background for inputs */
        box-sizing: border-box;
        /* Include padding and border in element's total width and height */
    }

    .form-textarea {
        resize: vertical;
        /* Allow vertical resizing */
    }

    .form-input-file {
        display: block;
        width: 100%;
        padding: 0.75rem 0;
        /* Adjust padding for file input */
        font-size: 1rem;
        color: #36454F;
        box-sizing: border-box;
    }

    .file-note {
        font-size: 0.85rem;
        color: rgba(54, 69, 79, 0.7);
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .form-section-heading {
        font-size: 1.3rem;
        font-weight: bold;
        color: #00697B;
        /* Deep Teal heading */
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
        /* Light separator */
    }

    /* Related Podcasts Linking */
    .related-podcasts-linking {
        display: flex;
        gap: 0.75rem;
        /* Space between input and button */
        align-items: center;
        margin-bottom: 1rem;
    }

    .related-podcasts-linking .form-input {
        flex-grow: 1;
        /* Allow input to grow */
        margin-bottom: 0;
        /* Remove bottom margin */
    }

    .search-podcast-button {
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
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
        /* Prevent button from shrinking */
    }

    .search-podcast-button:hover {
        background-color: #d1624c;
        /* Slightly darker Coral on hover */
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
        height: 40px;
        /* Square for podcast covers */
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
        color: #E2725B;
        /* Warm Coral/Terracotta icon */
        font-size: 1rem;
        transition: color 0.3s ease;
        flex-shrink: 0;
    }

    .remove-linked-podcast:hover {
        color: #d1624c;
        /* Slightly darker Coral on hover */
    }

    .backend-note {
        font-size: 0.9rem;
        color: rgba(54, 69, 79, 0.8);
        background-color: rgba(0, 105, 123, 0.05);
        /* Light teal background */
        border-left: 4px solid #00697B;
        /* Teal border */
        padding: 0.75rem 1rem;
        border-radius: 0.25rem;
        margin-top: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .backend-note i {
        color: #00697B;
        /* Deep Teal icon */
    }


    /* Submit Button Styling */
    .submit-group {
        text-align: center;
        margin-top: 2rem;
        border-bottom: none;
        /* Ensure no border for the submit group */
        padding-bottom: 0;
    }

    .submit-button {
        background-color: #00697B;
        /* Deep Teal background */
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
        background-color: #005a6a;
        /* Slightly darker Teal on hover */
    }


    /* Responsive Adjustments */
    @media (min-width: 600px) {

        /* Adjust breakpoint as needed */
        .form-group {
            display: flex;
            /* Use flexbox for label and input */
            align-items: center;
            gap: 1rem;
        }

        .form-label {
            margin-bottom: 0;
            flex-shrink: 0;
            width: 150px;
            /* Fixed width for labels for alignment */
            text-align: right;
            /* Align labels to the right */
        }

        .form-input,
        .form-select,
        .form-textarea,
        .form-input-file {
            flex-grow: 1;
            /* Allow inputs to grow */
        }

        .submit-group {
            text-align: right;
            /* Align submit button to the right */
        }

        .related-podcasts-linking {
            flex-wrap: nowrap;
            /* Prevent wrapping on larger screens */
        }
    }

    @media (min-width: 768px) {

        /* Medium screens and up */
        .main-content-wrapper {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
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
    <section class="create-book-section">
        <div class="containerb">
            <h1 class="page-title">Create New Book</h1>

            <form class="create-book-form">

                <div class="form-group">
                    <label for="book-title" class="form-label">Book Title:</label>
                    <input type="text" id="book-title" name="title" class="form-input" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="book-description" class="form-label">Description:</label>
                    <textarea id="book-description" name="description" class="form-textarea" rows="8"></textarea>
                </div>

                <div class="form-group">
                    <label for="book-pdf-file" class="form-label">PDF File:</label>
                    <input type="file" id="book-pdf-file" name="pdf_file" class="form-input-file" accept=".pdf" required>
                    <p class="file-note">Upload the PDF file for your book.</p>
                </div>

                <div class="form-group">
                    <label for="book-cover-image" class="form-label">Cover Image:</label>
                    <input type="file" id="book-cover-image" name="cover_image" class="form-input-file" accept="image/*">
                    <p class="file-note">Upload a cover image for your book (e.g., JPEG, PNG).</p>
                </div>

                <div class="form-group">
                    <label for="book-topic" class="form-label">Topic/Genre:</label>
                    <select id="book-topic" name="topic" class="form-select" required>
                        <option value="">-- Select a Topic/Genre --</option>
                        <option value="fiction">Fiction</option>
                        <option value="non-fiction">Non-Fiction</option>
                        <option value="mystery">Mystery</option>
                        <option value="thriller">Thriller</option>
                        <option value="fantasy">Fantasy</option>
                        <option value="science-fiction">Science Fiction</option>
                        <option value="biography">Biography</option>
                        <option value="history">History</option>
                        <option value="self-help">Self-Help</option>
                        <option value="technology">Technology</option>
                    </select>
                </div>

                <div class="form-group">
                    <h2 class="form-section-heading">Link Related Podcasts</h2>
                    <div class="related-podcasts-linking">
                        <input type="text" id="podcast-search" class="form-input" placeholder="Search for existing podcast series to link">
                        <button type="button" class="search-podcast-button"><i class="fas fa-search"></i> Search Podcast</button>
                    </div>
                    <div class="linked-podcasts-list">

                    </div>
                    <p class="file-note">You can link this book to one or more relevant podcast series.</p>
                </div>

                <p class="backend-note">
                    <i class="fas fa-info-circle"></i> Your user ID will be automatically associated with this book upon submission.
                </p>

                <div class="form-group submit-group">
                    <button type="submit" class="submit-button"><i class="fas fa-plus-circle"></i> Create Book</button>
                </div>

            </form>
        </div>
    </section>
</main>
<?php require('views/partials/footer.php') ?>