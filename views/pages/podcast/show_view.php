<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<main class="main-content-wrapper">
        <section class="podcast-series-detail-section">
            <div class="container">
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
                        <button class="subscribe-button">
                            <i class="fas fa-plus-circle"></i> Subscribe
                        </button>
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
            </div>
        </section>
    </main>

<?php require('views/partials/footer.php') ?>