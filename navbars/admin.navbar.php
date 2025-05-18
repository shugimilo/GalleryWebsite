<nav class="my_navbar">
    <ul>
        <li>
            <button class="button-54" role="button" onclick="window.location.href = 'gallery.php';">
                <b>gallery</b>
            </button>
        </li>
        <li>
            <div>
                <button class="button-54" role="button" onclick="window.location.href = 'contact.php';">
                    <b>contact</b>
                </button>
            </div>
        </li>
        <li>
            <div>
                <button class="button-54" role="button" onclick="window.location.href = 'about.php';">
                    <b>about</b>
                </button>
            </div>
        </li>
        <li>
            <div>
                <button class="button-54" role="button" onclick="window.location.href = 'gallery.php#upload';">
                    <img style="height: 24px; width: 24px;" src="images/utility/search.png">
                    <b>search</b>
                </button>
            </div>
        </li>
        <li>
            <div>
                <form action="admin.php" method="post">
                    <button class="button-54" role="button" type="submit" name="admin">
                        <b>admin page</b>
                    </button>
                </form>
            </div>
        </li>
        <div class="dropDiv">
            <li class="dropdown">
                <a href="profile.php" class="profile-link">
                    <img class="profilepic" src="images/profilepictures/<?php echo $_SESSION["user_id"];?>.jpg">
                    <span class="my_navbar_username"  style="vertical-align: middle; align-self: center;"><?php echo strtoupper($_SESSION["username"]);?></span>
                </a>
            </li>
                <div class="dropdownContent">
                    <li><button class="button-54" role="button" onclick="window.location.href = 'settings.php';"><b>settings</b></button></li>
                    <li><?php
                    $utility = new Utility();
                    $utility->logOutButton();
                    ?></li>
                </div>
        </div>
    </ul>
</nav>