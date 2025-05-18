# Gallery Website
Third-year project for the Web Application Programming course.

## Project Overview

This website functions as a digital gallery where users can explore, rate, like and comment on images uploaded by artists. It supports different user types, each with distinct permissions and capabilities.
The website can be browsed anonymously, by clicking the "incognito" button on the signup/login page.
Upon account creation, users can choose wether they want to be a regular user or an artist, the difference between the two being that only artists can upload images to the website.
All logged-in users can interact with all public images. Only artists can control the privacy settings of their images.

## User Types

### 1. Anonymous Browsing
- the website can be browsed anonymously, by clicking the "incognito" button on the signup/login page
- users that access the gallery in this way can only view the artists' images
- they cannot like, rate and comment on images
- they do see other people's comments, but do not see the public stats of a particular image

### 2. Regular Users
- regular users can fully interact with all public images and also view their public stats
- they can customize their profiles by choosing profile and background pictures
- they cannot post their own images

### 3. Artists
- artists possess all regular user functionalities with the addition of posting images
- when uploading an image, an artist can choose its internal file name, title, description and privacy setting
- if an image is private, only the artist who it belongs to can view it and its stats
- the privacy of an image can be changed at any point, dynamically
- apart from seeing public stats, they can also track the view count on each of their images

### 4. Administrators
- when creating their accounts, users cannot choose to be an administrator
- the only way for an account to obtain the administrator role is if its user type is modified in the database entry
- administrators have all lower-level capabilities, including image posting, with the addition of an admin panel
- through said panel, administrators can view all users, images and comments
- an admin can promote a regular user to an artist
- they can delete any account, image or comment they find offensive or inappropriate

## Implementation Notes

### Dynamic UI Updates
The website is implemented in a way that allows users to dynamically view how their interactions with images affect their stats. Likes and views are updated using JavaScript, which means that a full-page reload isn't necessary in order to display the newest changes.
The privacy setting of an image can also be changed dynamically. By clicking the lock icon, the artist toggles the status of the image between public and private. These changes are visible by looking at the lock icon, as it changes between locked and unlocked accordingly.

### Error Handling
The signup and login processes have been made user friendly, so that in case of the user trying to proceed without a fully-completed form, they will be redirected to a page displaying all the individual input fields they filled incorrectly or left empty, along with advice on how to fix said mistakes. Attempting to leave or accidentally leaving an empty comment will trigger the same effect.

## Technologies Used

### Back End
- **PHP** for handling logic, sessions, and communication with the database.
- **MySQL** for data storage and queries.

### Front End
- **HTML**, **CSS**, **JavaScript**
- **Bootstrap** for responsive design.

## Features Implemented in PHP
- User authentication and session management.
- Database CRUD operations via PDO.
- Form handling and input validation.
- Basic security against SQL injection and XSS.
- Image/file uploads and server-side storage.
- Email integration for password reset.
- Modular structure using PHP templates.

---

