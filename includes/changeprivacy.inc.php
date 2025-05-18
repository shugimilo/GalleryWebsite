<?php

require_once "config.inc.php";
require_once "autoloader.inc.php";

if(isset($_POST['image_id'])) {
    $image_id = $_POST["image_id"];

    $image_contr = new ImageContr();
    $fetched_image = $image_contr->getImageByID($image_id);
    $image = new ImageContr();
    $image->setParams($fetched_image);
    $is_public = $image->getPrivacy();
    if($is_public) {
        $image->updateVisibility("private");
    } else {
        $image->updateVisibility("public");
    }
    $new_visibility = !($is_public);
    $lockImage = ($new_visibility) ? "images/utility/unlocked.png" : "images/utility/locked.png";
    
    $response = array(
        'success' => true,
        'lockImage' => $lockImage
    );
    echo json_encode($response);
} else {
    $response = array('success' => false);
    echo json_encode($response);
}