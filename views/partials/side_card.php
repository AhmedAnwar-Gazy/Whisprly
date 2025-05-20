
<style>/* cards.css */

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
/* Apply this class to the div that wraps your main page content */
.main-content-wrapper {
    flex-grow: 1; /* Allow this section to grow and fill available space */
    padding: 1.5rem 1.5rem; /* Add padding */
}

/* Container for layout */
.container {
    max-width: 1200px; /* Max width similar to Tailwind container */
    margin: 0 auto; /* Center the container */
}

.section-title {
    font-size: 2rem;
    font-weight: bold;
    color: #00697B; /* Deep Teal for section titles */
    margin-bottom: 1.5rem;
    text-align: center; /* Center the title */
}

/* Card Grid Layout - Adjusted for primarily horizontal cards */
.card-grid {
    display: grid;
    /* Adjust grid template to better accommodate horizontal cards */
    /* This example sets up columns that are at least 300px and flex */
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem; /* Space between cards */
}

/* Individual Card Styling - Defaulting to Horizontal Layout */
.content-card {
    background-color: #F8F5F0; /* Soft Cream/Off-White background */
    border-radius: 0.5rem; /* Rounded corners */
    border: 2px solid transparent; /* Add a transparent border */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    overflow: hidden; /* Hide overflow for rounded corners */
    display: flex; /* Use flexbox for horizontal layout */
    flex-direction: row; /* Arrange content horizontally */
    transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.5s ease, border-color 0.3s ease; /* Smooth transitions including border-color */
    cursor: pointer; /* Indicate clickable */
    opacity: 0; /* Start hidden for fade-in animation */
    animation: fadeIn 0.5s ease forwards; /* Apply fade-in animation */
}

/* Animation Keyframes */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px); /* Optional: slight move up */
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply animation delay to stagger the fade-in */
.card-grid .content-card:nth-child(1) { animation-delay: 0.1s; }
.card-grid .content-card:nth-child(2) { animation-delay: 0.2s; }
.card-grid .content-card:nth-child(3) { animation-delay: 0.3s; }
.card-grid .content-card:nth-child(4) { animation-delay: 0.4s; }
.card-grid .content-card:nth-child(5) { animation-delay: 0.5s; }
.card-grid .content-card:nth-child(6) { animation-delay: 0.6s; }
/* Add more delays for more cards */


.content-card:hover {
    transform: translateY(-5px) scale(1.02); /* Lift and slightly scale card on hover */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Enhance shadow on hover */
    border-color: #00697B; /* Deep Teal border on hover */
}

.card-cover {
    width: 35%; /* Adjust width of image for horizontal layout */
    height: auto; /* Auto height to maintain aspect ratio */
    flex-shrink: 0; /* Prevent image from shrinking */
    object-fit: cover; /* Ensure cover fills the space without distortion */
    /* Remove specific aspect ratios here unless needed for specific card types */
}

.card-info {
    padding: 1rem; /* Padding inside the card */
    flex-grow: 1; /* Allow info section to grow */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Vertically center content in info */
}

.card-title {
    font-size: 1.1rem;
    font-weight: bold;
    color: #36454F; /* Charcoal Gray title */
    margin-bottom: 0.5rem;
}

.card-creator {
    font-size: 0.9rem;
    color: rgba(54, 69, 79, 0.8); /* Slightly lighter color for creator */
    margin-bottom: 0.5rem;
}

.card-meta {
    font-size: 0.8rem;
    color: rgba(54, 69, 79, 0.6); /* Even lighter color for metadata */
    margin-top: auto; /* Push meta to the bottom */
}

/* If you still want to support vertical cards, you would add overrides here */

.vertical-card {
    flex-direction: column;
}

.vertical-card .card-cover {
    width: 100%;
    aspect-ratio: unset;
    /* Or set specific vertical aspect ratio*/
}



/* Responsive Adjustments for padding */
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
<!-- <main class="main-content-wrapper">
        <section class="container">
            <h2 class="section-title">Featured Content</h2> -->

            <div class="card-grid">
                <div class="content-card vertical-card podcast-card">
                    <img src="https://placehold.co/300x300/00697B/F8F5F0?text=Podcast+Cover" alt="Podcast Cove" class="card-cover">
                    <div class="card-info">
                        <h3 class="card-title">The Daily Show Podcast</h3>
                        <p class="card-creator">By Comedy Central</p>
                        <p class="card-meta">Episode 123 | 45 min</p>
                    </div>
                </div>

            </div>
