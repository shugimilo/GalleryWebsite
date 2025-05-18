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
            <h2 class="title">Password Recovery</h2>
            <form action="" method="post">
                <h2>Enter the 6-digit code we've sent to your address.</h2>
                <input class="custom_input" type="text" name="code"><br>
                <button class="button-55" type="submit" name="check" value="1">Check</button><br>
            </form>
        </section>
    </div>
    <?php
    if(isset($_POST["check"])){
        if($_POST["code"] == $_SESSION["code"]){
            header("Location: newpassword.php");
        } else {
            echo '<div class="sec">
                <section>
                    <h2 class="title">Wrong code!</h2>
                </section>
            </div>';
        }
    }
    ?>
</body>
</html>