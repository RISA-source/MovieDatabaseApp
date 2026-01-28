// Client-side form validation
document.addEventListener('DOMContentLoaded', function() {
    
    // Add movie form validation
    const addMovieForm = document.querySelector('form[action*="add_movie"]');
    const editMovieForm = document.querySelector('form[action*="edit_movie"]');
    
    function validateMovieForm(e) {
        let isValid = true;
        let errorMessage = '';
        
        // Get form fields
        const title = document.getElementById('title');
        const year = document.getElementById('year');
        const genre = document.getElementById('genre');
        const rating = document.getElementById('rating');
        const description = document.getElementById('description');
        const poster = document.getElementById('poster');
        
        // Clear previous errors
        document.querySelectorAll('.field-error').forEach(el => el.remove());
        
        // Validate title
        if (title && title.value.trim().length < 2) {
            showError(title, 'Title must be at least 2 characters');
            isValid = false;
        }
        
        // Validate year
        if (year) {
            const yearValue = parseInt(year.value);
            const currentYear = new Date().getFullYear();
            if (yearValue < 1800 || yearValue > currentYear + 5) {
                showError(year, 'Year must be between 1800 and ' + (currentYear + 5));
                isValid = false;
            }
        }
        
        // Validate genre
        if (genre && genre.value.trim().length < 2) {
            showError(genre, 'Genre is required');
            isValid = false;
        }
        
        // Validate rating
        if (rating) {
            const ratingValue = parseFloat(rating.value);
            if (ratingValue < 0 || ratingValue > 10) {
                showError(rating, 'Rating must be between 0 and 10');
                isValid = false;
            }
        }
        
        // Validate description
        if (description && description.value.trim().length < 10) {
            showError(description, 'Description must be at least 10 characters');
            isValid = false;
        }
        
        // Validate file upload (if present and has file)
        if (poster && poster.files.length > 0) {
            const file = poster.files[0];
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            const maxSize = 5 * 1024 * 1024; // 5MB
            
            if (!allowedTypes.includes(file.type)) {
                showError(poster, 'Only JPG, PNG, GIF images are allowed');
                isValid = false;
            }
            
            if (file.size > maxSize) {
                showError(poster, 'File size must not exceed 5MB');
                isValid = false;
            }
        }
        
        if (!isValid) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        return isValid;
    }
    
    function showError(field, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
        field.style.borderColor = '#e74c3c';
    }
    
    // Attach validation to forms
    if (addMovieForm) {
        addMovieForm.addEventListener('submit', validateMovieForm);
    }
    
    if (editMovieForm) {
        editMovieForm.addEventListener('submit', validateMovieForm);
    }
    
    // Real-time validation feedback
    const inputFields = document.querySelectorAll('input, textarea, select');
    inputFields.forEach(field => {
        field.addEventListener('input', function() {
            this.style.borderColor = '#ddd';
            const error = this.parentNode.querySelector('.field-error');
            if (error) {
                error.remove();
            }
        });
    });
});