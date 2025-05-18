# Gallery Website  
Third-year project for the **Web Application Programming** course.

## Project Overview

This website serves as a digital gallery where users can explore, rate, like, and comment on images uploaded by artists. It supports multiple user types, each with distinct permissions and capabilities.

Users can explore the gallery anonymously by clicking the **“Incognito”** button on the signup/login page.

During account creation, users can choose to register as either a **regular user** or an **artist**. Only artists have the ability to upload images. All logged-in users can interact with public images, while only artists can manage the privacy settings of their own images.

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

### Architectural Approach: Model-Object-View (MOV)
The project follows a **Model-Object-View** (MOV) design, loosely inspired by MVC. It separates responsibilities as follows:
- **Model classes** represent database entities such as users, images, comments, likes, ratings, and views. They contain protected methods for creating, reading, updating, and deleting records via **PDO**.
- **Control classes** (e.g. `commentcontr.class.php`) extend the base models and implement public methods to interact with the front end. These combine logic and inline HTML to render forms, fetch data, and perform redirects.
- This structure keeps database logic isolated while making it easy to extend and modify interactions at the UI level.

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
