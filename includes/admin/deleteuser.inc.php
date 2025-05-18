<?php
require_once "../config.inc.php";
require_once "../autoloader.inc.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["delete"])){
        $user_contr = new UserContr();
        $user_contr->setParams($_POST["delete"]);
        $user_contr->deleteUser();
        header("Location: ../../admin.php");
    }
}