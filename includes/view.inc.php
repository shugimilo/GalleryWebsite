<?php
require_once "config.inc.php";
require_once "autoloader.inc.php";

if (isset($_POST['image_id']) && isset($_POST['user_id'])) {
    $image_id = htmlspecialchars($_POST['image_id']);
    $user_id = htmlspecialchars($_POST['user_id']);

    $viewContr = new ViewContr($image_id, $user_id);

    $viewContr->compareAndIncrement();

    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => 'Image ID or User ID is missing.'));
}