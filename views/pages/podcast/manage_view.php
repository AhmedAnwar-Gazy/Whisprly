<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php require('views/partials/search.php') ?>





<style>
    /* Styling consistent with Whisprly SRS and your homepage example */
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
        box-sizing: border-box; /* Include padding in element's total width and height */
    }

    .section_manage {
        background-color: #ffffff; /* White background for the section */
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); /* Subtle shadow */
        padding: 2rem;
    }

    .page-heading {
        font-size: 2rem;
        font-weight: bold;
        color: #00697B; /* Deep Teal */
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .add-link {
        display: inline-block;
        background-color: #E2725B; /* Warm Coral */
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.25rem;
        text-decoration: none;
        font-weight: bold;
        margin-bottom: 1.5rem;
        transition: background-color 0.3s ease;
    }

    .add-link:hover {
        background-color: #d1624c; /* Slightly darker Coral */
    }

    .campaigns-table-container {
        overflow-x: auto; /* Enable horizontal scrolling for tables on small screens */
        width: 100%;
    }

    .campaigns-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .campaigns-table th,
    .campaigns-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0; /* Light gray border */
    }

    .campaigns-table th {
        background-color: #00697B; /* Deep Teal for headers */
        color: white;
        font-weight: bold;
        white-space: nowrap; /* Prevent headers from wrapping */
    }

    .campaigns-table tbody tr:hover {
        background-color: #f0f4f7; /* Light hover effect for rows */
    }

    .campaign-logo {
        width: 50px; /* Adjust size as needed */
        height: 50px;
        object-fit: cover;
        border-radius: 0.25rem; /* Slightly rounded corners for images */
    }

    .options {
        margin-top: 0.5rem;
    }

    .options ul {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .options button {
        background-color: transparent;
        border: 1px solid #00697B; /* Teal border */
        color: #00697B; /* Teal text */
        padding: 0.4rem 0.8rem;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        white-space: nowrap; /* Prevent button text from wrapping */
    }

    .options button:hover {
        background-color: #00697B; /* Teal background on hover */
        color: white;
    }

    /* Specific styles for status */
    .status-published {
        color: #28a745; /* Green */
        font-weight: bold;
    }

    .status-pending {
        color: #ffc107; /* Yellow/Orange */
        font-weight: bold;
    }

    .status-rejected {
        color: #dc3545; /* Red */
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

        .campaigns-table th,
        .campaigns-table td {
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        .add-link {
            width: 100%;
            text-align: center;
        }
    }
</style>

<main class="main_manage">
    <section class="section_manage">
        <h1 class="page-heading">Manage Podcasts</h1>

        <a class="add-link" href="/podcast_create">Add New Podcast</a>

        <div class="campaigns-table-container">
            <table class="campaigns-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Creator</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($podcasts)): ?>
                        <?php foreach ($podcasts as $podcast): ?>
                            <tr>
                                <td><input type="checkbox" class="select-podcast" data-podcast-id="<?= htmlspecialchars($podcast['podcast_id']) ?>"></td>
                                <td>
                                    <img src="/views/media/images/<?= htmlspecialchars($podcast['cover_image'] ?? "image.png") ?>" alt="Podcast Cover" class="campaign-logo" loading="lazy">
                                </td>
                                <td>
                                    <?= htmlspecialchars($podcast['title']) ?>
                                    <nav class="options">
                                        <ul>
                                            <li>
                                                <form action="/podcast_show" method="get">
                                                    <input type="hidden" name="podcast_id" value="<?= htmlspecialchars($podcast['podcast_id']) ?>">
                                                    <button type="submit" aria-label="View Podcast">View</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/podcast_edit" method="get">
                                                    <input type="hidden" name="podcast_id" value="<?= htmlspecialchars($podcast['podcast_id']) ?>">
                                                    <button type="submit" aria-label="Edit Podcast">Edit</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/podcast_update_status" method="post">
                                                    <input type="hidden" name="podcast_id" value="<?= htmlspecialchars($podcast['podcast_id']) ?>">
                                                    <input type="hidden" name="status" value="published">
                                                    <button type="submit" aria-label="Approve Podcast">Approve</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/podcast_update_status" method="post">
                                                    <input type="hidden" name="podcast_id" value="<?= htmlspecialchars($podcast['podcast_id']) ?>">
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" aria-label="Reject Podcast">Reject</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/podcast_destroy?" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="podcast_id" value="<?= htmlspecialchars($podcast['podcast_id']) ?>">
                                                    <button type="submit" aria-label="Delete Podcast">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </nav>
                                </td>
                                <td><?= htmlspecialchars(substr($podcast['description'], 0, 100)) . (strlen($podcast['description']) > 100 ? '...' : '') ?></td>
                                <td><?= htmlspecialchars($podcast['created_by']) ?></td>
                                <td>
                                    <span class="status-<?= htmlspecialchars($podcast['status']) ?>">
                                        <?= htmlspecialchars(ucfirst($podcast['status'])) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars(date('Y-m-d', strtotime($podcast['created_at']))) ?></td>
                                <td>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 20px;">No podcasts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require('views/parts/footer.php') ?>






<?php require('views/partials/footer.php') ?>