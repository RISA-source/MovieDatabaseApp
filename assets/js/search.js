// Ajax autocomplete search functionality
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    
    if (titleInput) {
        let suggestionBox = document.createElement('div');
        suggestionBox.className = 'autocomplete-suggestions';
        titleInput.parentNode.appendChild(suggestionBox);
        
        let debounceTimer;
        
        titleInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            
            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                suggestionBox.style.display = 'none';
                return;
            }
            
            debounceTimer = setTimeout(function() {
                fetch('/MovieApp/public/ajax_search.php?q=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            let html = '';
                            data.forEach(movie => {
                                html += '<div class="suggestion-item" data-title="' + movie.title + '">';
                                html += '<strong>' + movie.title + '</strong> (' + movie.year + ')';
                                html += '</div>';
                            });
                            suggestionBox.innerHTML = html;
                            suggestionBox.style.display = 'block';
                            
                            // Add click handlers
                            document.querySelectorAll('.suggestion-item').forEach(item => {
                                item.addEventListener('click', function() {
                                    titleInput.value = this.getAttribute('data-title');
                                    suggestionBox.innerHTML = '';
                                    suggestionBox.style.display = 'none';
                                });
                            });
                        } else {
                            suggestionBox.innerHTML = '<div class="suggestion-item no-results">No movies found</div>';
                            suggestionBox.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        suggestionBox.innerHTML = '';
                        suggestionBox.style.display = 'none';
                    });
            }, 300);
        });
        
        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target !== titleInput) {
                suggestionBox.innerHTML = '';
                suggestionBox.style.display = 'none';
            }
        });
    }
});