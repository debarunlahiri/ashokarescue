# Quick Setup Guide - Ashoka Rescue Plain PHP

## 🚀 5-Minute Setup

### Step 1: Import Database (2 minutes)

1. Open phpMyAdmin: http://localhost:8080/phpmyadmin
2. Click "New" to create a database
3. Database name: `ashoka_rescue`
4. Click "Create"
5. Select the `ashoka_rescue` database
6. Click "Import" tab
7. Choose file: `sql/database.sql`
8. Click "Go"

✅ Database imported with sample data!

### Step 2: Verify Configuration (30 seconds)

Open `includes/config.php` and verify:

```php
define('DB_NAME', 'ashoka_rescue');  // ✓ Matches database name
define('SITE_URL', 'http://localhost:8080/ashoka-rescue/ashoka-rescue-plain');
```

### Step 3: Access Website (10 seconds)

-   **Frontend**: http://localhost:8080/ashoka-rescue/ashoka-rescue-plain/
-   **Admin Panel**: http://localhost:8080/ashoka-rescue/ashoka-rescue-plain/admin/login.php

### Step 4: Login to Admin (10 seconds)

-   **Email**: admin@ashokarescue.com
-   **Password**: admin123

---

## ✅ What's Working

### Frontend (8 Pages)

-   ✓ Home page with all sections
-   ✓ About page
-   ✓ Services listing
-   ✓ Dynamic service details
-   ✓ Contact page with map
-   ✓ FAQs
-   ✓ Terms & Conditions
-   ✓ Privacy Policy

### Forms (3 Forms)

-   ✓ Home hero quote form
-   ✓ Footer quote form
-   ✓ Contact form
-   ✓ All with AJAX submission
-   ✓ Email notifications ready

### Admin Panel

-   ✓ Secure login
-   ✓ Dashboard with statistics
-   ✓ Quotes management
-   ✓ Session management

### Features

-   ✓ Swiper.js carousels
-   ✓ AOS animations
-   ✓ Responsive design
-   ✓ Clean URLs
-   ✓ CSRF protection
-   ✓ SQL injection prevention
-   ✓ XSS protection

---

## Enable the AI transfer concierge

The concierge works in guided mode without an external AI service. To enable approved-content AI answers, provide a Gemini API key to PHP through the server environment:

```bash
export GEMINI_API_KEY="your-server-side-key"
export AI_CONCIERGE_ENABLED="true"
export GEMINI_MODEL="gemini-2.5-flash-lite"
```

Restart Apache after changing its environment. Never add the API key to PHP, JavaScript, Git, or a public `.env` file. Set `AI_CONCIERGE_ENABLED=false` to hide the assistant.

For local development, you can instead copy `includes/secrets.local.example.php` to `includes/secrets.local.php` and place the replacement key there. The local file is ignored by Git and must not be deployed or shared.

The assistant intentionally does not diagnose, assess fitness to travel, promise availability, or quote prices. Callback requests are stored with the existing contact enquiries and appear in **Admin → Quotes**.

---

## 🔧 Optional: Enable Email Notifications

To enable email sending for form submissions:

### Option 1: Install PHPMailer via Composer

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/ashoka-rescue/ashoka-rescue-plain
composer require phpmailer/phpmailer
```

### Option 2: Manual Installation

1. Download PHPMailer from: https://github.com/PHPMailer/PHPMailer
2. Extract to: `vendor/phpmailer/phpmailer/`

### Configure SMTP Settings

Edit `includes/config.php`:

```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('SMTP_PORT', 587);
```

---

## 🐛 Troubleshooting

### Issue: 403 Forbidden

**Solution**: Make sure `index.php` exists in the root directory

### Issue: Database Connection Error

**Solution**:

1. Check XAMPP MySQL is running
2. Verify database name in `includes/config.php`
3. Check username/password (default: root/blank)

### Issue: Images Not Loading

**Solution**:

1. Verify `assets/images/` directory exists
2. Copy all images from Laravel `public/ui/images/` to `assets/images/`

### Issue: CSS/JS Not Loading

**Solution**: Check `.htaccess` file exists and Apache mod_rewrite is enabled

### Issue: Forms Not Submitting

**Solution**:

1. Check browser console for errors
2. Verify jQuery is loaded
3. Check API endpoint paths in form JavaScript

---

## 📁 Project Structure

```
ashoka-rescue-plain/
├── admin/              # Admin panel (3 files)
├── api/                # Form endpoints (3 files)
├── assets/             # CSS, JS, images
├── includes/           # Core PHP (6 files)
├── sql/                # Database schema
├── *.php               # 8 frontend pages
├── .htaccess           # URL rewriting
└── README.md           # Full documentation
```

---

## 🎯 Next Steps

1. **Test All Pages**: Click through all menu items
2. **Test Forms**: Submit each form and check database
3. **Check Admin**: Login and view quotes
4. **Customize Content**: Update services, testimonials, stories
5. **Production Deploy**: When ready, move to live server

---

## 📞 Admin Panel Features

### Dashboard

-   View statistics (services, testimonials, stories, quotes)
-   Recent quote requests
-   Quick action buttons

### Quotes Management

-   View all quote requests
-   Filter by type (Home, Footer, Contact)
-   See submission details and dates

---

## 🔒 Security Features

✅ Prepared statements (SQL injection prevention)  
✅ CSRF tokens on all forms  
✅ XSS protection (htmlspecialchars)  
✅ Password hashing (bcrypt)  
✅ Secure session management  
✅ Input sanitization

---

## ✨ All Features Preserved

✅ Exact same design as Laravel version  
✅ All animations and transitions  
✅ All navigation menus  
✅ All form validations  
✅ All database tables  
✅ All user flows  
✅ SEO schema markup  
✅ Mobile responsive

---

**🎉 You're all set! The website is ready to use.**

For detailed documentation, see `README.md`
