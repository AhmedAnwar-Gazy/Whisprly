<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="creator-dashboard-section">
            <div class="container">
                <h1 class="page-title">Creator Dashboard</h1>

                <div class="dashboard-overview">
                    <h2 class="section-heading">Overview</h2>
                    <div class="overview-stats">
                        <div class="stat-item">
                            <span class="stat-number">15</span>
                            <span class="stat-label">Total Uploads</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">1,250</span>
                            <span class="stat-label">Total Followers/Subscribers</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">5,870</span>
                            <span class="stat-label">Recent Plays (Last 30 days)</span>
                        </div>
                        </div>
                </div>

                <div class="dashboard-actions">
                     <h2 class="section-heading">Quick Actions</h2>
                     <div class="action-links">
                         <a href="#" class="action-button"><i class="fas fa-upload"></i> Upload New Podcast Episode</a>
                         <a href="#" class="action-button"><i class="fas fa-book"></i> Upload New Book</a>
                         <a href="#" class="action-button"><i class="fas fa-cogs"></i> Manage My Content</a>
                     </div>
                </div>


                <div class="recent-uploads">
                    <h2 class="section-heading">Recent Uploads</h2>
                    <ul class="upload-list">
                        <li class="upload-item">
                            <div class="upload-info">
                                <span class="upload-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                                <h3 class="upload-title">Episode Title: The Latest Trends</h3>
                                <p class="upload-date">Uploaded: 2023-11-15</p>
                            </div>
                            <div class="upload-status">
                                <span class="status-indicator pending"><i class="fas fa-clock"></i> Pending Approval</span>
                                </div>
                        </li>
                         <li class="upload-item">
                            <div class="upload-info">
                                <span class="upload-type"><i class="fas fa-book-open"></i> Book</span>
                                <h3 class="upload-title">My New Book: A Journey</h3>
                                <p class="upload-date">Uploaded: 2023-11-10</p>
                            </div>
                            <div class="upload-status">
                                <span class="status-indicator approved"><i class="fas fa-check-circle"></i> Approved</span>
                            </div>
                        </li>
                         <li class="upload-item">
                            <div class="upload-info">
                                <span class="upload-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                                <h3 class="upload-title">Episode Title: Interview with Expert</h3>
                                <p class="upload-date">Uploaded: 2023-11-01</p>
                            </div>
                            <div class="upload-status">
                                <span class="status-indicator approved"><i class="fas fa-check-circle"></i> Approved</span>
                            </div>
                        </li>
                        </ul>
                </div>

            </div>
        </section>
    </main>
<?php require('views/partials/footer.php') ?>