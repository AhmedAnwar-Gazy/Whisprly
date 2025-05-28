document.addEventListener('DOMContentLoaded', function() {
    var offset = initialOffset || 0; // Get initial offset from PHP
    var limit = 5; // Number of items to load per AJAX request
    var isLoading = false; // Flag to prevent multiple simultaneous requests
    var contentContainer = document.getElementById('content-container');
    var loadingSpinner = document.getElementById('loading-spinner');

    function loadMoreProducts() {
        if (isLoading) {
            
            return; // Don't load if a request is already in progress
        }
        
        isLoading = true;
        loadingSpinner.style.display = 'block'; // Show spinner
        //alert(offset); 
        
        fetch('/data?limit=' + limit + '&offset=' + offset)
        .then(response => response.json())
        .then(data => {
      
                if (data.success) {
                    if (data.products.length > 0) {
                        //console.log(data.products);
                        data.products.forEach(product => {
                            var productItem = document.createElement('div');
                            //alert(product.podcast_id);
                            productItem.classList.add('product-item');
                            productItem.dataset.id = product.podcast_id;
                            productItem.innerHTML = `
                            <a href="/podcast_show?podcast_id=${product.podcast_id}">
                                <div class="podcast-series-card">
                                    <img src="/views/media/images/image.png" alt="Podcast Series Cover" class="series-cover">
                                        <div class="series-info" >
                                            <h3 class="series-title">${product.title}</h3>
                                            <p class="series-creator">${product.podcast_id}</p>
                                            <p class="series-description">${product.description}</p>
                                        </div>
                                </div>
                            </a>
                            `;
                            contentContainer.appendChild(productItem);
                        });
                        offset += data.products.length; // Update offset for the next request
                    } else {
                        // No more products to load
                        console.log("No more products to load.");
                        window.removeEventListener('scroll', handleScroll); // Stop listening for scroll
                        loadingSpinner.innerHTML = "No more products available.";
                    }
                } else {
                    console.error('Error fetching data:', data.message);
                }
            })
            .catch(error => {
                console.error('Network error:', error);
            })
            .finally(() => {
                isLoading = false;
                loadingSpinner.style.display = 'none'; // Hide spinner
            });
    }

    function handleScroll() {
        
        // Calculate how close the user is to the bottom
        var scrollHeight = document.documentElement.scrollHeight;
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var clientHeight = document.documentElement.clientHeight;

        // Trigger loading when user is within 100 pixels of the bottom
        if (scrollTop + clientHeight >= scrollHeight - 100) {

            loadMoreProducts();
        }
    }

    // Add scroll event listener
    window.addEventListener('scroll', handleScroll);

    // Optional: Load more products if the initial content doesn't fill the screen
    // This helps in cases where there are very few initial items
    if (document.body.scrollHeight <= window.innerHeight) {
        loadMoreProducts();
    }
});