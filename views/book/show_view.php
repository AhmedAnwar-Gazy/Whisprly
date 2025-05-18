<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

 <main class="main-content-wrapper">
        <section class="book-detail-section">
            <div class="container">
                <div class="book-header">
                    <img src="https://placehold.co/300x450/FF7F50/F8F5F0?text=Book+Cover" alt="Book Cover" class="book-cover-large">
                    <div class="book-info-large">
                        <h1 class="book-title-large">Book Title Goes Here</h1>
                        <p class="book-author-large">By Author Name</p>
                        <p class="book-description-large">A detailed description of the book, covering its plot, themes, and style. This section provides potential readers with enough information to decide if they want to read it.</p>
                        <div class="book-meta">
                            <span class="meta-item"><strong>Genre:</strong> [Genre]</span>
                            <span class="meta-item"><strong>Publication Date:</strong> [Date]</span>
                        </div>

                        <div class="book-access-options">
                            <button class="access-button in-app-button">
                                <i class="fas fa-book-reader"></i> Read In-App
                            </button>
                            </div>

                        <button class="action-button add-to-library-button">
                            <i class="fas fa-plus"></i> Add to Library
                        </button>
                    </div>
                </div>

                <div class="related-podcasts-section">
                    <h2>Related Podcasts</h2>
                    <div class="related-podcasts-grid">
                        <div class="related-podcast-card">
                             <img src="https://placehold.co/150x150/00697B/F8F5F0?text=Podcast+Cover" alt="Related Podcast Cover" class="related-podcast-cover">
                            <div class="related-podcast-info">
                                <h3 class="related-podcast-title">Related Podcast Title</h3>
                                <p class="related-podcast-creator">By Creator Name</p>
                                <a href="#" class="related-podcast-link">Listen Now</a>
                            </div>
                        </div>
                         <div class="related-podcast-card">
                             <img src="https://placehold.co/150x150/FF7F50/F8F5F0?text=Podcast+Cover+2" alt="Related Podcast Cover" class="related-podcast-cover">
                            <div class="related-podcast-info">
                                <h3 class="related-podcast-title">Another Related Podcast</h3>
                                <p class="related-podcast-creator">By Another Creator</p>
                                <a href="#" class="related-podcast-link">Listen Now</a>
                            </div>
                        </div>
                         <div class="related-podcast-card">
                             <img src="https://placehold.co/150x150/00697B/F8F5F0?text=Podcast+Cover+3" alt="Related Podcast Cover" class="related-podcast-cover">
                            <div class="related-podcast-info">
                                <h3 class="related-podcast-title">Third Related Podcast</h3>
                                <p class="related-podcast-creator">By Third Creator</p>
                                <a href="#" class="related-podcast-link">Listen Now</a>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </section>
    </main>

<?php require('views/partials/footer.php') ?>