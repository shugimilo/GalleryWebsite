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
                <?php
                $utility = new Utility();
                $utility->logInButton();
                ?>
            </div>
        </li>
    </ul>
</nav>