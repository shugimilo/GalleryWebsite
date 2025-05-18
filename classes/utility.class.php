<?php

class Utility extends Database {
    public function __construct(){
        parent::__construct();
    }

    public static function logOutButton() {
        echo '<form action="includes/logout.inc.php" method="post">';
        echo '<button class="button-54" style="font-weight: bold; margin-left: 10px;" type="submit" name="logout">logout</button>';
        echo '</form>';
    }

    public static function galleryButton() {
        echo '<form action="" method="post">';
        echo '<input type="submit" name="gallery" value="Back to the Gallery">';
        echo '</form>';
    }

    public static function logInButton() {
        echo '<form action="index.php#login" method="post">';
        echo '<button class="button-54" style="font-weight: bold; margin-left: 10px;" type="submit" name="login">login</button>';
        echo '</form>';
    }

    public function getUserID($username){
        $query = "SELECT id FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    public function getUserName($id){
        $query = "SELECT username FROM users WHERE id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }


    public function getUserType($username){
        $query = "SELECT user_type FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    
    public function createAnonymousButton(){
        echo '<div class="anonymous_button" title="Browse anonymously">';
        echo '<button type="button" class="button-55" style="height: 70px; width: 70px;" role="button" onclick="window.location.href = '."'gallery.php'".';">';
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 100%; width: 100%;">
                <img style="height: 50px; width: 50px;" src="images/utility/anonymous.png">
            </div>
        </button>
        </div>';
    }

    public function createUploadModal(){
        if((isset($_SESSION["user_id"])) && ($_SESSION["user_type"] > UserType::USER)){
            $user_id = $_SESSION["user_id"];
            echo '<button type="button" class="btn custom-modal-button" data-bs-toggle="modal" data-bs-target="#upload'.$user_id.'">';
            echo '<div class="upload_button">';
            echo '<img style="height: 100px; width: 100px;" src="images/utility/upload.png">';
            echo '</div>';
            echo '</button>';
        }
    }

    public function displayUploadModal(){
        $user_id = $_SESSION["user_id"];
        echo '<div class="modal" id="upload'.$user_id.'">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Upload an image</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">';
                    require_once "inputforms/galleryupload.html";
                    echo '</div>
                </div>
                </div>
            </div>';
    }

    public function getNextAvailableUserID(){
        $query = "SELECT MAX(id) FROM users;";
        $statement = $this->handle->query($query);
        $max_id = $statement->fetchColumn();
        $next_id = $max_id;
        return $next_id;
    }

    public function createRatingForm($image_id){
        $rating_contr = new RatingContr();
        $rating_contr->setParams($_SESSION["user_id"], $image_id, 0);
        if($rating_contr->hasUserRated()){
            $rating = $rating_contr->fetchPreviousRating();
            switch($rating){
                case "1":
                    echo '<div class="rating_container">
                        <div class="rating_box">
                            <form action="includes/rating.inc.php" method="post">
                            <label><button style="background-color: black; border: none;" type="submit" name="submit" value="'.$image_id.'"><img style="background-color: black; height: 25px; width: 25px; vertical-align: top;" src="images/utility/check.png"></button></label>        
                                <input class="rate_5" type="radio" name="rate" id="rate-'.$image_id.'5" value="5">
                                <label for="rate-'.$image_id.'5" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'4" value="4">
                                <label for="rate-'.$image_id.'4" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'3" value="3">
                                <label for="rate-'.$image_id.'3" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'2" value="2">
                                <label for="rate-'.$image_id.'2" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'1" value="1" checked>
                                <label for="rate-'.$image_id.'1" class="fas fa-star" style="color: #fd4;"></label>
                            </form>
                        </div>
                    </div>';
                    break;
                case "2":
                    echo '<div class="rating_container">
                        <div class="rating_box">
                            <form action="includes/rating.inc.php" method="post">
                            <label><button style="background-color: black; border: none;" type="submit" name="submit" value="'.$image_id.'"><img style="background-color: black; height: 25px; width: 25px; vertical-align: top;" src="images/utility/check.png"></button></label>        
                                <input class="rate_5" type="radio" name="rate" id="rate-'.$image_id.'5" value="5">
                                <label for="rate-'.$image_id.'5" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'4" value="4">
                                <label for="rate-'.$image_id.'4" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'3" value="3">
                                <label for="rate-'.$image_id.'3" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'2" value="2" checked>
                                <label for="rate-'.$image_id.'2" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'1" value="1" checked>
                                <label for="rate-'.$image_id.'1" class="fas fa-star" style="color: #fd4;"></label>
                            </form>
                        </div>
                    </div>';
                    break;
                case "3":
                    echo '<div class="rating_container">
                        <div class="rating_box">
                            <form action="includes/rating.inc.php" method="post">
                            <label><button style="background-color: black; border: none;" type="submit" name="submit" value="'.$image_id.'"><img style="background-color: black; height: 25px; width: 25px; vertical-align: top;" src="images/utility/check.png"></button></label>        
                                <input class="rate_5" type="radio" name="rate" id="rate-'.$image_id.'5" value="5">
                                <label for="rate-'.$image_id.'5" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'4" value="4">
                                <label for="rate-'.$image_id.'4" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'3" value="3" checked>
                                <label for="rate-'.$image_id.'3" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'2" value="2" checked>
                                <label for="rate-'.$image_id.'2" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'1" value="1" checked>
                                <label for="rate-'.$image_id.'1" class="fas fa-star" style="color: #fd4;"></label>
                            </form>
                        </div>
                    </div>';
                    break;
                case "4":
                    echo '<div class="rating_container">
                        <div class="rating_box">
                            <form action="includes/rating.inc.php" method="post">
                            <label><button style="background-color: black; border: none;" type="submit" name="submit" value="'.$image_id.'"><img style="background-color: black; height: 25px; width: 25px; vertical-align: top;" src="images/utility/check.png"></button></label>        
                                <input class="rate_5" type="radio" name="rate" id="rate-'.$image_id.'5" value="5">
                                <label for="rate-'.$image_id.'5" class="fas fa-star"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'4" value="4" checked>
                                <label for="rate-'.$image_id.'4" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'3" value="3" checked>
                                <label for="rate-'.$image_id.'3" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'2" value="2" checked>
                                <label for="rate-'.$image_id.'2" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'1" value="1" checked>
                                <label for="rate-'.$image_id.'1" class="fas fa-star" style="color: #fd4;"></label>
                            </form>
                        </div>
                    </div>';
                    break;
                case "5":
                    echo '<div class="rating_container">
                        <div class="rating_box">
                            <form action="includes/rating.inc.php" method="post">
                            <label><button style="background-color: black; border: none;" type="submit" name="submit" value="'.$image_id.'"><img style="background-color: black; height: 25px; width: 25px; vertical-align: top;" src="images/utility/check.png"></button></label>        
        
                                <input class="rate_5" type="radio" name="rate" id="rate-'.$image_id.'5" value="5" checked>
                                <label for="rate-'.$image_id.'5" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'4" value="4" checked>
                                <label for="rate-'.$image_id.'4" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'3" value="3" checked>
                                <label for="rate-'.$image_id.'3" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'2" value="2" checked>
                                <label for="rate-'.$image_id.'2" class="fas fa-star" style="color: #fd4;"></label>
        
                                <input type="radio" name="rate" id="rate-'.$image_id.'1" value="1" checked>
                                <label for="rate-'.$image_id.'1" class="fas fa-star" style="color: #fd4;"></label>
                            </form>
                        </div>
                    </div>';
                    break;                    
            }
        } else {
            echo '<div class="rating_container">
            <div class="rating_box">
                <form action="includes/rating.inc.php" method="post">
                <label><button style="background-color: black; border: none;" type="submit" name="submit" value="'.$image_id.'"><img style="background-color: black; height: 25px; width: 25px; vertical-align: top;" src="images/utility/check.png"></button></label>        
                <input class="rate_5" type="radio" name="rate" id="rate-'.$image_id.'5" value="5">
                    <label for="rate-'.$image_id.'5" class="fas fa-star"></label>

                    <input type="radio" name="rate" id="rate-'.$image_id.'4" value="4">
                    <label for="rate-'.$image_id.'4" class="fas fa-star"></label>

                    <input type="radio" name="rate" id="rate-'.$image_id.'3" value="3">
                    <label for="rate-'.$image_id.'3" class="fas fa-star"></label>

                    <input type="radio" name="rate" id="rate-'.$image_id.'2" value="2">
                    <label for="rate-'.$image_id.'2" class="fas fa-star"></label>

                    <input type="radio" name="rate" id="rate-'.$image_id.'1" value="1">
                    <label for="rate-'.$image_id.'1" class="fas fa-star"></label>
                </form>
            </div>
        </div>';
        }
    }
}
