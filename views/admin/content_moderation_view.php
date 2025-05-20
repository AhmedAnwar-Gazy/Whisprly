<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="content-moderation-section">
            <div class="container">
                <h1 class="page-title">Content Moderation</h1>

                <div class="moderation-queue">
                    <h2 class="section-heading">Pending Podcast Approvals (<span class="queue-count">5</span>)</h2>
                    <ul class="content-list">
                        <li class="content-item pending podcast-item">
                            <div class="item-info">
                                <span class="item-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                                <h3 class="item-title">Episode Title: New Tech Review</h3>
                                <p class="item-creator">By Creator Name</p>
                                <p class="item-date">Submitted: 2023-11-16</p>
                            </div>
                             <div class="item-actions">
                                <button class="action-button preview-button"><i class="fas fa-eye"></i> Preview</button>
                                <button class="action-button approve-button"><i class="fas fa-check"></i> Approve</button>
                                <button class="action-button reject-button"><i class="fas fa-times"></i> Reject</button>
                            </div>
                        </li>
                         <li class="content-item pending podcast-item">
                            <div class="item-info">
                                <span class="item-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                                <h3 class="item-title">Episode Title: Interview with Innovator</h3>
                                <p class="item-creator">By Another Creator</p>
                                <p class="item-date">Submitted: 2023-11-15</p>
                            </div>
                             <div class="item-actions">
                                <button class="action-button preview-button"><i class="fas fa-eye"></i> Preview</button>
                                <button class="action-button approve-button"><i class="fas fa-check"></i> Approve</button>
                                <button class="action-button reject-button"><i class="fas fa-times"></i> Reject</button>
                            </div>
                        </li>
                        </ul>
                </div>

                <div class="moderation-queue">
                    <h2 class="section-heading">Pending Book Approvals (<span class="queue-count">3</span>)</h2>
                    <ul class="content-list">
                        <li class="content-item pending book-item">
                            <div class="item-info">
                                <span class="item-type"><i class="fas fa-book-open"></i> Book</span>
                                <h3 class="item-title">New Novel Release</h3>
                                <p class="item-creator">By Book Author</p>
                                <p class="item-date">Submitted: 2023-11-17</p>
                            </div>
                            <div class="item-actions">
                                <button class="action-button preview-button"><i class="fas fa-eye"></i> Preview</button>
                                <button class="action-button approve-button"><i class="fas fa-check"></i> Approve</button>
                                <button class="action-button reject-button"><i class="fas fa-times"></i> Reject</button>
                            </div>
                        </li>
                         <li class="content-item pending book-item">
                            <div class="item-info">
                                <span class="item-type"><i class="fas fa-book-open"></i> Book</span>
                                <h3 class="item-title">Self-Help Guide</h3>
                                <p class="item-creator">By Self-Help Guru</p>
                                <p class="item-date">Submitted: 2023-11-16</p>
                            </div>
                             <div class="item-actions">
                                <button class="action-button preview-button"><i class="fas fa-eye"></i> Preview</button>
                                <button class="action-button approve-button"><i class="fas fa-check"></i> Approve</button>
                                <button class="action-button reject-button"><i class="fas fa-times"></i> Reject</button>
                            </div>
                        </li>
                        </ul>
                </div>

                <div class="moderation-queue">
                    <h2 class="section-heading">Reported Content (<span class="queue-count">2</span>)</h2>
                    <ul class="content-list">
                        <li class="content-item reported podcast-item">
                            <div class="item-info">
                                <span class="item-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                                <h3 class="item-title">Episode Title: Controversial Topic</h3>
                                <p class="item-creator">By Creator Name</p>
                                <p class="item-date">Reported: 2023-11-18</p>
                                <p class="report-reason">Reason: Inappropriate language.</p>
                            </div>
                             <div class="item-actions">
                                <button class="action-button preview-button"><i class="fas fa-eye"></i> Preview</button>
                                <button class="action-button ban-button"><i class="fas fa-ban"></i> Ban Content</button>
                                <button class="action-button dismiss-button"><i class="fas fa-check"></i> Dismiss Report</button>
                            </div>
                        </li>
                         <li class="content-item reported book-item">
                            <div class="item-info">
                                <span class="item-type"><i class="fas fa-book-open"></i> Book</span>
                                <h3 class="item-title">Book with Offensive Content</h3>
                                <p class="item-creator">By Book Author</p>
                                <p class="item-date">Reported: 2023-11-17</p>
                                <p class="report-reason">Reason: Contains hate speech.</p>
                            </div>
                             <div class="item-actions">
                                <button class="action-button preview-button"><i class="fas fa-eye"></i> Preview</button>
                                <button class="action-button ban-button"><i class="fas fa-ban"></i> Ban Content</button>
                                <button class="action-button dismiss-button"><i class="fas fa-check"></i> Dismiss Report</button>
                            </div>
                        </li>
                        </ul>
                </div>

                </div>
        </section>
    </main>
<?php require('views/parts/footer.php') ?>