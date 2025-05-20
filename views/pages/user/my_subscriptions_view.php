<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="subscriptions-section">
            <div class="container">
                <h1 class="page-title">My Subscriptions</h1>

                <ul class="subscribed-series-list">
                    <li class="subscribed-series-item">
                        <img src="https://placehold.co/100x100/00697B/F8F5F0?text=Series+1" alt="Podcast Series Cover" class="series-cover-small">
                        <div class="series-info">
                            <h3 class="series-title">Podcast Series Title One</h3>
                            <p class="series-creator">By Creator Name</p>
                            <a href="#" class="view-series-link">View Series</a>
                        </div>
                        <div class="series-actions">
                            <span class="new-episodes-indicator">New Episodes!</span>
                            <button class="unsubscribe-button"><i class="fas fa-minus-circle"></i> Unsubscribe</button>
                        </div>
                    </li>

                     <li class="subscribed-series-item">
                        <img src="https://placehold.co/100x100/FF7F50/F8F5F0?text=Series+2" alt="Podcast Series Cover" class="series-cover-small">
                        <div class="series-info">
                            <h3 class="series-title">Another Great Podcast</h3>
                            <p class="series-creator">By Another Creator</p>
                            <a href="#" class="view-series-link">View Series</a>
                        </div>
                        <div class="series-actions">
                            <button class="unsubscribe-button"><i class="fas fa-minus-circle"></i> Unsubscribe</button>
                        </div>
                    </li>

                     <li class="subscribed-series-item">
                        <img src="https://placehold.co/100x100/00697B/F8F5F0?text=Series+3" alt="Podcast Series Cover" class="series-cover-small">
                        <div class="series-info">
                            <h3 class="series-title">Tech Talk Weekly</h3>
                            <p class="series-creator">By Tech Enthusiasts</p>
                            <a href="#" class="view-series-link">View Series</a>
                        </div>
                        <div class="series-actions">
                            <span class="new-episodes-indicator">New Episodes!</span>
                            <button class="unsubscribe-button"><i class="fas fa-minus-circle"></i> Unsubscribe</button>
                        </div>
                    </li>
                    </ul>

            </div>
        </section>
    </main>
<?php require('views/partials/footer.php') ?>