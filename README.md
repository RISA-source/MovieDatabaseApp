# Movie Database - CRUD Application

A simple PHP-based movie management system with admin panel and public viewing interface.

## Features

- Full CRUD operations for movies (admin only)
- Image upload for movie posters
- Multi-criteria search (title, year, genre, rating)
- Secure admin authentication
- SQL injection prevention using PDO prepared statements
- XSS protection with output escaping
- Responsive design

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server

## Default Admin Credentials
```
Username: admin
Password: admin123
```

## Usage

### Public Users
- Browse all movies on homepage
- View detailed movie information
- Search movies by title, year, genre, or rating

### Admin Users
- Login to admin panel
- Add new movies with poster upload
- Edit existing movie details
- Delete movies from database

## Security Features

- **SQL Injection Prevention:** PDO with prepared statements
- **XSS Protection:** HTML special characters escaping
- **Password Security:** Bcrypt hashing
- **File Upload Validation:** 
  - File type checking (JPG, PNG, GIF only)
  - File size limit (5MB max)
  - Image verification using `getimagesize()`
- **Session Management:** Secure admin authentication

## Technical Details

- **Backend:** PHP 
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript

## Known Limitations

- Single admin account only
- No user registration (public viewing only)
- Basic search functionality
- No pagination for large datasets

## Assignment Compliance

This project fulfills the following requirements:

* CRUD operations (Create, Read, Update, Delete)  
* PHP + MySQL backend  
* Prepared statements (SQL injection prevention)  
* XSS protection (output escaping)  
* Search functionality (multi-criteria)  
* File upload feature (image handling)  
* Secure authentication system  
* Clean, organized code structure  

## Credits

Developed as part of Full Stack Development Module Assignment.