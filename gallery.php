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
    <title>Gallery</title>
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
    <h2 class="gallery_title">"GALLERY#</h2>
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
    <?php
    if (isset($_POST['logout'])) {
        $_SESSION = array();
        session_destroy();
        header("Location: gallery.php");
        exit();
    }
    if(isset($_POST["login"])){
        header("Location: index.php");
        exit();
    }
    ?>
    <div class="buttons">
        <form action="gallery.php" method="post">
            <button class="button-47" type="submit" name="criteria" value="like" id="sortByLikeBtn">most lov=ed$</button>
            <button class="button-47" type="submit" name="criteria" value="date" id="sortByDateBtn">most rec_ent"</button>
        </form>
    </div>
    <div class="gallery">
        <?php
        $image_control = new ImageContr();
        $images_fetched = $image_control->getAllImages();
        $modals = array();
        foreach ($images_fetched as $image_fetched) {
            $modal = new ModalContr($image_fetched);
            $modals[] = $modal;
        }
        ?>
        <?php
        if(isset($_POST["criteria"]) && ($_POST["criteria"] === "date")){
            function sortModalsByDate($modal1, $modal2) {
                return strtotime($modal2->getDate()) - strtotime($modal1->getDate()); 
            }
        
            usort($modals, 'sortModalsByDate');

            foreach($modals as $modal){
                $modal->createModalButton();
            }
            foreach ($modals as $modal) {
                $modal->displayModal();
            }
        } else {
            function sortModalsByLikes($modal1, $modal2) {
                return $modal2->getLikes() - $modal1->getLikes();
            }
        
            usort($modals, 'sortModalsByLikes');
        
            foreach($modals as $modal){
                $modal->createModalButton();
            }
            foreach ($modals as $modal) {
                $modal->displayModal();
            }
        }
        ?>
        <?php
        if(isset($_SESSION["username"]) && ($_SESSION["user_type"] >= 2)){
            $upload_controller = new Utility();
            $upload_controller->createUploadModal();
        }
        if(isset($_SESSION["username"]) && ($_SESSION["user_type"] >= 2)){
            $upload_controller->displayUploadModal();
        }
        ?>
    </div>
    <script src="javascript/responsive_functions.js"></script>
</body>
</html>