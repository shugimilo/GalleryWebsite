<?php

require_once "config.inc.php";
require_once "autoloader.inc.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $comment_body = $_POST["comment_body"];
    $posted_by = $_SESSION["user_id"];
    $image_id = $_POST["submit"];
    $comment = new CommentContr();
    $comment->setParams($posted_by, $image_id, $comment_body);
    $comment->upload(); 
}