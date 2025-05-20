<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

 <main class="main-content-wrapper">
        <section class="user-management-section">
            <div class="container">
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