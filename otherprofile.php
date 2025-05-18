<?php
include "includes/autoloader.inc.php";
include "includes/config.inc.php";
$utility = new Utility();
$username = $utility->getUserName($_POST["otherprofile"]);
$profile = new ProfileContr($username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username;?>'s Profile</title>
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
    <h2 class="gallery_title"><?php echo strtoupper($username); ?>'S PROFILE</h2>
    <header>
    <?php
    if(isset($_SESSION["user_type"])){
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
    </header>
    <div class="profile_preview" style="height: 210px; max-width: 100%; display: flex; align-items: center; background-image: url(images/profilebackgrounds/<?php echo $profile->getUserID(); ?>.jpg); background-size: cover; background-position: center;">
        <div class="picture">
            <img class="largeprofilepic" style="width: 200px; height: 200px; border-radius: 50%; border: 5px solid black; margin: 5px;" src="images/profilepictures/<?php echo $profile->getUserID(); ?>.jpg">
        </div>
        <div class="info" style="padding-top: 35px;">
            <p style="background-color: black;"><span class="fadedtext">Username: </span><?php $profile->displayUsername()?></p>
            <p style="background-color: black;"><span class="fadedtext">Full name: </span><?php $profile->displayFullName()?></p>
            <p style="background-color: black;"><span class="fadedtext">Email: </span><?php $profile->displayEmail()?></p>
            <p style="background-color: black;"><span class="fadedtext">Date of Birth: </span><?php $profile->displayDoB()?></p>
            <p style="background-color: black;"><span class="fadedtext">Date joined: </span><?php $profile->displayCreatedAt()?></p>
        </div>
    </div>
    <div class="gallery">
        <?php
        $image_control = new ImageContr();
        $images_fetched = $image_control->getAllUserImages($profile->getUserID());
        $modals = array();
        foreach ($images_fetched as $image_fetched) {
            $modal = new ModalContr($image_fetched);
            $modals[] = $modal;
        }
        foreach($modals as $modal){
            $modal->createModalButton();
        }
        foreach($modals as $modal){
            $modal->displayModal();
        }
        ?>
    </div>
    <script src="javascript/like.js"></script>
</body>
</html>