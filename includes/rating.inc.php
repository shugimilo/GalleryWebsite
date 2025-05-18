<?php
require_once "autoloader.inc.php";
require_once "config.inc.php";

if(isset($_POST["submit"])){
    if(empty($_POST["rate"])){
        $errors = array();
        $errors[] = "You cannot leave an empty rating!";
        $_SESSION["errors"] = $errors;
        header("Location: ../errors/rating.error.php");
        exit();
    } else {
        $rating = $_POST["rate"];
        $user_id = $_SESSION["user_id"];
        $image_id = $_POST["submit"];
        $rating_contr = new RatingContr();
        $rating_contr->setParams($user_id, $image_id, $rating);
        $rating_contr->uploadRating();
        if(isset($_SERVER['HTTP_REFERER'])) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            header("Location: ../gallery.php");
        }
    }
}