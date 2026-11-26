Alzikrayat – Photo Sharing Application

1. Project Overview

Alzikrayat is a web-based photo-sharing application that allows users to create accounts, upload their favorite photos, browse memories shared by other users, and interact through comments.

The application provides a simple and responsive interface for sharing and preserving memories.

2. Technologies Used

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap
- Apache Server (XAMPP)

3. Main Features

- User Registration and Login.
- Secure password hashing.
- Session-based authentication.
- Dynamic navigation bar.
- Upload photos with titles and descriptions.
- Browse photos in a responsive gallery.
- View photo details and comments.
- Add comments to photos.
- Delete only photos owned by the logged-in user.
- Input validation on client and server sides.
- Protection against SQL Injection using PDO Prepared Statements.
- Protection against XSS through output escaping.

4. Project Architecture

The project follows the MVC (Model-View-Controller) design pattern and uses a three-tier architecture.

Models

Responsible for database operations:

- User.php
- Photo.php
- Comment.php

Views

Responsible for displaying the user interface:

- Authentication pages.
- Home and About pages.
- Gallery and photo details.
- Upload page.

Controllers

Handle application requests and coordinate between Models and Views:

- AuthController.php
- PhotoController.php
- CommentController.php
- HomeController.php

Core

Contains the main application components:

- Router.php
- Controller.php
- Model.php

5. Installation and Setup

1. Install XAMPP.

2. Copy the project folder into:
   "C:\xampp\htdocs\"

3. Start Apache and MySQL from the XAMPP Control Panel.

4. Open phpMyAdmin.

5. Create a database named:
   "alzikrayat_db"

6. Create the required tables: users, photos, and comments.

7. Configure the database connection in:
   "config/database.php"

8. Open the application in your browser:
   
   "http://localhost/alzikrayat/public/"

6. Database

The application uses MySQL with three main tables:

- users: Stores user account information.
- photos: Stores photo information and ownership.
- comments: Stores comments associated with photos and users.

7. Security

The application implements several security measures:

- Password hashing using "password_hash()".
- Password verification using "password_verify()".
- PDO Prepared Statements.
- Server-side input validation.
- File type verification during photo uploads.
- File size restrictions.
- Random file names for uploaded images.
- Ownership verification before deleting photos.

8. Project Structure

Alzikrayat/
│
├── config/
│   └── database.php
│
├── controllers/
│   ├── AuthController.php
│   ├── PhotoController.php
│   ├── CommentController.php
│   └── HomeController.php
│
├── core/
│   ├── Model.php
│   ├── Controller.php
│   └── Router.php
│
├── models/
│   ├── User.php
│   ├── Photo.php
│   └── Comment.php
│
├── views/
│   ├── auth/
│   ├── photos/
│   ├── layout/
│   ├── home.php
│   └── about.php
│
└── public/
    ├── css/
    ├── js/
    ├── images/
    │   └── uploads/
    ├── .htaccess
    └── index.php

9. Conclusion

Alzikrayat provides a platform for sharing photos and memories through a user-friendly interface. The project demonstrates the practical application of PHP, MySQL, MVC architecture, database management, and web security principles.
