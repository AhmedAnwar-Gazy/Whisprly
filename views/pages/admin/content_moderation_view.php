<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* content-moderation.css */

/* General Body Styling (ensure consistency with header and footer) */
body {
    font-family: 'Inter', sans-serif; /* Apply Inter font */
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    color: #36454F; /* Charcoal Gray text */
    margin: 0;
    padding: 0;
    line-height: 1.6;
    display: flex; /* Use flexbox for layout */
    flex-direction: column; /* Stack children vertically */
    min-height: 100vh; /* Ensure body takes at least full viewport height */
}

/* CSS for the main content wrapper to push the footer down */
.main-content-wrapper {
    flex-grow: 1; /* Allow this section to grow and fill available space */
    padding: 1.5rem 1.5rem; /* Add padding */
}

/* Container for layout */
.container {
    max-width: 1000px; /* Container width for content */
    margin: 0 auto; /* Center the container */
}

.page-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal for page title */
    margin-bottom: 2rem;
    text-align: center; /* Center the title */
}

/* Moderation Queue Styling */
.moderation-queue {
    margin-bottom: 3rem;
}

.section-heading {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal heading */
    margin-top: 2rem; /* Space above section heading */
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
}

.queue-count {
    font-size: 1.5rem;
    color: #E2725B; /* Warm Coral/Terracotta for count */
}

/* Content List Styling */
.content-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

/* Individual Content Item */
.content-item {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 1rem;
    display: flex;
    flex-direction: column; /* Stack elements vertically on small screens */
    gap: 1.5rem; /* Space between sections */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.item-info {
    flex-grow: 1; /* Allow info to take available space */
}

.item-type {
    display: inline-block;
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.7);
    margin-bottom: 0.5rem;
}

.item-type i {
    margin-right: 0.25rem;
}

.item-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #36454F; /* Charcoal Gray title */
    margin-bottom: 0.25rem;
}

.item-creator,
.item-date {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color */
    margin-right: 1rem;
}

.report-reason {
    font-size: 0.9rem;
    color: #E2725B; /* Warm Coral/Terracotta for report reason */
    margin-top: 0.75rem;
    font-style: italic;
}


.item-actions {
    display: flex;
    flex-wrap: wrap; /* Allow buttons to wrap */
    gap: 0.75rem; /* Space between buttons */
    flex-shrink: 0;
    justify-content: center; /* Center buttons on small screens */
}

.action-button {
    background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.action-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}

.preview-button {
    background-color: #00697B; /* Deep Teal for preview */
}

.preview-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}

.approve-button {
    background-color: #22C55E; /* Green for approve */
}

.approve-button:hover {
    background-color: #16A34A; /* Darker green on hover */
}

.reject-button {
    background-color: #EF4444; /* Red for reject */
}

.reject-button:hover {
    background-color: #DC2626; /* Darker red on hover */
}

.ban-button {
     background-color: #EF4444; /* Red for ban */
}

.ban-button:hover {
    background-color: #DC2626; /* Darker red on hover */
}

.dismiss-button {
    background-color: #B08D57; /* Muted Gold/Ochre for dismiss */
}

.dismiss-button:hover {
    background-color: #9a7b4b; /* Slightly darker Gold on hover */
}


/* Optional: Pagination Styling (if used) */
/* Reuse styles from browse pages if needed */


/* Responsive Adjustments */
@media (min-width: 768px) { /* Medium screens and up */
    .main-content-wrapper {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
    }

    .content-item {
        flex-direction: row; /* Arrange elements horizontally */
        justify-content: space-between; /* Space out elements */
        align-items: center; /* Align items vertically */
    }

    .item-info {
        flex-grow: 2; /* Allow info to take more space */
    }

    .item-actions {
        flex-shrink: 0;
        justify-content: flex-end; /* Align buttons to the right */
    }
}

@media (min-width: 1024px) { /* Large screens and up */
    .main-content-wrapper {
        padding-left: 4rem;
        padding-right: 4rem;
    }
}

</style>

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