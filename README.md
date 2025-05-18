# Gallery Website  
Third-year project for the **Web Application Programming** course.

## Project Overview

This website serves as a digital gallery where users can explore, rate, like, and comment on images uploaded by artists. It supports multiple user types, each with distinct permissions and capabilities.

Users can explore the gallery anonymously by clicking the **“Incognito”** button on the signup/login page.

During account creation, users can choose to register as either a **regular user** or an **artist**. Only artists have the ability to upload images. All logged-in users can interact with public images, while only artists can manage the privacy settings of their own images.

## Running the Website Locally

This project is built to run using **XAMPP** and **localhost**. Follow the steps below to try it out on your machine:

### 1. Download and Set Up the Project
- Download or clone the repository.
- Move the entire project folder into your XAMPP `htdocs` directory: /xampp/htdocs/your_project_folder/

### 2. Start XAMPP
- Open the **XAMPP Control Panel**.
- Start **Apache**.
- Start **MySQL** (if your project uses a database).

### 3. Set Up the Database
- Open **phpMyAdmin** by visiting: http://localhost/phpmyadmin
- Create a new database (e.g., `my_project_db`).
- Import the SQL file provided with the project:
  1. Click on the newly created database.
  2. Go to the **Import** tab.
  3. Upload and run the `.sql` file (usually found in the root or `database/` folder of the project).

**Note:** Ensure that the database connection details in your configuration file (e.g., `Database.php` or `config.inc.php`) match the name and credentials of the database you just created.

### 4. Open the Website
- In your web browser, go to: http://localhost/your_project_folder/

---

## User Types

### 1. Anonymous Browsing
- Accessible via the **"Incognito"** button on the login/signup page.
- Can view public images uploaded by artists.
- Cannot like, rate, or comment on images.
- Can see other users’ comments, but not the public statistics of images.

### 2. Regular Users
- Can fully interact with all public images (like, rate, comment, view stats).
- Can customize their profiles with profile and background images.
- Cannot upload their own images.

### 3. Artists
- Have all the capabilities of regular users.
- Can upload images and provide:
  - A title
  - A description
  - An internal file name
  - A privacy setting (public or private)
- Private images are visible only to the uploading artist.
- Artists can change the privacy setting of an image at any time.
- Can track view counts on their own images, in addition to public stats.

### 4. Administrators
- Cannot be selected during signup—admin privileges are granted by directly modifying the user’s database entry.
- Have all user and artist privileges, plus:
  - Access to an **admin panel**.
  - Ability to view and manage all users, images, and comments.
  - Promote regular users to artists.
  - Delete any user, image, or comment deemed inappropriate or offensive.

---

## Implementation Notes

### Dynamic UI Updates
The interface updates dynamically to reflect user interactions without requiring a full page reload.  
- **Likes, ratings, and views** are updated in real-time using JavaScript.  
- Artists can toggle an image’s privacy status by clicking a **lock icon**, which visually reflects the image’s current state (locked = private, unlocked = public).

### Error Handling
User actions are validated to prevent and handle errors gracefully:
- Submitting incomplete forms (e.g., during signup or login) redirects users to an error page that highlights incorrect or missing fields with tips on how to fix them.
- Submitting an empty comment triggers a similar error message.
- Uploading a non-`.jpeg` or `.png` file as a profile or background image will display an error, as only these formats are supported.
- Local storage limits are enforced for uploaded images.

### Architectural Approach: Model-View-Control (MVC)
The project follows a simplified version of the Model-View-Control approach. It separates responsibilities as follows:
- **Model classes** represent database entities such as users, images, comments, likes, ratings, and views. They contain protected methods for creating, reading, updating, and deleting records via **PDO**.
- **Control classes** (e.g. `commentcontr.class.php`) extend the base models and implement public methods to interact with the front end. These combine logic and inline HTML to render forms, fetch data, and perform redirects.
- This structure keeps database logic isolated while making it easy to extend and modify interactions at the UI level.

### Bootstrap Usage
When a user clicks on an image in order to view it, a bootstrap popup appears, dynamically displaying the image, along with:
- Owner's information, title, description, date posted, number of likes, average ratings and comments.
- The user (if eligible) can add/remove their like, change their rating and post a new comment.
- Comments are interactable - if the commenter's profile picture is clicked, the user is led to their profile.
- Comments also contain information about the poster's username and date created.

### PHPMailer Implementation
The website has a password recovery feature. If the "I forgot my password" button is clicked, the user will be prompted to write their username. Afterwards, if the username exists in the database, the service will send a 6 digit code to the user's e-mail address.
Typing the correct code prompts the user to set a new password. If they repeat the password successfully, the new one is hashed in the database and the user can proceed to the login page.
This feature has been implemented through PHPMailer. Instructions on how to set it up in a new project can be found in [this video](https://www.youtube.com/watch?v=GmCFeLhA-fA).

---

## Demonstration

![Demo 1](https://i.imgur.com/lPTu8Wm.gif)

![Demo 2](https://i.imgur.com/BOKaSa4.gif)

![Demo 3](https://i.imgur.com/O0LRnJr.gif)

![Demo 4](https://i.imgur.com/V0XWKTC.gif)

![Demo 5](https://i.imgur.com/ly6nw3E.gif)

![Demo 6](https://i.imgur.com/gK6c72C.gif)

![Demo 7](https://i.imgur.com/peiKAGf.gif)

![Demo 8](https://i.imgur.com/LX5DhVx.gif)

---

## Security

This application implements several essential security practices to protect user data and maintain safe sessions:

### Session Hardening

Session management is configured with enhanced security settings:

- **Cookies only**: Sessions are restricted to cookies only (`session.use_only_cookies`).
- **Strict mode**: Prevents uninitialized session IDs from being accepted (`session.use_strict_mode`).
- **Secure cookie attributes**: 
  - `secure: true` ensures cookies are only sent over HTTPS.
  - `httponly: true` prevents JavaScript access to session cookies.
- **Short lifetime**: Session cookies expire after 30 minutes of inactivity.
- **Session ID regeneration**: The session ID is regenerated every 30 minutes to mitigate session fixation attacks.

These settings are all configured in `config.inc.php`.

---

### Password Hashing

Passwords are never stored in plaintext. During sign-up:

- User passwords are securely hashed using `password_hash()` with PHP's default algorithm (currently bcrypt).
- Hashes are stored in the database rather than the original passwords.

This is handled in the `Signup` class (specifically in the `signUp()` method).

---

### Login Security

- During login, credentials are validated using prepared SQL statements to prevent SQL injection.
- The `LoginContr` uses `password_verify()` to compare the user’s input against the stored hashed password.

---

### SQL Injection Protection

- All SQL queries are written using **prepared statements** with bound parameters (`bindValue()`), preventing SQL injection across both login and signup logic.

---

These measures collectively ensure a strong baseline of security for handling user authentication and session management.

---

## Technologies Used

### Back End
- **PHP** – Server-side logic, session handling, and communication with the database.
- **MySQL** – Structured data storage, accessed using PDO.

### Front End
- **HTML**, **CSS**, **JavaScript**
- **Bootstrap** – For responsive and mobile-friendly design.

---

## Features Implemented in PHP
- User authentication and session management.
- Secure CRUD operations using PDO.
- Form validation and error feedback.
- Basic protection against SQL injection and XSS attacks.
- Image and file uploads with format restrictions.
- Password reset via email integration.
- Template-based modular structure for reusability.

---
