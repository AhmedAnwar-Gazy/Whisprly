<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php require('views/partials/search.php') ?>

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

    .books-table-container {
        overflow-x: auto;
        width: 100%;
    }

    .books-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .books-table th,
    .books-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0; /* Light gray border */
    }

    .books-table th {
        background-color: #00697B; /* Deep Teal for headers */
        color: white;
        font-weight: bold;
        white-space: nowrap;
    }

    .books-table tbody tr:hover {
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

    /* Description truncation */
    .book-description {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
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

        .books-table th,
        .books-table td {
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
        <h1 class="page-heading">Manage Books</h1>

        <a class="add-link" href="/book_create">Upload New Book</a>

        <div class="books-table-container">
            <table class="books-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($books)): ?>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><input type="checkbox" class="select-book" data-book-id="<?= htmlspecialchars($book['book_id']) ?>"></td>
                                <td>
                                    <?= htmlspecialchars($book['title']) ?>
                                    <nav class="options">
                                        <ul>
                                            <li>
                                                <form action="/book_show" method="get">
                                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['book_id']) ?>">
                                                    <button type="submit" aria-label="View Book">View</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/book_edit" method="get">
                                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['book_id']) ?>">
                                                    <button type="submit" aria-label="Edit Book">Edit</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/book_download" method="get">
                                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['book_id']) ?>">
                                                    <button type="submit" aria-label="Download Book">Download</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="/book_destroy" method="post">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['book_id']) ?>">
                                                    <button type="submit" aria-label="Delete Book">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </nav>
                                </td>
                                <td><p class="book-description"><?= htmlspecialchars($book['description']) ?></p></td>
                                <td><?= htmlspecialchars($book['created_by']) ?></td>
                                <td><?= htmlspecialchars(date('Y-m-d', strtotime($book['created_at']))) ?></td>
                                <td>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px;">No books found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require('views/partials/footer.php') ?>