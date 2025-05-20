<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* creator-dashboard.css */

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
    max-width: 900px; /* Container width for dashboard content */
    margin: 0 auto; /* Center the container */
}

.page-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal for page title */
    margin-bottom: 2rem;
    text-align: center; /* Center the title */
}

/* Section Heading Styling */
.section-heading {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal heading */
    margin-top: 2rem; /* Space above section heading */
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
    padding-bottom: 0.75rem;
}

/* Dashboard Overview Section */
.dashboard-overview {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.overview-stats {
    display: flex;
    flex-wrap: wrap; /* Allow stats to wrap */
    justify-content: space-around; /* Distribute space around items */
    gap: 1.5rem; /* Space between stat items */
    text-align: center;
}

.stat-item {
    flex: 1; /* Allow items to grow */
    min-width: 120px; /* Minimum width for a stat item */
}

.stat-number {
    display: block; /* Make number a block element */
    font-size: 2.5rem;
    font-weight: bold;
    color: #E2725B; /* Warm Coral/Terracotta for numbers */
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color */
}

/* Dashboard Actions Section */
.dashboard-actions {
     margin-bottom: 2rem;
}

.action-links {
    display: flex;
    flex-direction: column; /* Stack links vertically on small screens */
    gap: 1rem; /* Space between links */
}

.action-button {
    display: inline-flex; /* Align icon and text */
    align-items: center;
    gap: 0.5rem; /* Space between icon and text */
    background-color: #00697B; /* Deep Teal background */
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    text-decoration: none; /* Remove underline */
    transition: background-color 0.3s ease;
    justify-content: center; /* Center content horizontally */
}

.action-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}

/* Recent Uploads Section */
.recent-uploads {
    margin-bottom: 2rem;
}

.upload-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.upload-item {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.25rem;
    padding: 1rem;
    margin-bottom: 0.75rem;
    display: flex;
    flex-direction: column; /* Stack elements vertically on small screens */
    gap: 1rem; /* Space between elements */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.upload-info {
    flex-grow: 1; /* Allow info to take available space */
}

.upload-type {
    display: inline-block;
    font-size: 0.8rem;
    color: rgba(54, 69, 79, 0.7);
    margin-bottom: 0.5rem;
}

.upload-type i {
    margin-right: 0.25rem;
}

.upload-title {
    font-size: 1.1rem;
    font-weight: bold;
    color: #36454F; /* Charcoal Gray title */
    margin-bottom: 0.25rem;
}

.upload-date {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color */
}

.upload-status {
    flex-shrink: 0; /* Prevent status from shrinking */
}

.status-indicator {
    display: inline-block;
    font-size: 0.9rem;
    padding: 0.25rem 0.75rem;
    border-radius: 0.75rem; /* More rounded pills */
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.status-indicator.pending {
    background-color: #FF7F50; /* Warm Coral/Terracotta for pending */
    color: white;
}

.status-indicator.approved {
    background-color: #00697B; /* Deep Teal for approved */
    color: white;
}


/* Responsive Adjustments */
@media (min-width: 600px) { /* Adjust breakpoint as needed */
    .action-links {
        flex-direction: row; /* Arrange links horizontally */
        justify-content: center; /* Center links */
    }

    .upload-item {
        flex-direction: row; /* Arrange elements horizontally */
        justify-content: space-between; /* Space out elements */
        align-items: center; /* Align items vertically */
    }

    .upload-info {
        flex-grow: 1;
    }

    .upload-status {
        flex-shrink: 0;
    }
}

@media (min-width: 768px) { /* Medium screens and up */
    .main-content-wrapper {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
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