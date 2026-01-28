// Simple autocomplete for search page
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    
    if (titleInput) {
        titleInput.addEventListener('input', function() {
            const query = this.value;
            
            if (query.length >= 2) {
                fetch('/movie_crud/public/ajax_search.php?q=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        console.log('Search suggestions:', data);
                        // You can add autocomplete dropdown here
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }
});