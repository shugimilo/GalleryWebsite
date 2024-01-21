# Gallery-Website
Third-year of studies project, in the subject of Programming Internet Applications
<hr>
<h2>Details</h2>
<h3>Description</h3>
<p>
  The goal of this project is to create a fully-functioning website which will act as a gallery. Users should be able to interact with one another in the sense of rating images, saving them as favorites, sharing them and leaving their own opinions in the form of comments. About programming languages that should be used, PHP and MySQL are listed for the back-end, while HTML, CSS, JavaScript, JQuery and Bootstrap are the ones listed for the front-end.
</p>
<h3>User levels</h3>
<p>There should esentially be three levels of users, with different functionalities:</p>
<ul><dl>
    <li>
    <dt><h4>User</h4><dt>
    <dd>
     - Users should be able to log in/create an account;<br>
     - After logging in,  the user can browse through the gallery/view images which are posted by special user type - Artist;<br>
     - The users should be able to rate the images (on a scale of 1 to 5) as well as leave comments on images;<br>
     - The users should also have an option to share an image of their liking;<br>
    </dd>
    </li>
    <li>
    <dt><h4>Artist</h4><dt>
    <dd>
     - Artists can register and create their own artist profile;<br>
     - They can add their own pictures/images and provide descriptions and technical info for each image;<br>
     - An artist should be able to see the ratings of their images, as well as comments posted by users;<br>
     - They can also keep track of statistical data about how many views their images have and the ratings of that image;<br>
    </dd>
    </li>
  <li>
    <dt><h4>Administrator</h4><dt>
    <dd>
      - Admins have access to the administration table, from which they can control the entire platform;<br>
     - Admins can add new artists, remove inappropriate images and comments;<br>
     - Keep track of statistical data in order to get a grasp of a certain artist's or image's popularity;<br>
     - Block users that void the guidelines.<br>
    </dd>
    </li>
</dl></ul>
<hr>
<h2>Languages</h2>
<h3>PHP</h3>
<ul><dl>
    <li>
    <dt>User Authentication</dt>
    <dd>
      - PHP will handle user registration and login processes;<br>
      - It will validate user credentials against the database;<br>
    </dd>
    </li>
    <li>
    <dt>Database Interaction</dt>
    <dd>
      - PHP will be responsible for connecting to the MySQL database;<br>
      - It will execute SQL queries to insert, update, delete, and retrieve data from the database;<br>
    </dd>
    </li>
    <li>
    <dt>Dynamic Content Generation</dt>
    <dd>
      - PHP will generate dynamic content for web pages based on user input or database queries;<br>
      - It allows you to embed PHP code within HTML to create dynamic web pages;<br>
    </dd>
    </li>
    <li>
    <dt>Session Management</dt>
    <dd>
      - PHP sessions will be used to manage user sessions and store session variables;<br>
      - It helps in keeping track of user authentication status and other user-specific information;<br>
    </dd>
    </li>
    <li>
    <dt>Form Handling</dt>
    <dd>
      - PHP will process form submissions, validate input, and interact with the database to store or retrieve data;<br>
      - It can handle file uploads, form validations, and other form-related tasks;<br>
    </dd>
    </li>
    <li>
    <dt>Security</dt>
    <dd>
      - PHP will be used to implement security measures such as input validation and sanitization;<br>
      - It helps in protecting against common web vulnerabilities like SQL injection and cross-site scripting (XSS);<br>
    </dd>
    </li>
    <li>
    <dt>Server-Side File Handling</dt>
    <dd>
      - PHP can handle file operations on the server, such as uploading, deleting, and moving files;<br>
      - It enables you to manage images and other media files associated with your gallery;<br>
    </dd>
    </li>
    <li>
    <dt>Email Sending</dt>
    <dd>
      - PHP can be used to send emails, such as account verification emails or notifications;<br>
      - It interacts with the mail server to send messages programmatically;<br>
    </dd>
    </li>
    <li>
    <dt>Integration with External Services</dt>
    <dd>
      - PHP can communicate with external APIs or services to fetch or send data;<br>
      - It allows integration with third-party services for additional functionality;<br>
    </dd>
    </li>
    <li>
    <dt>Error Handling</dt>
    <dd>
      - PHP will handle errors and exceptions gracefully;<br>
      - It provides mechanisms for debugging and logging errors for maintenance;<br>
    </dd>
    </li>
    <li>
    <dt>Template Rendering</dt>
    <dd>
      - PHP can be used to include templates and create a modular structure for your web pages;<br>
      - It facilitates the separation of logic and presentation.<br>
    </dd>
    </li>
