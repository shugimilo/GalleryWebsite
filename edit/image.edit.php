<?php
include "../includes/autoloader.inc.php";
include "../includes/config.inc.php";
if((isset($_POST["edit_image"])) && (isset($_SESSION["username"]))){
    $image_id = $_POST["edit_image"];
    $_SESSION["image_id"] = $image_id;
    if(!(isset($_SESSION["user_type"]))){
        $util = new Utility();
        $_SESSION["user_type"] = $util->getUserType($_SESSION["username"]); 
    }
    if($_SESSION["user_type"] == UserType::USER){
        header("Location: ../profile.php");
        exit();
    }
    $image_control = new ImageContr();
    $image_fetched = $image_control->getImageByID($image_id);
    $image = new ImageContr();
    $image->setParams($image_fetched);
} else {
    header("Location: ../profile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing "<?php echo $image->getTitle()?>"</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <div>
        <div>
        <?php
        $image->displayImage("project/edit/");
        ?>
        </div>
        <div>
            <form action="../includes/image.edit.inc.php" method="post">
                <div class="inputfield">
                    <label for="new_title">New title: </label>
                    <input type="text" name="new_title" placeholder="<?php echo $image->getTitle(); ?>"><br>
                </div>
                <div class="inputfield">
                    <label for="new_description">New description: </label>
                    <input type="text" name="new_description" placeholder="<?php echo $image->getDescription(); ?>">
                </div>
                <div class="inputfield">
                    <label for="new_visibility">Visibility: </label>
                    <label for="new_visibility">Public </label>
                    <input type="radio" name="new_visibility" value="public">
                    <label for="new_visibility">Private</label>
                    <input type="radio" name="new_visibility" value="private">
                </div>
                <input type="submit" name="confirm" value="Confirm">
            </form>
        </div>
    </div>
</body>
</html>