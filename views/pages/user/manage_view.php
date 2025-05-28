<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php  require('views/partials/header.php') ?>




<style>
    /* General Body Styling (consistent with Whisprly SRS) */
    body {
        font-family: 'Inter', sans-serif;
        background-color: #F8F5F0; /* Soft Cream/Off-White */
        color: #36454F; /* Charcoal Gray */
        margin: 0;
        padding: 0;
        line-height: 1.6;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .main_manage {
        flex-grow: 1;
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
        box-sizing: border-box; /* Ensures padding is included in element's total width */
    }

    .section_manage {
        background-color: #ffffff; /* White background for the section */
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Subtle shadow for depth */
        padding: 2rem;
    }

    .page-heading {
        font-size: 2rem;
        font-weight: bold;
        color: #00697B; /* Deep Teal for titles */
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .add-link {
        display: inline-block;
        background-color: #E2725B; /* Warm Coral for action buttons */
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.25rem;
        text-decoration: none;
        font-weight: bold;
        margin-bottom: 1.5rem;
        transition: background-color 0.3s ease;
    }

    .add-link:hover {
        background-color: #d1624c; /* Slightly darker Coral on hover */
    }

    .users-table-container {
        overflow-x: auto; /* Enables horizontal scrolling for tables on small screens */
        width: 100%;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse; /* Collapses borders between table cells */
        margin-top: 1rem;
    }

    .users-table th,
    .users-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0; /* Light gray border for table rows */
        white-space: nowrap; /* Prevent content wrapping in cells */
    }

    .users-table th {
        background-color: #00697B; /* Deep Teal for table headers */
        color: white;
        font-weight: bold;
    }

    .users-table tbody tr:hover {
        background-color: #f0f4f7; /* Light background on row hover */
    }

    .options {
        margin-top: 0.5rem;
    }

    .options ul {
        display: flex;
        flex-wrap: wrap; /* Allow buttons to wrap on smaller screens */
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .options button {
        background-color: transparent;
        border: 1px solid #00697B; /* Teal border for option buttons */
        color: #00697B; /* Teal text for option buttons */
        padding: 0.4rem 0.8rem;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .options button:hover {
        background-color: #00697B; /* Teal background on hover */
        color: white;
    }

    /* Styling for different user roles */
    .role-admin {
        color: #dc3545; /* Red for Admin */
        font-weight: bold;
    }

    .role-creator {
        color: #28a745; /* Green for Creator */
        font-weight: bold;
    }

    .role-listener {
        color: #007bff; /* Blue for Listener */
        font-weight: bold;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .main_manage {
            padding: 1rem;
        }

        .section_manage {
            padding: 1rem;
        }

        .page-heading {
            font-size: 1.75rem;
        }

        .users-table th,
        .users-table td {
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        .add-link {
            width: 100%;
            text-align: center;
        }
    }
</style>

---

<main class="main_manage">
    <section class="section_manage">
        <h1 class="page-heading">Manage Users</h1>

        <a class="add-link" href="/user_create">Add New User</a>

        <div class="users-table-container">
            <table class="users-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><input type="checkbox" class="select-user" data-user-id="<?= htmlspecialchars($user['user_id']) ?>"></td>
                                <td>
                                    <?= htmlspecialchars($user['name']) ?>
                                    <nav class="options">
                                        <ul>
                                            <li>
                                                <form action="/user_show" method="get">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                    <button type="submit" aria-label="View User">View</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/user_edit" method="get">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                    <button type="submit" aria-label="Edit User">Edit</button>
                                                </form>
                                            </li>
                                            <?php if ($user['role'] !== 'listener'): ?>
                                            <li>
                                                <form action="/user_change_role" method="post">
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                    <input type="hidden" name="new_role" value="listener">
                                                    <button type="submit" aria-label="Change role to Listener">Set Listener</button>
                                                </form>
                                            </li>
                                            <?php endif; ?>
                                            <?php if ($user['role'] !== 'creator'): ?>
                                            <li>
                                                <form action="/user_change_role" method="post">
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                    <input type="hidden" name="new_role" value="creator">
                                                    <button type="submit" aria-label="Change role to Creator">Set Creator</button>
                                                </form>
                                            </li>
                                            <?php endif; ?>
                                            <?php if ($user['role'] !== 'admin'): ?>
                                            <li>
                                                <form action="/user_change_role" method="post">
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                    <input type="hidden" name="new_role" value="admin">
                                                    <button type="submit" aria-label="Change role to Admin">Set Admin</button>
                                                </form>
                                            </li>
                                            <?php endif; ?>
                                            <li>
                                                <form action="/user_destroy" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                    <button type="submit" aria-label="Delete User">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </nav>
                                </td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td>
                                    <span class="role-<?= htmlspecialchars($user['role']) ?>">
                                        <?= htmlspecialchars(ucfirst($user['role'])) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars(date('Y-m-d H:i', strtotime($user['created_at']))) ?></td>
                                <td>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px;">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>


<?php require('views/partials/footer.php') ?>