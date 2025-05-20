<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="library-section">
            <div class="container">
                <h1 class="page-title">My Library</h1>

                <div class="library-tabs">
                    <button class="tab-button active" data-tab="podcasts">Saved Podcasts</button>
                    <button class="tab-button" data-tab="books">Saved Books</button>
                    <button class="tab-button" data-tab="playlists">Playlists</button>
                </div>

                <div id="podcasts" class="library-content active">
                    <h2 class="section-heading">Subscribed Series</h2>
                    <ul class="series-list">
                        <li class="series-item">
                            <img src="https://placehold.co/80x80/00697B/F8F5F0?text=Series" alt="Podcast Series Cover" class="item-cover">
                            <div class="item-info">
                                <h3 class="item-title">Podcast Series Title</h3>
                                <p class="item-creator">By Creator Name</p>
                            </div>
                            <a href="#" class="view-link">View Series</a>
                        </li>
                         <li class="series-item">
                            <img src="https://placehold.co/80x80/FF7F50/F8F5F0?text=Series" alt="Podcast Series Cover" class="item-cover">
                            <div class="item-info">
                                <h3 class="item-title">Another Subscribed Podcast</h3>
                                <p class="item-creator">By Another Creator</p>
                            </div>
                            <a href="#" class="view-link">View Series</a>
                        </li>
                        </ul>

                    <h2 class="section-heading">Saved Episodes</h2>
                     <ul class="episode-list">
                        <li class="episode-item">
                             <img src="https://placehold.co/60x60/00697B/F8F5F0?text=Episode" alt="Episode Cover" class="item-cover small">
                            <div class="item-info">
                                <h3 class="item-title">Episode Title One</h3>
                                <p class="item-series">From: Podcast Series Name</p>
                                <p class="item-bookmark">Bookmarked at: 15:30</p>
                            </div>
                            <div class="episode-actions">
                                <button class="play-button"><i class="fas fa-play"></i> Play</button>
                                <button class="bookmark-button"><i class="fas fa-bookmark"></i></button>
                            </div>
                        </li>
                         <li class="episode-item">
                             <img src="https://placehold.co/60x60/FF7F50/F8F5F0?text=Episode" alt="Episode Cover" class="item-cover small">
                            <div class="item-info">
                                <h3 class="item-title">Episode Title Two</h3>
                                <p class="item-series">From: Another Subscribed Podcast</p>
                                <p class="item-bookmark">Bookmarked at: 05:10</p>
                            </div>
                             <div class="episode-actions">
                                <button class="play-button"><i class="fas fa-play"></i> Play</button>
                                <button class="bookmark-button"><i class="fas fa-bookmark"></i></button>
                            </div>
                        </li>
                        </ul>
                </div>

                <div id="books" class="library-content">
                    <h2 class="section-heading">Saved Books</h2>
                    <ul class="book-list">
                        <li class="book-item">
                            <img src="https://placehold.co/80x120/FF7F50/F8F5F0?text=Book" alt="Book Cover" class="item-cover">
                            <div class="item-info">
                                <h3 class="item-title">Saved Book Title</h3>
                                <p class="item-author">By Author Name</p>
                                <p class="item-bookmark">Bookmarked at: Page 50</p>
                            </div>
                            <a href="#" class="view-link">View Book</a>
                        </li>
                         <li class="book-item">
                            <img src="https://placehold.co/80x120/00697B/F8F5F0?text=Book" alt="Book Cover" class="item-cover">
                            <div class="item-info">
                                <h3 class="item-title">Another Saved Book</h3>
                                <p class="item-author">By Another Author</p>
                                <p class="item-bookmark">Bookmarked at: Chapter 3</p>
                            </div>
                            <a href="#" class="view-link">View Book</a>
                        </li>
                        </ul>
                </div>

                <div id="playlists" class="library-content">
                    <h2 class="section-heading">My Playlists</h2>
                    <button class="create-playlist-button"><i class="fas fa-plus-circle"></i> Create New Playlist</button>
                    <ul class="playlist-list">
                        <li class="playlist-item">
                            <div class="playlist-info">
                                <h3 class="playlist-title">My Favorite Episodes</h3>
                                <p class="playlist-meta">5 episodes</p>
                            </div>
                            <div class="playlist-actions">
                                <a href="#" class="view-link">View Playlist</a>
                                <button class="edit-button"><i class="fas fa-edit"></i></button>
                                <button class="delete-button"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </li>
                         <li class="playlist-item">
                            <div class="playlist-info">
                                <h3 class="playlist-title">Books to Read</h3>
                                <p class="playlist-meta">3 books</p>
                            </div>
                             <div class="playlist-actions">
                                <a href="#" class="view-link">View Playlist</a>
                                <button class="edit-button"><i class="fas fa-edit"></i></button>
                                <button class="delete-button"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </li>
                        </ul>
                </div>

            </div>
        </section>
    </main>

    <script>
        // Basic JavaScript for tab switching
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.library-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Deactivate all tabs and hide all content
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.remove('active'));

                    // Activate the clicked tab and show the corresponding content
                    const targetTab = tab.dataset.tab;
                    tab.classList.add('active');
                    document.getElementById(targetTab).classList.add('active');
                });
            });
        });

        // You would add more JavaScript here for playing episodes, viewing books/series,
        // managing bookmarks, creating/editing/deleting playlists, etc.
    </script>
<?php require('views/partials/footer.php') ?>