<?php

require_once "config.inc.php";
require_once "autoloader.inc.php";

if(isset($_POST["upload"])){
    $file_name = $_POST["file_name"];
    $title = $_POST["title"];
    $file_description = $_POST["file_description"];
    if(!(isset($_SESSION["user_id"]))){
        $util = new Utility();
        $user_id = $util->getUserID($_SESSION["username"]);
    } else {
        $user_id = $_SESSION["user_id"];
    }

    $upload = new UploadContr($file_name, $title, $file_description, $user_id);

    $upload->upload();
}