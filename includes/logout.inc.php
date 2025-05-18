<?php

require_once "autoloader.inc.php";
require_once "config.inc.php";

if(isset($_POST["logout"])){
    $_SESSION = array();
    session_destroy();
    header("Location: ../index.php");
}