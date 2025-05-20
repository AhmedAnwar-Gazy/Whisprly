<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>/* category-management.css */

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
    max-width: 800px; /* Container width for content */
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

/* Existing Categories List */
.existing-categories {
    margin-bottom: 3rem;
}

.category-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.category-item {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.25rem;
    padding: 1rem;
    margin-bottom: 0.75rem;
    display: flex;
    flex-direction: column; /* Stack vertically on small screens */
    align-items: flex-start; /* Align items to the start */
    gap: 1rem; /* Space between elements */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.category-name {
    flex-grow: 1; /* Allow name to take available space */
    font-size: 1.1rem;
    font-weight: 500;
    color: #36454F; /* Charcoal Gray text */
}

.category-actions {
    display: flex;
    gap: 0.75rem; /* Space between buttons */
    flex-shrink: 0; /* Prevent actions from shrinking */
}

/* Action Button Styling (reusing styles from other admin pages) */
.action-button {
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

.action-button:hover {
    background-color: #d1624c; /* Slightly darker Coral on hover */
}

.edit-button {
    /* Default action button style */
}

.delete-button {
    background-color: #EF4444; /* Red for delete */
}

.delete-button:hover {
    background-color: #DC2626; /* Darker red on hover */
}


/* Add New Category Form */
.add-new-category {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.add-category-form .form-group {
    margin-bottom: 1rem; /* Adjust margin for form groups within this section */
    padding-bottom: 1rem;
    border-bottom: 1px dashed #e5e7eb;
}

.add-category-form .form-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}


.form-label {
    display: block; /* Make label a block element */
    font-size: 1rem;
    font-weight: 500;
    color: #36454F;
    margin-bottom: 0.75rem;
}

.form-input {
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

.submit-group {
    text-align: center;
    margin-top: 1.5rem; /* Space above submit button */
}

.submit-button {
    background-color: #00697B; /* Deep Teal background */
    color: white;
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1.1rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.submit-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}


/* Responsive Adjustments */
@media (min-width: 600px) { /* Adjust breakpoint as needed */
     .category-item {
        flex-direction: row; /* Arrange horizontally */
        justify-content: space-between; /* Space out elements */
        align-items: center; /* Align items vertically */
    }

    .category-name {
        flex-grow: 1;
    }

    .category-actions {
        flex-shrink: 0;
    }

     .add-category-form .form-group {
        display: flex; /* Use flexbox for form group */
        align-items: center;
        gap: 1rem;
    }

    .add-category-form .form-label {
        margin-bottom: 0;
        flex-shrink: 0;
        width: 150px; /* Fixed width for label */
    }

    .add-category-form .form-input {
        flex-grow: 1;
    }

    .submit-group {
        text-align: left; /* Align submit button to the left */
    }
}

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
        <section class="category-management-section">
            <div class="container">
                <h1 class="page-title">Category Management</h1>

                <div class="existing-categories">
                    <h2 class="section-heading">Existing Categories</h2>
                    <ul class="category-list">
                        <li class="category-item">
                            <span class="category-name">Technology</span>
                            <div class="category-actions">
                                <button class="action-button edit-button"><i class="fas fa-edit"></i> Edit</button>
                                <button class="action-button delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                            </div>
                        </li>
                         <li class="category-item">
                            <span class="category-name">Business</span>
                            <div class="category-actions">
                                <button class="action-button edit-button"><i class="fas fa-edit"></i> Edit</button>
                                <button class="action-button delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                            </div>
                        </li>
                         <li class="category-item">
                            <span class="category-name">Fiction</span>
                            <div class="category-actions">
                                <button class="action-button edit-button"><i class="fas fa-edit"></i> Edit</button>
                                <button class="action-button delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                            </div>
                        </li>
                         <li class="category-item">
                            <span class="category-name">Self-Help</span>
                            <div class="category-actions">
                                <button class="action-button edit-button"><i class="fas fa-edit"></i> Edit</button>
                                <button class="action-button delete-button"><i class="fas fa-trash-alt"></i> Delete</button>
                            </div>
                        </li>
                        </ul>
                </div>

                <div class="add-new-category">
                    <h2 class="section-heading">Add New Category</h2>
                    <form class="add-category-form">
                        <div class="form-group">
                            <label for="new-category-name" class="form-label">Category Name:</label>
                            <input type="text" id="new-category-name" class="form-input" required>
                        </div>
                        <div class="form-group submit-group">
                            <button type="submit" class="submit-button"><i class="fas fa-plus-circle"></i> Add Category</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </main>
<?php require('views/parts/footer.php') ?>