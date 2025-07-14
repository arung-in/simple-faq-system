# Simple FAQ System

**PHP Technical Aptitude Test**

---

## System Requirements


- PHP **8.2.12** or above
- MariaDB **10.4.32**
- Composer **2.8.5**  
---

## Installing XAMPP on Windows
Follow these steps to install and set up XAMPP for running the project locally:

1. **Download XAMPP**
   - Visit the official website:  
     [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)
   - Choose the version compatible with your PHP requirements (e.g., PHP 8.2).

2. **Run the Installer**
   - Double-click the downloaded `.exe` file.
   - Allow permissions and proceed with the installation wizard.
   - Select components (ensure **Apache** and **MySQL** are checked).
   - Choose the install path (default: `C:\xampp`).

3. **Launch XAMPP Control Panel**
   - After installation, open the **XAMPP Control Panel**.
   - Click **Start** next to **Apache** and **MySQL** to start the services.

4. **Verify Installation**
   - Open your browser and go to:  
     `http://localhost`
   - You should see the XAMPP dashboard.

5. **Access phpMyAdmin**
   - Visit:  
     `http://localhost/phpmyadmin`
   - Use it to import databases (.../database/test_db/simple_faq_system.sql)


## Installing Composer on Windows

1. **Download Composer Installer**  
   Visit: [https://getcomposer.org/download/](https://getcomposer.org/download/)  
   Download `Composer-Setup.exe` for Windows.

2. **Run the Installer**  
   - Follow the installation wizard.  
   - Select the path to your `php.exe` (e.g., `C:\xampp\php\php.exe`).  
   - Complete the installation.

3. **Verify Installation**  
   Open Command Prompt and run:  
   ```bash
   composer --version


## How to Run the Project Locally

1. **Install Composer dependencies - Go to the project folder**
   ```bash
   cd ./simple-faq-system
   composer install

2. **Before running the project, make sure to update your database credentials.**
    1. Open the configuration file located at:
    simple-faq-system/database/config.php

    2. Update the following values with your local MySQL credentials:
    ```php
    return [
        'database' => [
            'host' => 'localhost',
            'port' => '3306',
            'name' => 'simple_faq_system', // your database name
            'username' => 'your_mysql_username',
            'password' => 'your_mysql_password',
        ],
    ];


3. **Go to the project folder and start the PHP built-in server**
    ```bash
    cd ./simple-faq-system
    php -S localhost:9000 public/index.php
    
4. **Open your browser and visit:**
    ```bash
    http://localhost:9000



## Core Structure

### Http Layer

- **Kernel.php**  
  Routes requests using FastRoute, applies middleware (e.g., CSRF), and dispatches to controllers.

- **Request.php**  
  Handles HTTP request methods, URI, and input data.

- **Response.php**  
  Manages HTTP responses (status codes, JSON/HTML output).

- **Middleware (CSRF Protection)**  
  Validates CSRF tokens before executing the controller.

---

### Controllers

- **FaqController.php**
  - `index()`  
    Renders the FAQ list view as HTML.
  - `faqLike()`  
    Handles API-like POST requests, returns JSON responses, and validates `faqId`.

---

### Services

- **CsrfService.php**  
  Generates and validates CSRF tokens, stored in the session.

---

### Routes

Defined in `web.php`:

```php
['GET', '/', [FaqController::class, 'index']],
['POST', '/faqs-api/like/{faqId:\d+}', [FaqController::class, 'faqLike']]


## Why This Structure?

This structure is very useful — it makes your app **modular**, **clean**, and **easy to grow**.  
I'm building lightweight PHP MVC framework from the ground up—a fantastic way to deeply understand core architecture principles. This isn't just an FAQ app; it's a modular app.


### Benefits of This Structure:

- Clear separation of concerns (routing, logic, response)
- Reusable logic (e.g., CSRF service)
- Easier to maintain and test
- Scalable design ready for future enhancements
- Aligned with the principles used in full frameworks like Laravel or Symfony

---