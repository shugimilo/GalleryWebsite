<?php
require_once "config.inc.php";
require_once "autoloader.inc.php";
if(isset($_POST["submit"])){
    $password = $_POST["password"];
    $password_repeat = $_POST["password_repeat"];
    if($password == $password_repeat){
        $email = $_SESSION["mailto"];
        $user_contr = new UserContr();
        $user_id = $user_contr->fetchIDbyEmail($email);
        $user_contr->changePassword($user_id, $password);
        header("Location: ../index.php#login");
    }
}