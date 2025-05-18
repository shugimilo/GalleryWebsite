<?php
require_once "includes/config.inc.php";
require "includes/autoloader.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up/Log in</title>
    <link rel="icon" type="image/x-icon" href="images/utility/bayonet.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/modaltest.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/customfonts.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        .disabled-preview {
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="sec" id="profilepicture">
    <section>
        <h2 class="title" style="margin-top: 15px;">Customize</h2>
        <hr>
        <form id="profileForm" action="customizeprofile.php" method="post" enctype="multipart/form-data">
            <label>Profile Picture:</label><br>
            <input style="margin-right: 20px;" type="file" name="profilepicture" required><br>
            <hr>
            <label>Profile Background:</label><br>
            <input style="margin-right: 20px;" type="file" name="profilebackground" required><br>
            <hr>
            <button title="Upload a profile picture and background before preview" id="previewButton" class="button-55" type="submit" name="preview" value="Preview profile" disabled>preview profile</button><br>
        </form>
        <form action="customizeprofile.php" method="post">
            <button class="button-55" type="submit" name="skip" value="Skip">skip</button><br>
        </form>
        <?php
        if(isset($_POST["preview"])){
            if((isset($_FILES['profilepicture'])) && isset($_FILES['profilebackground'])) {
                $custom_util = new Utility();
                $id = $custom_util->getNextAvailableUserID();
                $custom_contr = new CustomizationContr($id);
                $custom_contr->createProfilePreview();
                $custom_contr->uploadProfilePicture($_FILES['profilepicture']);
                $custom_contr->uploadBackgroundImage($_FILES['profilebackground']);
                $custom_contr->displayProfilePreview($_SESSION["preview_username"], $_SESSION["preview_fullname"], $_SESSION["preview_email"], $_SESSION["preview_dob"]);
            } else {
                echo "No file uploaded.";
            }
        }
        ?>
        <?php
        if(isset($_POST["skip"])){
            $custom_util = new Utility();
            $id = $custom_util->getNextAvailableUserID();
            $pp_default = "images/utility/pp_default.jpg";
            $pb_default = "images/utility/pb_default.jpg";
            $pp_destination = "images/profilepictures/";
            $pb_destination = "images/profilebackgrounds/";
            $pp_filename = $id.".jpg";
            $pb_filename = $id.".jpg";
            copy($pp_default, $pp_destination.$pp_filename);
            copy($pb_default, $pb_destination.$pb_filename);
            header("Location: success.php");
        } elseif(isset($_POST["signup"])){
            header("Location: success.php");
        }
        ?>
    </section>
    </div>
    <script src="javascript/preview_control.js"></script>
</body>
</html>