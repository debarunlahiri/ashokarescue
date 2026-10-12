# Ashoka Rescue - Plain PHP Version

This is a converted version of the Laravel-based Ashoka Rescue Air Ambulance Services website, now running on plain PHP, HTML, CSS, JavaScript, and Bootstrap.

## Requirements

-   PHP 7.4 or higher (8.x recommended)
-   MySQL 5.7 or higher / MariaDB 10.2 or higher
-   Apache with mod_rewrite enabled
-   XAMPP (recommended for local development)

## Installation Instructions

### 1. Database Setup

1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named `ashoka_rescue`
3. Import the database schema:
    - Click on the `ashoka_rescue` database
    - Go to "Import" tab
    - Choose file: `sql/database.sql`
    - Click "Go" to import

### 2. Configuration

1. Open `includes/config.php`
2. Update the following settings if needed:

    ```php
    // Database Configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'ashoka_rescue');

    // Site URL (update based on your setup)
    define('SITE_URL', 'http://localhost/ashoka-rescue-plain');
    ```

3. Configure email settings for form submissions:
    ```php
    // Email Configuration (SMTP)
    define('SMTP_HOST', 'smtp.gmail.com');
    define('SMTP_PORT', 587);
    define('SMTP_USERNAME', 'your-email@gmail.com');
    define('SMTP_PASSWORD', 'your-app-password');
    ```

### 3. Install PHPMailer (for email functionality)

Run the following commands in the project root:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/ashoka-rescue/ashoka-rescue-plain
mkdir vendor
cd vendor
mkdir phpmailer
cd phpmailer
# Download PHPMailer from https://github.com/PHPMailer/PHPMailer
# Or use Composer: composer require phpmailer/phpmailer
```

Alternatively, download PHPMailer manually:

1. Download from: https://github.com/PHPMailer/PHPMailer/archive/refs/heads/master.zip
2. Extract to `vendor/phpmailer/phpmailer/`

### 4. File Permissions

Ensure the uploads directory is writable:

```bash
chmod 755 assets/uploads
```

### 5. Apache Configuration

Make sure mod_rewrite is enabled in Apache:

1. Open XAMPP Control Panel
2. Click "Config" for Apache
3. Select "httpd.conf"
4. Find and uncomment (remove #):
    ```
    LoadModule rewrite_module modules/mod_rewrite.so
    ```
5. Find `AllowOverride None` and change to `AllowOverride All`
6. Restart Apache

### 6. Access the Website

-   **Frontend**: http://localhost/ashoka-rescue-plain/
-   **Admin Panel**: http://localhost/ashoka-rescue-plain/admin/

**Default Admin Credentials:**

-   Email: admin@ashokarescue.com
-   Password: admin123

**⚠️ IMPORTANT: Change the admin password immediately after first login!**

## Project Structure

```
ashoka-rescue-plain/
├── index.php                    # Home page
├── about.php                    # About page
├── services.php                 # Services listing
├── service-detail.php           # Dynamic service detail page
├── contact.php                  # Contact page
├── faqs.php                     # FAQs page
├── terms.php                    # Terms & Conditions
├── privacy.php                  # Privacy Policy
├── air-ambulance-medical-escort-services-india.php
├── includes/
│   ├── config.php              # Configuration settings
│   ├── db.php                  # Database connection
│   ├── functions.php           # Helper functions
│   ├── session.php             # Session management
│   ├── header.php              # Common header
│   └── footer.php              # Common footer
├── admin/                       # Admin panel (to be completed)
├── api/                         # API endpoints (to be completed)
├── assets/
│   ├── css/                    # Stylesheets
│   ├── js/                     # JavaScript files
│   ├── images/                 # Images
│   └── uploads/                # User uploaded files
├── sql/
│   └── database.sql            # Database schema
└── .htaccess                   # URL rewriting rules
```

## Features Implemented

### ✅ Completed

-   [x] Project directory structure
-   [x] Database schema with all tables
-   [x] Configuration system
-   [x] Database connection with prepared statements
-   [x] Helper functions library
-   [x] Session management
-   [x] Common header and footer includes
-   [x] URL rewriting (.htaccess)
-   [x] All CSS/JS assets copied

### 🚧 In Progress

-   [ ] Frontend pages (Home, About, Services, Contact, etc.)
-   [ ] API endpoints for form submissions
-   [ ] Admin panel (Login, Dashboard, CRUD operations)
-   [ ] Email notification system
-   [ ] PHPMailer integration

## Next Steps

1. **Install PHPMailer** for email functionality
2. **Import database** using the provided SQL file
3. **Build frontend pages** starting with index.php
4. **Create API endpoints** for form submissions
5. **Build admin panel** for content management
6. **Test all functionality**

## Database Tables

-   `users` - Admin users
-   `service_lists` - Service listings
-   `service_contents` - Dynamic service page content
-   `testimonials` - Customer testimonials
-   `our_stories` - Company stories/achievements
-   `home_quotes` - Quote requests from home page
-   `home_footer_quotes` - Footer quote requests
-   `contact_quotes` - Contact form submissions

## Security Features

-   SQL injection prevention (prepared statements)
-   XSS protection (htmlspecialchars)
-   CSRF token validation
-   Session security
-   File upload validation
-   Password hashing (bcrypt)
-   Secure file permissions

## Support

For issues or questions, please refer to the implementation plan document.

## License

© 2024 Ashoka Rescue Air Ambulance Services Pvt. Ltd.
