<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<?php $errors = ($_SESSION['errors'] ?? '' ) ; unset($_SESSION['errors']) ; ?>

<style>

/* login.css */

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

/* Universal Box Sizing for consistent layout behavior */
*, *::before, *::after {
    box-sizing: border-box;
}

/* Main Content Wrapper (for the form area) */
.main-content-wrapper {
    flex-grow: 1; /* Allows the content to fill available space */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Vertically center content */
    padding: 3rem 1.5rem; /* Responsive padding */
}

/* Form Container */
.form-container-wrapper {
    max-width: 400px; /* Equivalent to sm:max-w-sm */
    margin-left: auto;
    margin-right: auto;
    width: 100%; /* Ensure it takes full width up to max-width */
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border: 1px solid #d1d5db; /* Light border */
    border-radius: 0.5rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Subtle shadow */
}

.form-header {
    text-align: center;
    margin-bottom: 2.5rem; /* Equivalent to mt-10 */
}

.form-logo {
    display: block; /* Ensure it's a block element */
    margin-left: auto;
    margin-right: auto;
    height: 2.5rem; /* Equivalent to h-10 */
    width: auto;
    /* If you have a specific logo image, you'd set its src here */
    /* Example: background-image: url('/path/to/your-logo.png'); background-size: contain; background-repeat: no-repeat; */
}

.form-title {
    font-size: 2.25rem; /* Equivalent to text-2xl/9 */
    font-weight: bold;
    color: #00697B; /* Deep Teal, adjusted from gray-900 */
    margin-top: 2.5rem; /* Equivalent to mt-10 */
}

/* Form Styling */
.login-form {
    margin-top: 2.5rem; /* Equivalent to mt-10 */
    display: flex;
    flex-direction: column;
    gap: 1.5rem; /* Adjusted from 1rem (space-y-4) for better spacing */
}

.form-group {
    /* No specific styling needed here, gap on parent handles spacing */
}

.form-label {
    display: block;
    font-size: 0.875rem; /* Equivalent to text-sm/6 */
    font-weight: 500; /* Equivalent to font-medium */
    color: #36454F; /* Charcoal Gray */
    margin-bottom: 0.25rem; /* Small space below label */
}

.form-input-wrapper {
    margin-top: 0.5rem; /* Equivalent to mt-2 */
}

.form-input {
    display: block;
    width: 100%;
    border-radius: 0.375rem; /* Equivalent to rounded-md */
    background-color: white;
    padding: 0.375rem 0.75rem; /* Equivalent to px-3 py-1.5 */
    font-size: 1rem; /* Equivalent to text-base */
    color: #36454F; /* Charcoal Gray */
    outline: 1px solid #d1d5db; /* Equivalent to outline outline-1 outline-gray-300 */
    outline-offset: -1px; /* Equivalent to -outline-offset-1 */
    transition: outline-color 0.2s ease, outline-width 0.2s ease; /* Smooth transition */
}

.form-input::placeholder {
    color: rgba(54, 69, 79, 0.5); /* Equivalent to placeholder:text-gray-400 */
}

.form-input:focus {
    outline: 2px solid #00697B; /* Equivalent to focus:outline focus:outline-2 focus:outline-indigo-600 */
    outline-offset: -2px; /* Equivalent to focus:-outline-offset-2 */
}

/* Error Message Styling */
.error-message {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Align to start for error messages */
    color: #d8000c; /* Specific error red */
    font-size: 0.875rem; /* Equivalent to text-sm/6 */
    margin-top: 0.25rem; /* Small space above error */
    min-height: 1.5rem; /* Ensure space even if no error message */
}

/* Submit Button */
.submit-button-wrapper {
    margin-top: 1.5rem; /* Equivalent to mt-6 */
}

.submit-button {
    display: flex;
    width: 100%;
    justify-content: center;
    border-radius: 0.375rem; /* Equivalent to rounded-md */
    background-color: #E2725B; /* Warm Coral/Terracotta, adjusted from Deep Teal */
    padding: 0.75rem 1.5rem; /* Adjusted padding for a more prominent button */
    font-size: 1rem; /* Adjusted font size */
    font-weight: 600; /* Equivalent to font-semibold */
    color: white;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* Equivalent to shadow-sm */
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border: none; /* Remove default button border */
}

.submit-button:hover {
    background-color: #d1624c; /* Darker Coral on hover */
}

.submit-button:focus-visible {
    outline: 2px solid #E2725B; /* Adjust outline color to match button */
    outline-offset: 2px;
}

/* --- Popup and Overlay Styles --- */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
    z-index: 999;
    display: none; /* Hidden by default, controlled by JS */
}

.popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 0.75rem; /* Equivalent to 12px */
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    max-width: 600px;
    animation: fadeIn 0.4s ease;
    text-align: right; /* For RTL content */
    direction: rtl; /* For RTL content */
    display: none; /* Hidden by default, controlled by JS */
}

@keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -60%); }
    to   { opacity: 1; transform: translate(-50%, -50%); }
}

.close-btn {
    position: absolute;
    top: 10px;
    left: 10px; /* Position on the left for RTL */
    background-color: #36454F; /* Charcoal Gray */
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 1.125rem; /* Equivalent to 18px */
    cursor: pointer;
    z-index: 1001;
    transition: background-color 0.3s;
    display: flex; /* For centering the 'x' */
    justify-content: center;
    align-items: center;
}

.close-btn:hover {
    background-color: rgba(54, 69, 79, 0.8); /* Darker Charcoal Gray on hover */
}

.popup h2 {
    font-size: 1.5rem; /* Equivalent to 24px */
    margin-bottom: 0.625rem; /* Equivalent to 10px */
    /* Color will be set inline by PHP based on message type */
}

.popup h2 span {
    margin-left: 0.5rem; /* Space for icon */
}

.popup ul {
    font-size: 1rem; /* Equivalent to 16px */
    padding-left: 0;
    list-style: none;
    color: #333; /* Dark gray for list items */
}

.popup li {
    margin-bottom: 0.625rem; /* Equivalent to 10px */
}

.popup li span {
    font-weight: bold;
    margin-left: 0.5rem; /* Space for icon */
    /* Color will be set inline by PHP based on message type */
}

/* Responsive Adjustments */
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
    <section class="form-container-wrapper">
        <div class="form-header">
            <img class="form-logo" src="" alt="Your Company Logo">
            <h2 class="form-title">Log In</h2>
        </div>

        <form class="login-form" action="/login" method="POST">
            <div class="form-group">
                <label for="email" class="form-label">Email address :</label>
                <div class="form-input-wrapper">
                    <input type="email" name="email" id="email" autocomplete="email" required class="form-input">
                </div>
            </div>
            <div class="error-message">
                <?= $erorrs["email"] ?? " " ?>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password :</label>
                <div class="form-input-wrapper">
                    <input type="password" name="password" id="password" autocomplete="current-password" required class="form-input">
                </div>
            </div>

            <div class="error-message">
                <?= $erorrs["password"] ?? " " ?>
            </div>

            <div class="submit-button-wrapper">
                <button type="submit" class="submit-button">Log In</button>
            </div>
        </form>
    </section>

    <?php
    // PHP logic for messages and popup
    $messages = [
        'error' => $erorrs ?? [], // Initialize with empty array if no errors are set
        'success' => $success ?? [], // Initialize with empty array if no success messages are set
        'warning' => $warning ?? [],
        'info' => $info ?? [],
    ];

    $icons = [
        'error' => '❌',
        'success' => '✅',
        'warning' => '⚠️',
        'info' => 'ℹ️',
    ];

    $colors = [
        'error' => '#d8000c',
        'success' => '#4BB543',
        'warning' => '#ff9b00',
        'info' => '#00529B',
    ];

    // Check if any message type has actual messages to display
    $hasMessages = false;
    $displayType = '';
    $displayMsgs = [];

    foreach ($messages as $type => $msgs) {
        if (!empty($msgs)) {
            $hasMessages = true;
            $displayType = $type;
            $displayMsgs = $msgs;
            break; // Only display the first type of message found
        }
    }

    if ($hasMessages): // Only render the popup HTML if there are messages
    ?>
    <div class="overlay"></div>

    <div class="popup" style="color: <?= $colors[$displayType] ?>;">
        <button onclick="closePopup()" class="close-btn">&times;</button>
        <h2>
            <span style="margin-left: 8px;"></span>
        </h2>
        <ul>
            <?php foreach ($displayMsgs as $msg): ?>
                <li>
                    <span style="color: <?= $colors[$displayType] ?>; font-weight: bold; margin-left: 8px;"><?= $icons[$displayType] ?></span>
                    <?= htmlspecialchars($msg) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
        // PHP-generated JavaScript to show popup if messages exist
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.querySelector('.popup');
            const overlay = document.querySelector('.overlay');
            if (popup && overlay) {
                popup.style.display = 'block';
                overlay.style.display = 'block';
            }
        });

        function closePopup() {
            document.querySelector('.popup').style.display = 'none';
            document.querySelector('.overlay').style.display = 'none';
        }
    </script>
    <?php
    endif; // End of conditional rendering for the popup
    ?>
</main>

<?php require('views/partials/footer.php') ?>
