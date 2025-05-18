<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Error</title>
    <link rel="icon" type="image/x-icon" href="../images/utility/bayonet.ico">
    <link href="../css/customfonts.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
    <link href="../css/modaltest.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
</head>
<body>
    <div class="sec">
        <section>
            <h2 class="title">Error</h2>
    <p style="font-weight: bold;">There were some errors while uploading your image...</p>
    <?php
    include "../includes/autoloader.inc.php";
    include "../includes/config.inc.php";
    $errors = $_SESSION['errors'];
    foreach ($errors as $error) {
        echo '<u>'.htmlspecialchars($error)."</u><br>";
    }
    unset($_SESSION['errors']);
    ?>
            <button class="button-55" role="button" onclick="window.location.href = '../index.php';">try again</button>
        </section>
    </div>
</body>
</html>