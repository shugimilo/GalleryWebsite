<?php

require_once "config.inc.php";
require_once "autoloader.inc.php";
require "../mailer/mailerscript.php";
$errors = array();

if(isset($_POST["pwdreset"])){
    if(isset($_POST["username"])){
        $username = $_POST["username"];
        $util = new Utility();
        if(empty($util->getUserID($username))){
            $errors[] = "Username doesn't exist.";
            $_SESSION["errors"] = $errors;
            header("Location: ../errors/login.error.php");
            die();
        }
        $profile_contr = new ProfileContr($username);
        $mailto = $profile_contr->getUserEmail();
    } else {
        $errors[] = "Do not leave the input field empty.";
        $_SESSION["errors"] = $errors;
        header("Location: ../errors/login.error.php");
        die();
    }
    $_SESSION["mailto"] = $mailto;
    $subject = "Password Recovery";
    $code = rand() % 1000000;
    if($code / 100000 < 1){
        $code = $code * 10 + rand(0, 9);
    }
    $_SESSION["code"] = $code;
    $message = "Your 6-digit code for password recovery is: ".$code.".";
    $response = sendMail($mailto, $subject, $message);
    header("Location: ../entercode.php");
}