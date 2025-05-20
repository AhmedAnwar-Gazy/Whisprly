<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="manage-content-section">
            <div class="container">
                <h1 class="page-title">Manage My Content</h1>

                <div class="content-list">
                    <div class="content-item podcast-item">
                        <div class="item-info">
                            <span class="item-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                            <h3 class="item-title">Episode Title: The Latest Trends</h3>
                            <p class="item-date">Uploaded: 2023-11-15</p>
                        </div>
                        <div class="item-status">
                            <span class="status-indicator pending"><i class="fas fa-clock"></i> Pending Approval</span>
                        </div>
                        <div class="item-analytics">
                             <div class="analytics-stat">
                                <span class="stat-number">150</span>
                                <span class="stat-label">Plays</span>
                             </div>
                             </div>
                        <div class="item-actions">
                            <button class="edit-button"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>

                    <div class="content-item book-item">
                        <div class="item-info">
                            <span class="item-type"><i class="fas fa-book-open"></i> Book</span>
                            <h3 class="item-title">My New Book: A Journey</h3>
                            <p class="item-date">Uploaded: 2023-11-10</p>
                        </div>
                        <div class="item-status">
                            <span class="status-indicator approved"><i class="fas fa-check-circle"></i> Approved</span>
                        </div>
                         <div class="item-analytics">
                             <div class="analytics-stat">
                                <span class="stat-number">500</span>
                                <span class="stat-label">Views</span>
                             </div>
                             </div>
                        <div class="item-actions">
                            <button class="edit-button"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>

                     <div class="content-item podcast-item">
                        <div class="item-info">
                            <span class="item-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                            <h3 class="item-title">Episode Title: Interview with Expert</h3>
                            <p class="item-date">Uploaded: 2023-11-01</p>
                        </div>
                        <div class="item-status">
                            <span class="status-indicator rejected"><i class="fas fa-times-circle"></i> Rejected</span>
                             <p class="rejection-reason">Reason: Contains copyrighted music.</p>
                        </div>
                         <div class="item-analytics">
                             <div class="analytics-stat">
                                <span class="stat-number">0</span>
                                <span class="stat-label">Plays</span>
                             </div>
                             </div>
                        <div class="item-actions">
                            <button class="edit-button"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>
                    </div>

                </div>
        </section>
    </main>
<?php require('views/partials/footer.php') ?>