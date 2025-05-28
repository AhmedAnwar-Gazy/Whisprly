<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>




<style>
    /* Styling consistent with Whisprly SRS and your previous examples */
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
        box-sizing: border-box;
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

    .episodes-table-container {
        overflow-x: auto;
        width: 100%;
    }

    .episodes-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .episodes-table th,
    .episodes-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0; /* Light gray border */
    }

    .episodes-table th {
        background-color: #00697B; /* Deep Teal for headers */
        color: white;
        font-weight: bold;
        white-space: nowrap;
    }

    .episodes-table tbody tr:hover {
        background-color: #f0f4f7; /* Light hover effect for rows */
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
        border: 1px solid #00697B; /* Teal border */
        color: #00697B; /* Teal text */
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

    /* Duration formatting */
    .duration {
        white-space: nowrap;
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

        .episodes-table th,
        .episodes-table td {
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
        <h1 class="page-heading">Manage Episodes</h1>

        <a class="add-link" href="/episode_create">Upload New Episode</a>

        <div class="episodes-table-container">
            <table class="episodes-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Podcast Title</th>
                        <th>Episode Title</th>
                        <th>Duration</th>
                        <th>Release Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($episodes)): ?>
                        <?php foreach ($episodes as $episode): ?>
                            <tr>
                                <td><input type="checkbox" class="select-episode" data-episode-id="<?= htmlspecialchars($episode['episode_id']) ?>"></td>
                                <td>
                                    <a href="/podcast_show?podcast_id=<?= htmlspecialchars($episode['podcast_id']) ?>" style="color: #00697B; text-decoration: none;">
                                        <?= htmlspecialchars($episode['podcast_title']) ?>
                                    </a>
                                </td>
                                <td>
                                    <?= htmlspecialchars($episode['title']) ?>
                                    <nav class="options">
                                        <ul>
                                            <li>
                                                <form action="/episode_play" method="get">
                                                    <input type="hidden" name="episode_id" value="<?= htmlspecialchars($episode['episode_id']) ?>">
                                                    <button type="submit" aria-label="Play Episode">Play</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/episode_edit" method="get">
                                                    <input type="hidden" name="episode_id" value="<?= htmlspecialchars($episode['episode_id']) ?>">
                                                    <button type="submit" aria-label="Edit Episode">Edit</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/episode_destroy" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="episode_id" value="<?= htmlspecialchars($episode['episode_id']) ?>">
                                                    <button type="submit" aria-label="Delete Episode">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </nav>
                                </td>
                                <td class="duration">
                                    <?php
                                    $duration_minutes = floor($episode['duration'] / 60);
                                    $duration_seconds = $episode['duration'] % 60;
                                    echo htmlspecialchars($duration_minutes) . 'm ' . htmlspecialchars($duration_seconds) . 's';
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($episode['release_date']) ?></td>
                                <td>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px;">No episodes found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require('views/partials/footer.php') ?>