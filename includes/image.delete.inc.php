<?php
require_once "autoloader.inc.php";
require_once "config.inc.php";
if(isset($_POST["yes"])){
    $image_id = $_POST["yes"];
    $image_contr = new ImageContr();
    $image_fetched = $image_contr->getImageByID($image_id);
    $image = new ImageContr();
    $image->setParams($image_fetched);

    $image->delete();

    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        header("Location: ../gallery.php");
    }
} elseif(isset($_POST["no"])) {
    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        header("Location: ../gallery.php");
    }
}