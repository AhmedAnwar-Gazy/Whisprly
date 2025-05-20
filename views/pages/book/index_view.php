<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

 <main class="main-content-wrapper">
        <section class="browse-books-section">
            <div class="container">
                <h1 class="page-title">Browse Books</h1>

                <div class="search-filter-area">
                    <div class="search-bar">
                        <input type="text" placeholder="Search books by title, author, or topic..." class="search-input">
                        <button class="search-button">Search</button>
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option value="">All Genres</option>
                            <option value="fiction">Fiction</option>
                            <option value="non-fiction">Non-Fiction</option>
                            <option value="mystery">Mystery</option>
                            </select>
                        </div>
                </div>

                <div class="book-grid">
                    <div class="book-card">
                        <img src="https://placehold.co/300x450/FF7F50/F8F5F0?text=Book+Cover" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title">Book Title Example</h3>
                            <p class="book-author">By Author Name</p>
                            <p class="book-description">A brief description of the book...</p>
                            <div class="book-access">
                                <span class="access-type in-app">Readable In-App</span>
                                </div>
                        </div>
                    </div>

                    <div class="book-card">
                        <img src="https://placehold.co/300x450/00697B/F8F5F0?text=Book+Cover+2" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title">Another Interesting Read</h3>
                            <p class="book-author">By Another Author</p>
                            <p class="book-description">Dive into this captivating story...</p>
                             <div class="book-access">
                                <span class="access-type external-link">External Link</span>
                            </div>
                        </div>
                    </div>

                     <div class="book-card">
                        <img src="https://placehold.co/300x450/FF7F50/F8F5F0?text=Book+Cover+3" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title">A Guide to Something</h3>
                            <p class="book-author">By Expert</p>
                            <p class="book-description">Learn everything you need to know about this topic...</p>
                             <div class="book-access">
                                <span class="access-type in-app">Readable In-App</span>
                            </div>
                        </div>
                    </div>

                     <div class="book-card">
                        <img src="https://placehold.co/300x450/00697B/F8F5F0?text=Book+Cover+4" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title">Classic Novel</h3>
                            <p class="book-author">By Famous Writer</p>
                            <p class="book-description">A timeless piece of literature...</p>
                             <div class="book-access">
                                <span class="access-type in-app">Readable In-App</span>
                            </div>
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