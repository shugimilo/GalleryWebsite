<?php
include "includes/autoloader.inc.php";
include "includes/config.inc.php";
$profile = new ProfileContr($_SESSION["username"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link rel="icon" type="image/x-icon" href="images/utility/bayonet.ico">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/modaltest.css" rel="stylesheet">
    <link href="css/customfonts.css" rel="stylesheet">
    <link href="fontawesome/fontawesome-free-6.5.1-web/css/all.css" rel="stylesheet">
    <link href="css/starrating.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h2 class="gallery_title">SETTINGS</h2>
    <header>
    <?php
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
    ?>
    </header>
    <div style="display: flex; justify-content: center; margin-top: 25px;">
        <div>
            <form action="settings.php" method="post" enctype="multipart/form-data">
                <label>Profile Picture:</label><br>
                <input style="margin-right: 20px;" type="file" name="profilepicture"><br>
                <hr>
                <label>Profile Background:</label><br>
                <input style="margin-right: 20px;" type="file" name="profilebackground"><br>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <button title="Upload a profile picture and background before saving" class="button-55" type="submit" name="save">save</button>
                    <button class="button-55" type="submit" name="cancel">cancel</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if(isset($_POST["save"])){
        if(!($_FILES['profilepicture']['size'] == 0)){
            $custom_util = new Utility();
            $id = $profile->getUserID();
            $custom_contr = new CustomizationContr($id);
            $custom_contr->uploadProfilePicture($_FILES['profilepicture']);
        }
        if(!($_FILES['profilebackground']['size'] == 0)){
            $custom_util = new Utility();
            $id = $profile->getUserID();
            $custom_contr = new CustomizationContr($id);
            $custom_contr->uploadBackgroundImage($_FILES['profilebackground']);
        }
        header("Location: profile.php");
    }
    ?>
    <?php
    if(isset($_POST["cancel"])){
        header("Location: profile.php");
    }
    ?>
    <div>
        <div>
            <div style="display: flex; justify-content: center;">
                    <?php
                    $profile->createDeleteModal();
                    $profile->displayDeleteModal();
                    ?>
                </div>
        </div>
    </div>
    <script src="javascript/responsive_functions.js"></script>
</body>
</html>