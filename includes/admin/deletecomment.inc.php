<?php
require_once "../config.inc.php";
require_once "../autoloader.inc.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["delete"])){
        $id_string = explode('-', $_POST["delete"]);
        $comment_contr = new CommentContr();
        $comment_contr->setImageID($id_string[0]);
        $comment_contr->setUserID($id_string[1]);
        $comment_contr->delete();
        header("Location: ../../admin.php");
    }
}