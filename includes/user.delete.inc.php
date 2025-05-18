<?php
require_once "autoloader.inc.php";
require_once "config.inc.php";
if(isset($_POST["yes"])){
    $user_id = $_POST["yes"];
    $user_contr = new UserContr();
    $user_contr->setParams($_POST["yes"]);
    $user_contr->deleteUser();
    $_SESSION = array();
    session_unset();
    session_destroy();
    header("Location: ../index.php#signup");
} elseif(isset($_POST["no"])) {
    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        header("Location: ../gallery.php");
    }
}