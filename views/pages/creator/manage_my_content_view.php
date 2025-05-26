<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* manage-content.css */

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
.container-creator-manage {
    max-width: 900px; /* Container width for content list */
    margin: 0 auto; /* Center the container */
     display: flex;
        flex-direction: column;
        /* Stack children vertically */
        padding: 0 1.5rem;
        /* Padding for smaller screens */
}

.page-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal for page title */
    margin-bottom: 2rem;
    text-align: center; /* Center the title */
}

/* Content List Styling */
.content-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

/* Individual Content Item */
.content-item {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 1rem;
    display: flex;
    flex-direction: column; /* Stack elements vertically on small screens */
    gap: 1.5rem; /* Space between sections */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.item-info {
    flex-grow: 1; /* Allow info to take available space */
}

.item-type {
    display: inline-block;
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.7);
    margin-bottom: 0.5rem;
}

.item-type i {
    margin-right: 0.25rem;
}

.item-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #36454F; /* Charcoal Gray title */
    margin-bottom: 0.25rem;
}

.item-date {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color */
}

.item-status {
    flex-shrink: 0; /* Prevent status from shrinking */
}

.status-indicator {
    display: inline-block;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.status-indicator.pending {
    background-color: #FF7F50; /* Warm Coral/Terracotta for pending */
    color: white;
}

.status-indicator.approved {
    background-color: #00697B; /* Deep Teal for approved */
    color: white;
}

.status-indicator.rejected {
    background-color: #E2725B; /* Warm Coral/Terracotta (can use a different shade if needed) */
    color: white;
}

.rejection-reason {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8);
    margin-top: 0.5rem;
    font-style: italic;
}


.item-analytics {
     flex-shrink: 0;
     display: flex;
     gap: 1.5rem; /* Space between analytics stats */
     align-items: center;
}

.analytics-stat {
    text-align: center;
}

.analytics-stat .stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal for analytics numbers */
    margin-bottom: 0.125rem;
}

.analytics-stat .stat-label {
    font-size: 0.8rem;
    color: rgba(54, 69, 79, 0.7);
}


.item-actions {
    display: flex;
    gap: 0.75rem; /* Space between buttons */
    flex-shrink: 0;
    justify-content: center; /* Center buttons on small screens */
}

.edit-button,
.delete-button {
    background-color: #E2725B; /* Warm Coral/Terracotta background */
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.edit-button:hover,
.delete-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}

.delete-button {
    background-color: #EF4444; /* A red for delete */
}

.delete-button:hover {
    background-color: #DC2626; /* Darker red on hover */
}


/* Optional: Pagination Styling (if used) */
/* Reuse styles from browse pages if needed */


/* Responsive Adjustments */
@media (min-width: 768px) { /* Medium screens and up */
    .main-content-wrapper {
        padding-left: 2.5rem;
        padding-right: 2.5rem;
    }

    .content-item {
        flex-direction: row; /* Arrange elements horizontally */
        justify-content: space-between; /* Space out elements */
        align-items: center; /* Align items vertically */
    }

    .item-info {
        flex-grow: 2; /* Allow info to take more space */
    }

    .item-status {
         flex-grow: 1; /* Allow status to grow */
         text-align: center; /* Center status indicator */
    }

    .item-analytics {
        flex-grow: 1; /* Allow analytics to grow */
        justify-content: center; /* Center analytics stats */
    }

    .item-actions {
        flex-shrink: 0;
        justify-content: flex-end; /* Align buttons to the right */
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
        <section class="manage-content-section">
            <div class="container-creator-manage">
                <h1 class="page-title">Manage My Content</h1>

                <div class="content-list">
                    <?php if (isset($podcastQuery)): foreach ($podcastQuery as $podcast): ?>
                    <a href="/podcast_show/<?= htmlspecialchars($podcast['podcast_id']) ?>" class="content-item podcast-item">

                    <div class="content-item podcast-item">
                        <div class="item-info">
                            <span class="item-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                            <h3 class="item-title">Episode Title: <?= htmlspecialchars($podcast['title']) ?></h3>
                            <p class="item-date">Uploaded: <?= htmlspecialchars($podcast['created_at']) ?></p>
                        </div>
                        <div class="item-status">
                            <span class="status-indicator pending"><i class="fas fa-clock"></i> <?= htmlspecialchars($podcast['status']) ?></span>
                        </div>
                        <div class="item-analytics">
                             <div class="analytics-stat">
                                <span class="stat-number">150</span>
                                <span class="stat-label">Plays</span>
                             </div>
                             </div>
                        <div class="item-actions">
                            <button class="edit-button"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>
                    </a>
                    <?php endforeach; ?>
                    <?php endif; ?>


                    
                    <?php if (isset($episodeQuery)): foreach ($episodeQuery as $episode): ?>
                    <a href="/episode_show/<?= htmlspecialchars($episode['episode_id']) ?>" class="content-item episode-item">

                    <div class="content-item podcast-item">
                        <div class="item-info">
                            <span class="item-type"><i class="fas fa-podcast"></i> Podcast Episode</span>
                            <h3 class="item-title">Episode Title: <?= htmlspecialchars($episode['title']) ?></h3>
                            <p class="item-date">Uploaded: <?= htmlspecialchars($episode['release_date']) ?></p>
                        </div>
                        <!-- <div class="item-status">
                            <span class="status-indicator rejected"><i class="fas fa-times-circle"></i> Rejected</span>
                            <p class="rejection-reason">Reason: Contains copyrighted music.</p>
                        </div> -->
                        <div class="item-analytics">
                            <div class="analytics-stat">
                                <span class="stat-number">0</span>
                                <span class="stat-label">Plays</span>
                            </div>
                        </div>
                        <div class="item-actions">
                            <button class="edit-button"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>
                    </a>
                <?php endforeach; ?>
                    <?php endif; ?>



                    <?php if (isset($podcastQuery)): foreach ($bookQuery as $book): ?>
                    <a href="/book_show/<?= htmlspecialchars($book['book_id']) ?>" class="content-item book-item">

                    <div class="content-item book-item">
                        <div class="item-info">
                            <span class="item-type"><i class="fas fa-book-open"></i> Book</span>
                            <h3 class="item-title">My New Book: <?= htmlspecialchars($book['title']) ?></h3>
                            <p class="item-date">Uploaded: <?= htmlspecialchars($book['created_at']) ?></p>
                        </div>
                        <!-- <div class="item-status">
                            <span class="status-indicator approved"><i class="fas fa-check-circle"></i> Approved</span>
                        </div> -->
                         <div class="item-analytics">
                             <div class="analytics-stat">
                                <span class="stat-number">500</span>
                                <span class="stat-label">Views</span>
                             </div>
                             </div>
                        <div class="item-actions">
                            <button class="edit-button"><i class="fas fa-edit"></i> Edit</button>
                            <button class="delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </div>
                </div>
                </a>
                <?php endforeach; ?>
                    <?php endif; ?>


                </div>
        </section>
    </main>
<?php require('views/partials/footer.php') ?>