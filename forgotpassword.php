<?php
require_once "includes/config.inc.php";
require "includes/autoloader.inc.php";
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/modaltest.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/customfonts.css" rel="stylesheet">
</head>
<body>
    <div class="sec">
        <section>
            <h2 class="title">forgotten password?</h2>
            <form action="includes/forgotpassword.inc.php" method="post">
                <p>We will try our best to help you log in again. In order to recover a password or set a new one, please provide us your username.</p>
                <label class="custom_label" for="username">Username: </label><br>
                <input class="custom_input" type="text" name="username"><br>
                <button class="button-55" type="submit" name="pwdreset" value="1">Continue</button><br>
            </form>
        </section>
    </div>
</body>
</html>