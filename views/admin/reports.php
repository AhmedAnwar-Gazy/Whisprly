<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="reports-section">
            <div class="container">
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