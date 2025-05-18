<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="main-content-wrapper">
        <section class="account-settings-section">
            <div class="container">
                <h1 class="page-title">Account Settings</h1>

                <div class="settings-group">
                    <h2 class="group-title">Profile Information</h2>
                    <div class="setting-item">
                        <label for="username" class="setting-label">Username:</label>
                        <input type="text" id="username" class="setting-input" value="CurrentUsername">
                    </div>
                    <div class="setting-item">
                        <label for="email" class="setting-label">Email:</label>
                        <input type="email" id="email" class="setting-input" value="user@example.com">
                    </div>
                    <div class="setting-item">
                        <label for="password" class="setting-label">Password:</label>
                        <input type="password" id="password" class="setting-input" value="********">
                        <button class="change-password-button">Change Password</button>
                    </div>
                </div>

                <div class="settings-group">
                    <h2 class="group-title">Notification Preferences</h2>
                    <div class="setting-item checkbox-item">
                        <input type="checkbox" id="new-episode-notifications" class="setting-checkbox">
                        <label for="new-episode-notifications" class="setting-label">Notify me about new episodes from subscribed podcasts</label>
                    </div>
                    <div class="setting-item checkbox-item">
                        <input type="checkbox" id="book-recommendations" class="setting-checkbox">
                        <label for="book-recommendations" class="setting-label">Receive book recommendations</label>
                    </div>
                    </div>

                <div class="settings-group">
                    <h2 class="group-title">Subscription Status</h2>
                    <div class="setting-item">
                        <p>Your current plan: <strong class="status-text">Free Tier</strong></p>
                        <button class="manage-subscription-button">Manage Subscription</button>
                    </div>
                </div>

                <div class="settings-group">
                    <h2 class="group-title">Linked Accounts</h2>
                     <div class="setting-item">
                        <p>Linked via: <strong class="linked-account">Google</strong></p>
                        <button class="unlink-account-button"><i class="fas fa-unlink"></i> Unlink</button>
                    </div>
                     <div class="setting-item">
                        <p>Linked via: <strong class="linked-account">Apple</strong></p>
                        <button class="unlink-account-button"><i class="fas fa-unlink"></i> Unlink</button>
                    </div>
                    </div>

                <div class="settings-group delete-account-group">
                    <h2 class="group-title">Account Management</h2>
                    <div class="setting-item">
                        <p>Permanently delete your Whisprly account and all associated data.</p>
                        <button class="delete-account-button"><i class="fas fa-trash-alt"></i> Delete Account</button>
                    </div>
                </div>

                <div class="save-changes-area">
                    <button class="save-changes-button">Save Changes</button>
                </div>

            </div>
        </section>
    </main>
<?php require('views/partials/footer.php') ?>