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
    <title><?php echo $_SESSION["username"];?>'s Profile</title>
    <link rel="icon" type="image/x-icon" href="images/utility/bayonet.ico">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/modaltest.css" rel="stylesheet">
    <link href="css/customfonts.css" rel="stylesheet">
    <link href="css/starrating.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h2 class="gallery_title">YOUR PROFILE</h2>
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
    <div class="profile_preview" style="height: 210px; max-width: 100%; display: flex; align-items: center; background-image: url(images/profilebackgrounds/<?php echo $profile->getUserID(); ?>.jpg); background-size: cover; background-position: center;">
        <div class="picture">
            <img class="largeprofilepic" style="width: 200px; height: 200px; border-radius: 50%; border: 5px solid black; margin: 5px;" src="images/profilepictures/<?php echo $_SESSION["user_id"]; ?>.jpg">
        </div>
        <div class="info" style="padding-top: 35px;">
            <p style="background-color: black;"><span class="fadedtext">Username: </span><?php $profile->displayUsername()?></p>
            <p style="background-color: black;"><span class="fadedtext">Full name: </span><?php $profile->displayFullName()?></p>
            <p style="background-color: black;"><span class="fadedtext">Email: </span><?php $profile->displayEmail()?></p>
            <p style="background-color: black;"><span class="fadedtext">Date of Birth: </span><?php $profile->displayDoB()?></p>
            <p style="background-color: black;"><span class="fadedtext">Date joined: </span><?php $profile->displayCreatedAt()?></p>
        </div>
    </div>
    <div class="buttons">
        <form action="profile.php" method="post">
            <button class="button-47" type="submit" name="criteria" value="owned" id="ownedImages">your _images</button>
            <button class="button-47" type="submit" name="criteria" value="liked" id="likedImages">liked _images</button>
        </form>
    </div>
    <div class="gallery">
        <?php
        if(isset($_POST["criteria"]) && ($_POST["criteria"] === "liked")){
            $like_contr = new LikeContr();
            $like_contr->setUserID($profile->getUserID());
            $liked_images_ids = $like_contr->getUsersLikedImages();
            $liked_images = array();
            $image_fetcher = new Image();
            foreach($liked_images_ids as $id){
                $liked_image = $image_fetcher->getImageByID($id);
                $liked_images[] = $liked_image;
            }
            $liked_modals = array();
            foreach ($liked_images as $image) {
                $modal = new ModalContr($image);
                $liked_modals[] = $modal;
            }
            if(empty($liked_modals)){
                echo '<div style="margin-top: 50px; display: flex; justify-content: center;"><span style="font-weight: bold; font-size: 1.5em;">You have not liked an image yet.</span></div>';
            } else {
                foreach($liked_modals as $modal){
                    $modal->createModalButton();
                }
                foreach($liked_modals as $modal){
                    $modal->displayModal();
                }   
            }         
        } else {
            $image_control = new ImageContr();
            $my_images = $image_control->getAllUserImages($profile->getUserID());
            foreach ($my_images as $image) {
                $modal = new ModalContr($image);
                $my_modals[] = $modal;
            }
            if(empty($my_modals)){
                echo '<div style="margin-top: 50px; display: flex; justify-content: center;"><span style="font-weight: bold; font-size: 1.5em;">You have not uploaded anything yet.</span></div>';
            } else {
                foreach($my_modals as $modal){
                    $modal->createModalButton();
                }
                foreach($my_modals as $modal){
                    $modal->displayModal();
                }
            }
        }
        ?>
    </div>
        <?php
        if(isset($_SESSION["username"]) && ($_SESSION["user_type"] >= 2)){
            $upload_controller = new Utility();
            $upload_controller->createUploadModal();
        }
        if(isset($_SESSION["username"]) && ($_SESSION["user_type"] >= 2)){
            $upload_controller->displayUploadModal();
        }
        ?>
    <script src="javascript/responsive_functions.js"></script>
    <script src="javascript/responsive_functions.js"></script>
</body>
</html>