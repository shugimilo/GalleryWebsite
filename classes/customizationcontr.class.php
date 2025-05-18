<?php

class CustomizationContr {
    private $id;
    const path_for_pp = "images/profilepictures/";
    const path_for_pb = "images/profilebackgrounds/";

    public function __construct($id){
        $this->id = $id;
    }

    public function uploadProfilePicture($file){
        $target_dir = self::path_for_pp;
        $target_file = $target_dir . $this->id . ".jpg";

        $upload_ok = 1;
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $upload_ok = 1;
        } else {
            return 0;
            $upload_ok = 0;
        }
    
        if ($file["size"] > 500000) {
            return 0;
            $upload_ok = 0;
        }
    
        if($imageFileType != "jpg") {
            return 0;
            $upload_ok = 0;
        }
    
        if ($upload_ok == 0) {
            return 0;
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return 1;
            } else {
                return 0;
            }
        }
    }    
    
    public function uploadBackgroundImage($file){
        $target_dir = self::path_for_pb;
        $target_file = $target_dir . $this->id . ".jpg";
        $upload_ok = 1;
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $upload_ok = 1;
        } else {
            $upload_ok = 0;
        }
    
        if(($imageFileType != "jpg") || $imageFileType != "jpeg") {
            $upload_ok = 0;
        }
    
        if ($upload_ok == 0) {
            return 0;
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return 1;
            } else {
                return 0;
            }
        }
    }    

    public function displayProfilePicturePreview(){
        $image_path = self::path_for_pp . $this->id . ".jpg";
        if(file_exists($image_path)){
            return '<img src="' . $image_path . '" style="max-width: 200px; max-height: 200px; border-radius: 50%;">';
        } else {
            return "No profile picture uploaded.";
        }
    }

    public function displayBackgroundImagePreview(){
        $image_path = self::path_for_pb . $this->id . ".jpg";
        if(file_exists($image_path)){
            return '<img src="' . $image_path . '" style="max-width: 200px; max-height: 200px;">';
        } else {
            return "No background image uploaded.";
        }
    }

    public function createProfilePreview(){
        echo '<button type="button" class="button-55" data-bs-toggle="modal" data-bs-target="#preview">';
        echo '<div>';
        echo '<p>take a look!</p>';
        echo '</div>';
        echo '</button>';
    }

    public function displayProfilePreview($username, $fullname, $email, $dob){
        $current_time = time();
        $now = date("Y-m-d H:i:s", $current_time);
        echo '<div class="modal" id="preview">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Profile Preview</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="profile_preview" style="height: 210px; max-width: 100%; display: flex; align-items: center; background-image: url(images/profilebackgrounds/'.$this->id.'.jpg); background-size: cover; background-position: center;">
                                <div class="profile">
                                    <div class="picture">
                                        <img class="largeprofilepic" style="width: 200px; height: 200px; border-radius: 50%; margin: 5px;" src="images/profilepictures/'.$this->id.'.jpg">
                                    </div>
                                    <div class="info" style="align-items: center; padding-bottom: 35px; padding-top: 35px;">
                                        <p style="background-color: black;"><span class="fadedtext">Username: </span>'.$username.'</p>
                                        <p style="background-color: black;"><span class="fadedtext">Full name: </span>'.$fullname.'</p>
                                        <p style="background-color: black;"><span class="fadedtext">Email: </span>'.$email.'</p>
                                        <p style="background-color: black;"><span class="fadedtext">Date of Birth: </span>'.$dob.'</p>
                                        <p style="background-color: black;"><span class="fadedtext">Date joined: </span>'.$now.'</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <form action="customizeprofile.php" method="post">
                                    <button title="Upload a profile picture and background before signup" class="button-55" type="submit" name="signup" value="Sign up">sign up</button>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>';
    }    
}