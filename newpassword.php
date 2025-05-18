<?php
require_once "includes/config.inc.php";
require "includes/autoloader.inc.php";
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
            <h2 class="title">New Password</h2>
            <form action="includes/checknewpassword.inc.php" method="post">
                <label class="custom_label">New Password: </label>
                <input class="custom_input" type="password" name="password"><br>
                <label class="custom_label">Repeat New Password: </label>
                <input class="custom_input" type="password" name="password_repeat"><br>
                <button class="button-55" type="submit" name="submit">submit</button>
            </form>
        </section>
    </div>
</body>
</html>