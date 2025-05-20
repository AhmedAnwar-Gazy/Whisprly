<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* admin-dashboard.css */

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
    max-width: 1000px; /* Container width for dashboard content */
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
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #d1d5db; /* Separator line */
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
    min-width: 150px; /* Minimum width for a stat item */
}

.stat-number {
    display: block; /* Make number a block element */
    font-size: 2.8rem; /* Larger number */
    font-weight: bold;
    color: #E2725B; /* Warm Coral/Terracotta for numbers */
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 1rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color */
}

/* Dashboard Quick Links Section */
.dashboard-quick-links {
     margin-bottom: 2rem;
}

.quick-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Responsive grid for links */
    gap: 1.5rem; /* Space between links */
}

.quick-link-button {
    display: flex; /* Use flexbox for icon and text */
    flex-direction: column; /* Stack icon and text vertically */
    align-items: center; /* Center items horizontally */
    gap: 0.75rem; /* Space between icon and text */
    background-color: #00697B; /* Deep Teal background */
    color: white;
    padding: 1.5rem;
    border-radius: 0.5rem;
    text-decoration: none; /* Remove underline */
    font-size: 1.1rem;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.3s ease;
    text-align: center; /* Center text */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.quick-link-button i {
    font-size: 2rem; /* Larger icon size */
    color: #FF7F50; /* Warm Coral/Terracotta for icons */
}

.quick-link-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
    transform: translateY(-3px); /* Slight lift on hover */
}


/* Responsive Adjustments */
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