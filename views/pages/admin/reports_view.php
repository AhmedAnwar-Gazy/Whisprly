<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* reports.css */

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

/* Report Controls Section */
.report-controls {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.report-controls .filter-options {
    display: flex;
    flex-direction: column; /* Stack vertically on small screens */
    gap: 1rem; /* Space between filter options */
}

.report-controls .form-group {
     margin-bottom: 0; /* Remove default form group margin */
     padding-bottom: 0; /* Remove default form group padding */
     border-bottom: none; /* Remove default form group border */
     flex-grow: 1; /* Allow form groups to grow in flex container_page */
}

.form-label {
    display: block; /* Make label a block element */
    font-size: 1rem;
    font-weight: 500;
    color: #36454F;
    margin-bottom: 0.5rem;
}

.form-input,
.form-select {
    display: block; /* Make inputs block elements */
    width: 100%; /* Full width */
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.25rem;
    font-size: 1rem;
    color: #36454F;
    background-color: white; /* White background for inputs */
    box-sizing: border-box; /* Include padding and border in element's total width and height */
}

.generate-report-button {
    background-color: #00697B; /* Deep Teal background */
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: center; /* Center content */
    width: 100%; /* Full width on small screens */
}

.generate-report-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}


/* Report Display Area */
.report-display-area {
     margin-bottom: 2rem;
}

.report-content {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    min-height: 200px; /* Minimum height for the report area */
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: rgba(54, 69, 79, 0.7);
    font-style: italic;
}

/* Responsive Adjustments */
@media (min-width: 768px) { /* Medium screens and up */
    .main-content-wrapper {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
    }

    .report-controls .filter-options {
        flex-direction: row; /* Arrange horizontally */
        align-items: flex-end; /* Align items to the bottom */
    }

    .generate-report-button {
        width: auto; /* Auto width on larger screens */
        flex-shrink: 0; /* Prevent button from shrinking */
    }

    .report-controls .form-group.submit-group {
        margin-top: 0; /* Remove top margin */
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
        <section class="reports-section">
            <div class="container_page">
                <h1 class="page-title">Reports</h1>

                <div class="report-controls">
                    <h2 class="section-heading">Generate Report</h2>
                    <div class="filter-options">
                        <div class="form-group">
                            <label for="start-date" class="form-label">Start Date:</label>
                            <input type="date" id="start-date" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="end-date" class="form-label">End Date:</label>
                            <input type="date" id="end-date" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="report-type" class="form-label">Report Type:</label>
                            <select id="report-type" class="form-select">
                                <option value="usage">Usage Statistics</option>
                                <option value="trending">Trending Content</option>
                                <option value="creator-activity">Creator Activity</option>
                            </select>
                        </div>
                         <div class="form-group submit-group">
                            <button class="generate-report-button"><i class="fas fa-chart-line"></i> Generate Report</button>
                         </div>
                    </div>
                </div>

                <div class="report-display-area">
                    <h2 class="section-heading">Report Results</h2>
                    <div class="report-content">
                        <p>Select report type and date range, then click "Generate Report" to view results here.</p>
                        </div>
                </div>

            </div>
        </section>
    </main>
<?php require('views/parts/footer.php') ?>