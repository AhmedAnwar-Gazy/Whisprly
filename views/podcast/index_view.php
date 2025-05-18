<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="browse-podcasts-section">
            <div class="container">
                <h1 class="page-title">Browse Podcasts</h1>

                <div class="search-filter-area">
                    <div class="search-bar">
                        <input type="text" placeholder="Search podcasts by name, tag, or speaker..." class="search-input">
                        <button class="search-button">Search</button>
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option value="">All Categories</option>
                            <option value="technology">Technology</option>
                            <option value="business">Business</option>
                            <option value="comedy">Comedy</option>
                            </select>
                         <select class="filter-select">
                            <option value="">Sort By</option>
                            <option value="popularity">Popularity</option>
                            <option value="trending">Trending</option>
                            <option value="newest">Newest</option>
                        </select>
                        </div>
                </div>

                <div class="podcast-series-grid">
                    <div class="podcast-series-card">
                        <img src="https://placehold.co/300x300/00697B/F8F5F0?text=Podcast+Cover" alt="Podcast Series Cover" class="series-cover">
                        <div class="series-info">
                            <h3 class="series-title">Podcast Series Title</h3>
                            <p class="series-creator">By Creator Name</p>
                            <p class="series-description">A brief description of the podcast series...</p>
                        </div>
                    </div>

                    <div class="podcast-series-card">
                        <img src="https://placehold.co/300x300/FF7F50/F8F5F0?text=Podcast+Cover+2" alt="Podcast Series Cover" class="series-cover">
                        <div class="series-info">
                            <h3 class="series-title">Another Great Podcast</h3>
                            <p class="series-creator">By Another Creator</p>
                            <p class="series-description">Explore fascinating topics in this engaging podcast series...</p>
                        </div>
                    </div>

                     <div class="podcast-series-card">
                        <img src="https://placehold.co/300x300/00697B/F8F5F0?text=Podcast+Cover+3" alt="Podcast Series Cover" class="series-cover">
                        <div class="series-info">
                            <h3 class="series-title">Tech Talk Weekly</h3>
                            <p class="series-creator">By Tech Enthusiasts</p>
                            <p class="series-description">Stay updated on the latest in technology...</p>
                        </div>
                    </div>

                     <div class="podcast-series-card">
                        <img src="https://placehold.co/300x300/FF7F50/F8F5F0?text=Podcast+Cover+4" alt="Podcast Series Cover" class="series-cover">
                        <div class="series-info">
                            <h3 class="series-title">Creative Writing Corner</h3>
                            <p class="series-creator">By Aspiring Authors</p>
                            <p class="series-description">Tips and inspiration for your writing journey...</p>
                        </div>
                    </div>
                </div>

                <div class="pagination">
                    <button class="pagination-button">&laquo; Previous</button>
                    <button class="pagination-button active">1</button>
                    <button class="pagination-button">2</button>
                    <button class="pagination-button">3</button>
                    <button class="pagination-button">Next &raquo;</button>
                </div>
            </div>
        </section>
    </main>
<?php require('views/partials/footer.php') ?>