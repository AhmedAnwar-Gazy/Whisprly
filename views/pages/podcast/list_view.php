<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
 
<style>
  /* Search and Filtering Area */
.search-filter-area {
    display: flex;
    flex-direction: column; /* Stack search and filters vertically on small screens */
    gap: 1rem; /* Space between search and filters */
    margin-bottom: 2rem;
}

.search-bar {
    display: flex;
    gap: 0.5rem; /* Space between input and button */
    flex-grow: 1; /* Allow search bar to grow */
}

.search-input {
    flex-grow: 1; /* Allow input to fill space */
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db; /* Light gray border */
    border-radius: 0.25rem; /* Slightly rounded corners */
    font-size: 1rem;
    color: #36454F;
}

.search-button {
    background-color: #00697B; /* Deep Teal background */
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-button:hover {
    background-color: #005a6a; /* Slightly darker Teal on hover */
}

.filter-options {
    display: flex;
    gap: 1rem; /* Space between filter selects */
    flex-wrap: wrap; /* Allow filters to wrap on smaller screens */
}

.filter-select {
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db; /* Light gray border */
    border-radius: 0.25rem;
    font-size: 1rem;
    color: #36454F;
    background-color: #F8F5F0;
    cursor: pointer;
}
</style>
<?php require('views/partials/search.php') ?>

<main>
  <h1></h1>
  <section>




  </section>
</main>
<?php require('views/partials/footer.php') ?>