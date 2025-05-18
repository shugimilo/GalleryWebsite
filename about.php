<?php
include "includes/autoloader.inc.php";
include "includes/config.inc.php";
if(isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"] === 1)){
    if(!(isset($_SESSION["user_id"]))){
        $util = new Utility();
        $_SESSION["user_id"] = $util->getUserID($_SESSION["username"]);
    }
    if(!(isset($_SESSION["user_type"]))){
        $util = new Utility();
        $_SESSION["user_type"] = $util->getUserType($_SESSION["username"]);
    }
} else {
    $logged_out = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Page</title>
    <link rel="icon" type="image/x-icon" href="images/utility/bayonet.ico">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/modaltest.css" rel="stylesheet">
    <link href="css/customfonts.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h2 class="gallery_title">"ABOUT</h2>
    <?php
    if(isset($_SESSION["username"])){
        switch($_SESSION["user_type"]){
            case UserType::USER:
                include "navbars/user.navbar.php";
                break;
            case UserType::ARTIST:
                include "navbars/artist.navbar.php";
                break;
            case UserType::ADMIN:
                include "navbars/admin.navbar.php";
                break;
        }
    } else {
        include "navbars/anonymous.navbar.php";
    }
    ?>
    <div>
        <div>
            <p>
                <i>
                This website was created as a project within the course of Web Application Programming, third year of studies.<br>
                </i>
                <b> 
                Author: Petar Milojevic [629-2020]<br>
                University: University of Kragujevac<br>
                Institution: Faculty of Engineering Sciences<br>
                </b>
            </p>
        </div>
    </div>
    <script src="javascript/responsive_functions.js"></script>
</body>
</html>