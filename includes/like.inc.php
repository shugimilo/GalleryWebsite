<?php

require_once "config.inc.php";
require_once "autoloader.inc.php";

if(isset($_POST['image_id'])) {
    $image_id = $_POST["image_id"];
    $user_id = $_SESSION["user_id"];
    
    $like_contr = new LikeContr();
    $like_contr->setParams($user_id, $image_id);
    $is_liked = $like_contr->checkIfUserLiked();
    if($is_liked) {
        $like_contr->unlike();
    } else {
        $like_contr->like();
    }
    $new_liked_status = !($is_liked);
    $likeCount = $like_contr->getLikes();
    
    $heartImage = ($new_liked_status) ? "images/utility/full_heart.png" : "images/utility/empty_heart.png";
    
    $response = array(
        'success' => true,
        'heartImage' => $heartImage,
        'likeCount' => $likeCount
    );
    echo json_encode($response);
} else {
    $response = array('success' => false);
    echo json_encode($response);
}