<?php

require_once "includes/autoloader.inc.php";
require_once "includes/config.inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link rel="icon" type="image/x-icon" href="images/utility/bayonet.ico">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/modaltest.css" rel="stylesheet">
    <link href="css/customfonts.css" rel="stylesheet">
    <link href="fontawesome/fontawesome-free-6.5.1-web/css/all.css" rel="stylesheet">
    <link href="css/starrating.css" rel="stylesheet">
    <link href="css/admintable.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h2 class="gallery_title">ADMIN PAGE</h2>
    <header>
    <?php
    switch($_SESSION["user_type"]){
        case UserType::ADMIN:
            include "navbars/admin.navbar.php";
            break;
        default:
            header("Location: gallery.php");
            break;
    }
    ?>
    </header>
    <div style="display: flex; justify-content: center; margin-top: 25px;">
        <div>
            <form action="admin.php" method="post">
                <button class="button-55" type="submit" value="users" name="fetch">users</button>
                <button class="button-55" type="submit" value="images" name="fetch">images</button>
                <button class="button-55" type="submit" value="comments" name="fetch">comments</button>
            </form>
        </div>
    </div>
    <?php
    if(isset($_POST["fetch"])){
        switch($_POST["fetch"]){
            case "users":
                $admin = new AdminTableContr();
                $user_contr = new UserContr();
                $users = $user_contr->getAll();
                $admin->openUserTable();
                $admin->generateUsersTable($users);
                $admin->closeTable();
                break;
            case "images":
                $admin = new AdminTableContr();
                $image_contr = new ImageContr();
                $images = $image_contr->getAll();
                $admin->openImageTable();
                $admin->generateImageTable($images);
                $admin->closeTable();
                break;
            case "comments":
                $admin = new AdminTableContr();
                $comment_contr = new CommentContr();
                $comments = $comment_contr->getAll();
                $admin->openCommentTable();
                $admin->generateCommentTable($comments);
                $admin->closeTable();
                break;
        }
    }
    ?>
</body>
</html>