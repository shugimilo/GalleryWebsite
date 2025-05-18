<?php
require_once "autoloader.inc.php";
require_once "config.inc.php";
if(isset($_POST["confirm"])){
    $image_id = $_POST["confirm"];
    $image_contr = new ImageContr();
    $image_fetched = $image_contr->getImageByID($image_id);
    $image = new ImageContr();
    $image->setParams($image_fetched);

    $new_title = $_POST["new_title"];
    $new_description = $_POST["new_description"];
    $new_visibility = $_POST["new_visibility"];

    $image->updateImage($new_title, $new_description, $new_visibility);

    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        header("Location: ../gallery.php");
    }
}