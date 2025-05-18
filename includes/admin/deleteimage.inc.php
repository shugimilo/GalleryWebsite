<?php
require_once "../config.inc.php";
require_once "../autoloader.inc.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["delete"])){
        $image_contr = new ImageContr();
        $image_contr->setImageID($_POST["delete"]);
        $image_contr->delete();
        header("Location: ../../admin.php");
    }
}