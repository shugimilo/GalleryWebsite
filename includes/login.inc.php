<?php
require_once "config.inc.php";
if(isset($_POST["login"])){
    require "autoloader.inc.php";
    $username = trim($_POST["username"]);
    $pwd = trim($_POST["password"]);
    try{
        $login = new LoginContr($username, $pwd);
        $login->tryToLogIn();
    } catch(PDOException $e) {
        echo "Login failed: ".$e->getMessage();
    }
}