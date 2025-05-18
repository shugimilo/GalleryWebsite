<?php
require_once "../config.inc.php";
require_once "../autoloader.inc.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["promote"])){
        $user_contr = new UserContr();
        $user_contr->setParams($_POST["promote"]);
        $user_contr->promote();
        header("Location: ../../admin.php");
    }
}