<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* user-management.css */

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
    max-width: 1100px; /* Container width for user management content */
    margin: 0 auto; /* Center the container */
}

.page-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal for page title */
    margin-bottom: 2rem;
    text-align: center; /* Center the title */
}

/* Search and Filter/Sort Area */
.search-filter-area {
    display: flex;
    flex-direction: column; /* Stack vertically on small screens */
    gap: 1rem; /* Space between sections */
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #d1d5db; /* Separator */
}

.search-bar {
    display: flex;
    gap: 0.5rem;
    flex-grow: 1;
}

.search-input {
    flex-grow: 1;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.25rem;
    font-size: 1rem;
    color: #36454F;
    background-color: white;
}

.search-button {
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
    flex-shrink: 0;
}

.search-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}

.filter-sort-options {
    display: flex;
    flex-wrap: wrap; /* Allow selects to wrap */
    gap: 1rem; /* Space between selects */
    justify-content: flex-start; /* Align to the left */
}

.filter-select {
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.25rem;
    font-size: 1rem;
    color: #36454F;
    background-color: #F8F5F0;
    cursor: pointer;
}


/* User List Table Styling */
.user-list-table {
    margin-bottom: 2rem;
    overflow-x: auto; /* Add horizontal scroll on small screens */
}

.user-list-table table {
    width: 100%;
    border-collapse: collapse; /* Collapse table borders */
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    overflow: hidden; /* Hide overflow for rounded corners */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.user-list-table th,
.user-list-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb; /* Light separator */
}

.user-list-table th {
    background-color: #00697B; /* Deep Teal background for header */
    color: white;
    font-weight: bold;
    font-size: 1rem;
}

.user-list-table tbody tr:last-child td {
    border-bottom: none; /* No border for the last row */
}

/* Responsive Table - Hide headers on small screens and use data-label */
@media (max-width: 767px) { /* Adjust breakpoint as needed */
    .user-list-table table,
    .user-list-table thead,
    .user-list-table tbody,
    .user-list-table th,
    .user-list-table td,
    .user-list-table tr {
        display: block;
    }

    .user-list-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    .user-list-table tr {
        border: 1px solid #d1d5db;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .user-list-table td {
        border: none;
        border-bottom: 1px solid #e5e7eb;
        position: relative;
        padding-left: 50%; /* Space for the data-label */
        text-align: right; /* Align content to the right */
    }

    .user-list-table td:before {
        position: absolute;
        top: 1rem;
        left: 1rem;
        width: 45%; /* Width of the data-label */
        padding-right: 10px;
        white-space: nowrap;
        content: attr(data-label); /* Display the data-label */
        font-weight: bold;
        color: #00697B; /* Deep Teal for labels */
        text-align: left; /* Align label to the left */
    }

    .user-list-table td:last-child {
        border-bottom: none;
    }

    .user-list-table .actions-cell {
        display: flex; /* Use flexbox for actions */
        justify-content: flex-end; /* Align actions to the right */
        gap: 0.5rem; /* Space between action buttons */
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
}



</style>

     <?php require('views/partials/search.php') ?>


 <main class="main-content-wrapper">
        <section class="user-management-section">
            <div class="container_page">
                <h1 class="page-title">User Management</h1>

                <div class="search-filter-area">
                    <div class="search-bar">
                        <input type="text" placeholder="Search users..." class="search-input">
                        <button class="search-button"><i class="fas fa-search"></i> Search</button>
                    </div>
                    <div class="filter-sort-options">
                        <select class="filter-select">
                            <option value="">All Roles</option>
                            <option value="listener">Listener</option>
                            <option value="creator">Creator</option>
                            <option value="admin">Admin</option>
                        </select>
                         <select class="filter-select">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="banned">Banned</option>
                        </select>
                         <select class="filter-select">
                            <option value="">Sort By</option>
                            <option value="registration-date">Registration Date</option>
                            <option value="username">Username</option>
                            <option value="email">Email</option>
                        </select>
                    </div>
                </div>

                <div class="user-list-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="user-row">
                                <td data-label="Username">listener_user</td>
                                <td data-label="Email">listener@example.com</td>
                                <td data-label="Role"><span class="role-tag listener">Listener</span></td>
                                <td data-label="Registration Date">2023-01-15</td>
                                <td data-label="Status"><span class="status-indicator active"><i class="fas fa-check-circle"></i> Active</span></td>
                                <td data-label="Actions" class="actions-cell">
                                    <button class="action-button ban-button"><i class="fas fa-ban"></i> Ban</button>
                                    <button class="action-button change-role-button"><i class="fas fa-user-tag"></i> Change Role</button>
                                    <button class="action-button delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                                </td>
                            </tr>
                             <tr class="user-row">
                                <td data-label="Username">creator_user</td>
                                <td data-label="Email">creator@example.com</td>
                                <td data-label="Role"><span class="role-tag creator">Creator</span></td>
                                <td data-label="Registration Date">2023-03-20</td>
                                <td data-label="Status"><span class="status-indicator banned"><i class="fas fa-times-circle"></i> Banned</span></td>
                                <td data-label="Actions" class="actions-cell">
                                    <button class="action-button unban-button"><i class="fas fa-check"></i> Unban</button>
                                    <button class="action-button change-role-button"><i class="fas fa-user-tag"></i> Change Role</button>
                                    <button class="action-button delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                                </td>
                            </tr>
                             <tr class="user-row">
                                <td data-label="Username">admin_user</td>
                                <td data-label="Email">admin@whisprly.com</td>
                                <td data-label="Role"><span class="role-tag admin">Admin</span></td>
                                <td data-label="Registration Date">2022-10-01</td>
                                <td data-label="Status"><span class="status-indicator active"><i class="fas fa-check-circle"></i> Active</span></td>
                                <td data-label="Actions" class="actions-cell">
                                    <button class="action-button change-role-button"><i class="fas fa-user-tag"></i> Change Role</button>
                                    </td>
                            </tr>
                            </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button class="pagination-button">&laquo; Previous</button>
                    <button class="pagination-button active">1</button>
                    <button class="pagination-button">2</button>
                    <button class="pagination-button">3</button>
                    <button class="pagination-button">Next &raquo;</button>
                </div>

            </div>
        </section>
    </main>
<?php require('views/parts/footer.php') ?>