# Movie Database - PHP CRUD Application

A full-featured movie management system with admin panel, search functionality, and secure user authentication built with PHP and MySQL.

## Live Demo

**Live Site:** https://movie-database-app.infinityfree.me

---

## Overview

This project is a web-based movie database management system that demonstrates implementation of CRUD operations, secure authentication, file handling, and dynamic search functionality using PHP and MySQL. The application features both public-facing pages for browsing movies and an administrative interface for content management.

## Features

### Public Interface
- Browse complete movie catalog with poster gallery
- View detailed movie information including cast and description
- Multi-criteria search functionality (title, year, genre, rating)
- AJAX-powered autocomplete search suggestions
- Responsive design optimized for desktop and mobile devices

### Administrative Interface
- Secure authentication system
- Complete CRUD operations (Create, Read, Update, Delete)
- Image upload with server-side validation
- Dashboard for managing movie database
- Client-side and server-side form validation

## Security Implementation

- **SQL Injection Prevention** - PDO prepared statements for all database queries
- **XSS Protection** - HTML special characters escaping on all outputs
- **Password Security** - Bcrypt hashing algorithm for password storage
- **File Upload Validation**
  - MIME type verification (JPG, PNG, GIF only)
  - File size restrictions (5MB maximum)
  - Image integrity verification using getimagesize()
- **Session Management** - Secure session handling for authentication

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache or Nginx web server
- PDO PHP Extension
- GD Library for image processing

## Installation

### Database Setup

1. Create a new MySQL database:
```sql
CREATE DATABASE movie_db;
```

2. Import the provided SQL schema:
```bash
mysql -u username -p movie_db < movie_db.sql
```

### Application Configuration

1. Clone or download the repository to your web server directory

2. Copy the database configuration template:
```bash
cp config/database.example.php config/database.php
```

3. Update database credentials in `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'movie_db');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

4. Configure the application base URL in `config/app.php`:
```php
define('BASE_URL', ''); // Leave empty for root directory
```

5. Ensure the uploads directory has appropriate permissions:
```bash
chmod 755 uploads/posters
```

6. Access the application through your web browser

## Usage

### Public Users

1. **Browse Movies** - The homepage displays all movies in a responsive grid layout
2. **Search Movies** - Use the search interface to filter by:
   - Movie title with autocomplete suggestions
   - Release year
   - Genre
   - Minimum rating threshold
3. **View Details** - Select any movie to view comprehensive information

### Administrators

1. Access the admin panel at `/public/admin/login.php`
2. After authentication, administrators can:
   - Add new movies with complete metadata and poster images
   - Edit existing movie information
   - Delete movies from the database
   - View all movies in a tabular format

## Technical Implementation

### Backend Architecture
- **Language**: PHP 7.4+
- **Database**: MySQL with PDO abstraction layer
- **Design Pattern**: MVC-inspired structure with separated concerns
- **Security**: Multiple layers including prepared statements, password hashing, and input sanitization

### Frontend Technologies
- **Markup**: HTML5 semantic elements
- **Styling**: CSS3 with responsive grid layout
- **Scripting**: Vanilla JavaScript for interactivity
- **AJAX**: XMLHttpRequest for asynchronous operations

### Database Schema

**movies table**
| Column      | Type         | Constraints    | Description              |
|-------------|--------------|----------------|--------------------------|
| id          | INT          | PRIMARY KEY    | Auto-incrementing ID     |
| title       | VARCHAR(255) | NOT NULL       | Movie title              |
| year        | INT          | NOT NULL       | Release year             |
| genre       | VARCHAR(100) | NOT NULL       | Movie genre              |
| rating      | DECIMAL(3,1) | NOT NULL       | Rating (0.0 - 10.0)      |
| description | TEXT         | NOT NULL       | Movie synopsis           |
| cast        | TEXT         | NULL           | Cast members             |
| poster      | VARCHAR(255) | NOT NULL       | Poster filename          |
| created_at  | TIMESTAMP    | DEFAULT NOW()  | Record creation time     |

**admins table**
| Column   | Type         | Constraints    | Description              |
|----------|--------------|----------------|--------------------------|
| id       | INT          | PRIMARY KEY    | Auto-incrementing ID     |
| username | VARCHAR(50)  | UNIQUE         | Admin username           |
| password | VARCHAR(255) | NOT NULL       | Bcrypt hashed password   |

## Key Features Implementation

### Search Functionality
The search system implements dynamic query building with prepared statements to prevent SQL injection while allowing flexible multi-criteria filtering.

### File Upload System
Server-side validation includes MIME type checking, file size restrictions, and image verification to ensure only valid image files are stored.

### AJAX Autocomplete
Real-time search suggestions are implemented using asynchronous JavaScript requests with debouncing to optimize performance.

### Form Validation
Dual-layer validation with both client-side JavaScript (for user experience) and server-side PHP (for security) ensures data integrity.

## Known Limitations

- Single administrator account without role-based access control
- No user registration system for public users
- Pagination not implemented for large datasets
- No user-generated content features (reviews, ratings)
- Limited to single-server deployment without load balancing

## Academic Compliance

This project demonstrates the following concepts and requirements:

- Implementation of CRUD operations in a web application
- PHP and MySQL integration for dynamic content management
- Prepared statements for SQL injection prevention
- Output escaping for XSS protection
- Multi-criteria search with dynamic query construction
- File upload handling with validation
- Secure authentication and session management
- Responsive web design principles
- Client-side and server-side form validation
- AJAX for asynchronous operations

## Future Enhancements

- Implementation of user registration and authentication system
- User-generated reviews and rating functionality
- Pagination for improved scalability
- Advanced filtering options (director, actors, language)
- RESTful API for third-party integrations
- Role-based access control for multiple administrators
- Caching mechanisms for improved performance
- Unit and integration testing suite

## License

This project is licensed under the MIT License. See the LICENSE file for complete terms and conditions.

## Acknowledgments

Developed as part of Full Stack Development coursework to demonstrate practical application of web development technologies, database management, and security best practices.

---

**Note:** This is an academic project developed for educational purposes. Production deployment would require additional security hardening and scalability considerations.
