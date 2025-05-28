<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<style>
    body {
        font-family: 'Inter', sans-serif;
        /* Apply Inter font */
        background-color: #F8F5F0;
        /* Soft Cream/Off-White background */
        color: #36454F;
        /* Charcoal Gray text */
        margin: 0;
        padding: 0;
        line-height: 1.6;
        display: flex;
        /* Use flexbox for layout */
        flex-direction: column;
        /* Stack children vertically */
        min-height: 100vh;
        /* Ensure body takes at least full viewport height */
    }

    /* CSS for the main content wrapper to push the footer down */
    .main-content-wrapper {
        flex-grow: 1;
        /* Allow this section to grow and fill available space */
        padding: 1.5rem 1.5rem;
        /* Add padding */
    }

    /* Container for layout */
    .container {
        max-width: 700px;
        /* Container width for settings content */
        margin: 0 auto;
        /* Center the container */
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #00697B;
        /* Deep Teal for page title */
        margin-bottom: 2rem;
        text-align: center;
        /* Center the title */
    }

    /* Settings Group Styling */
    .settings-group {
        background-color: #F8F5F0;
        /* Soft Cream/Off-White background */
        border: 1px solid #d1d5db;
        /* Light border */
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        /* Subtle shadow */
    }

    .group-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #00697B;
        /* Deep Teal heading */
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #d1d5db;
        /* Separator line */
    }

    .setting-item {
        display: flex;
        flex-direction: column;
        /* Stack label and input vertically on small screens */
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px dashed #e5e7eb;
        /* Dashed separator */
    }

    .setting-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
        /* No border for the last item */
    }

    .setting-label {
        font-size: 1rem;
        font-weight: 500;
        color: #36454F;
        margin-bottom: 0.5rem;
    }

    .setting-input {
        flex-grow: 1;
        /* Allow input to fill space */
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        font-size: 1rem;
        color: #36454F;
        background-color: white;
        /* White background for input */
    }

    .change-password-button {
        background-color: #E2725B;
        /* Warm Coral/Terracotta background */
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
        margin-top: 0.75rem;
        /* Space above button */
    }

    .change-password-button:hover {
        background-color: #d1624c;
        /* Slightly darker Coral on hover */
    }

    /* Checkbox Item Specifics */
    .setting-item.checkbox-item {
        flex-direction: row;
        /* Arrange checkbox and label horizontally */
        align-items: center;
        /* Align items vertically */
        gap: 0.5rem;
        /* Space between checkbox and label */
    }

    .setting-checkbox {
        /* Basic checkbox styling */
        width: 1rem;
        height: 1rem;
        cursor: pointer;
    }

    .setting-item.checkbox-item .setting-label {
        margin-bottom: 0;
        /* Remove bottom margin for label */
    }

    /* Subscription Status Specifics */
    .status-text {
        font-weight: bold;
        color: #00697B;
        /* Deep Teal for free tier */
    }

    .status-text.premium {
        color: #FF7F50;
        /* Warm Coral/Terracotta for premium */
    }

    .manage-subscription-button {
        background-color: #00697B;
        /* Deep Teal background */
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
        margin-top: 0.75rem;
    }

    .manage-subscription-button:hover {
        background-color: #005a6a;
        /* Slightly darker Teal on hover */
    }


    /* Linked Accounts Specifics */
    .linked-account {
        font-weight: 500;
        color: #36454F;
        margin-right: 0.5rem;
    }

    .unlink-account-button {
        background: none;
        border: none;
        cursor: pointer;
        color: #E2725B;
        /* Warm Coral/Terracotta icon color */
        font-size: 0.9rem;
        transition: color 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .unlink-account-button:hover {
        color: #d1624c;
        /* Slightly darker Coral on hover */
    }

    /* Delete Account Specifics */
    .delete-account-group {
        border-color: #E2725B;
        /* Highlight delete section with Coral border */
    }

    .delete-account-button {
        background-color: #E2725B;
        /* Warm Coral/Terracotta background */
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
        margin-top: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .delete-account-button:hover {
        background-color: #d1624c;
        /* Slightly darker Coral on hover */
    }

    /* Save Changes Area */
    .save-changes-area {
        text-align: center;
        margin-top: 2rem;
    }

    .save-changes-button {
        background-color: #00697B;
        /* Deep Teal background */
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        font-size: 1.1rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .save-changes-button:hover {
        background-color: #005a6a;
        /* Slightly darker Teal on hover */
    }


    /* Responsive Adjustments */
    @media (min-width: 600px) {

        /* Adjust breakpoint as needed */
        .setting-item {
            flex-direction: row;
            /* Arrange label and input horizontally */
            align-items: center;
            /* Align items vertically */
            justify-content: space-between;
            /* Space out label and input/button */
            gap: 1rem;
            /* Space between elements */
        }

        .setting-label {
            margin-bottom: 0;
            /* Remove bottom margin */
            flex-shrink: 0;
            /* Prevent label from shrinking */
        }

        .setting-input {
            flex-grow: 1;
            /* Allow input to grow */
        }

        .change-password-button,
        .manage-subscription-button,
        .unlink-account-button,
        .delete-account-button {
            margin-top: 0;
            /* Remove top margin */
        }

        .setting-item.checkbox-item {
            justify-content: flex-start;
            /* Align checkbox items to the left */
        }
    }

    @media (min-width: 768px) {

        /* Medium screens and up */
        .main-content-wrapper {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }
    }

    @media (min-width: 1024px) {

        /* Large screens and up */
        .main-content-wrapper {
            padding-left: 4rem;
            padding-right: 4rem;
        }
    }
</style>


<main class="main-content-wrapper">
    <section class="account-settings-section">
        <div class="container_page">
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