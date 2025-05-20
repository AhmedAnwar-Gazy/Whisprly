<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="admin-dashboard-section">
            <div class="container">
                <h1 class="page-title">Admin Dashboard</h1>

                <div class="dashboard-overview">
                    <h2 class="section-heading">Overview Statistics</h2>
                    <div class="overview-stats">
                        <div class="stat-item">
                            <span class="stat-number">1,500</span>
                            <span class="stat-label">Total Users</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50</span>
                            <span class="stat-label">Total Creators</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">12</span>
                            <span class="stat-label">Content Pending Approval</span>
                        </div>
                         <div class="stat-item">
                            <span class="stat-number">5</span>
                            <span class="stat-label">Reported Items</span>
                        </div>
                        </div>
                </div>

                <div class="dashboard-quick-links">
                     <h2 class="section-heading">Quick Links</h2>
                     <div class="quick-links-grid">
                         <a href="#" class="quick-link-button"><i class="fas fa-users"></i> User Management</a>
                         <a href="#" class="quick-link-button"><i class="fas fa-check-circle"></i> Content Moderation</a>
                         <a href="#" class="quick-link-button"><i class="fas fa-tags"></i> Categories Management</a>
                         <a href="#" class="quick-link-button"><i class="fas fa-chart-bar"></i> Reports</a>
                     </div>
                </div>

                </div>
        </section>
    </main>
<?php require('views/parts/footer.php') ?>