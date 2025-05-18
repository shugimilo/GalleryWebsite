<?php
include "includes/autoloader.inc.php";
include "includes/config.inc.php";
if(isset($_SESSION["username"])){
    header("Location: gallery.php");
    exit();
}
$util = new Utility();
$util->createAnonymousButton();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up/Log in</title>
    <link rel="icon" type="image/x-icon" href="images/utility/bayonet.ico">
    <link href="css/customfonts.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/modaltest.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>
<body>
    <div class="sec" id="register">
    <section>
        <h2 class="title">Sign up</h2>
        <form action="includes/signup.inc.php" method="post">
            <label class="custom_label" for="first_name">First name: </label><br>
            <input class="custom_input" type="text" name="first_name" placeholder="John"><br>
            <label class="custom_label" for="last_name">Last name: </label><br>
            <input class="custom_input" type="text" name="last_name" placeholder="Doe"><br>
            <label class="custom_label" for="username">Username: </label><br>
            <input class="custom_input" type="text" name="username" placeholder="johnDoe123"><br>
            <label class="custom_label" for="password">Password: </label><br>
            <input class="custom_input" type="password" name="password" placeholder="Think of something hard!"><br>
            <label class="custom_label" for="password_repeat">Repeat password: </label><br>
            <input class="custom_input" type="password" name="password_repeat" placeholder="Repeat the same password."><br>
            <label class="custom_label" for="email">Email: </label><br>
            <input class="custom_input" type="email" name="email" placeholder="johndoe123@mail.com"><br>
            <label class="custom_label" for="date_of_birth">Date of birth: </label><br>
            <input class="custom_input" type="date" name="date_of_birth"><br>
            <label class="custom_label" for="user_type">I am going to be: </label><br>
            <label class="custom_label" for="user">a user</label>
            <input type="radio" name="user_type" value="1">
            <label class="custom_label" for="artist">an artist</label>
            <input type="radio" name="user_type" value="2"><br>
            <button class="button-55" type="submit" name="continue" value="Continue">continue</button><br>
        </form>
        <a href="#login">Already have an account? Log in instead!</a>
    </section>
    </div>
    <div class="sec" id="login">
    <section>
        <h2 class="title">Log in</h2>
        <form action="includes/login.inc.php" method="post">
            <label class="custom_label" for="username">Username: </label><br>
            <input class="custom_input" type="text" name="username"><br>
            <label class="custom_label" for="password">Password: </label><br>
            <input class="custom_input" type="password" name="password"><br>
            <button class="button-55" type="submit" name="login" value="Log me in!">log me in!</button><br>
        </form>
        <form action="forgotpassword.php" method="post">
            <button class="button-55" type="submit" name="forgotpassword" value="1">I forgot my password</button>
        </form>
        <a href="#register">Don't have an account? Create one here!</a>
    </section>
    </div>
</body>
</html>