<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

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