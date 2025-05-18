<?php
require_once "config.inc.php";
if(isset($_POST["continue"])){
   require "autoloader.inc.php";
   $first_name = trim($_POST["first_name"]);
   $last_name = trim($_POST["last_name"]);
   $username = trim($_POST["username"]);
   $pwd = trim($_POST["password"]);
   $pwd_repeat = trim($_POST["password_repeat"]);
   $email = trim($_POST["email"]);
   $date_of_birth = $_POST["date_of_birth"];
   $_SESSION["preview_username"] = $username;
   $_SESSION["preview_fullname"] = $first_name." ".$last_name;
   $_SESSION["preview_email"] = $email;
   $_SESSION["preview_dob"] = $date_of_birth;
   if(isset($_POST["user_type"])){
      $user_type = $_POST["user_type"];
   } else {
      $user_type = "";
   }
   try{
      $signup = new SignupContr($first_name, $last_name, $username, $pwd, $pwd_repeat, $email, $date_of_birth, $user_type);
      $signup->tryToSignUp();
   } catch(PDOException $e) {
      echo "Sign in failed: ".$e->getMessage();
   }
}