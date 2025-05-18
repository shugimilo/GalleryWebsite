<?php

class ImageContr extends Image {
    private $id;
    private $file_name;
    private $title;
    private $file_description;
    private $file_extension;
    private $uploaded_at;
    private $edited_at;
    private $user_id;
    private $likecount;
    private $viewcount;
    private $is_public;

    public function __construct(){
        parent::__construct();
    }

    public function setImageID($image_id){
        $this->id = $image_id;
    }

    public function getAll(){
        return $this->getAllImages();
    }

    public function setParams($image){
        parent::__construct();
        $this->id = $image["id"];
        $this->file_name = $image["file_name"];
        $this->title = $image["title"];
        $this->file_description = $image["file_description"];
        $this->file_extension = $image["file_extension"];
        $this->uploaded_at = $image["uploaded_at"];
        $this->edited_at = $image["edited_at"];
        $this->user_id = $image["user_id"];
        $like_contr = new LikeContr();
        $like_contr->setImageID($this->id);
        $like_count = $like_contr->getLikes();
        $this->likecount = $like_count;
        $this->viewcount = $image["viewcount"];
        $this->is_public = $image["is_public"];
    }

    public function getUploadedAt(){
        return $this->uploaded_at;
    }

    public function getUserID(){
        return $this->user_id;
    }
 
    public function getFullImageName(){
        return $this->file_name.$this->file_extension;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getID(){
        return $this->id;
    }

    public function getPrivacy(){
        return $this->is_public;
    }

    public function getDescription(){
        return $this->file_description;
    }

    public function getLikes(){
        return $this->likecount;
    }

    public function displayImage($current_file) {
        $base_path = '';

        if(strpos($current_file, 'edit') !== false){
            $base_path = '../';
        }

        echo '<div>';
        // The next line is there to add a basic feature of opening the image in the browser
        echo '<a href="'.$base_path.'images/'.$this->file_name.$this->file_extension.'" target="_blank">';
        echo '<img class="image" src="'.$base_path.'images/'.$this->file_name.$this->file_extension.'">';
        echo '</a>';
        echo '</div>';
    }

    public function displayTitle(){
        echo '<h3>'.$this->title.'</h3>';
    }

    public function displayDescription(){
        echo '<p class="imagedescription">'.$this->file_description.'</p>';
    }
 
    public function displayImageContainer($current_file){
        if(($this->is_public) || (isset($_SESSION["user_id"]) && ($_SESSION["user_id"] == $this->user_id))){
            $this->displayImage($current_file);
            if(!($this->is_public)){
                echo '<span style="opacity: 0.5; font-style: italic;">Private</span>';
            } else {
            }
            $this->displayEditButton();
        }
    }

    public function displayEditButton(){
        if(isset($_SESSION["user_id"])){
            if($_SESSION["user_id"] == $this->user_id){
                echo '<div style="display: flex; justify-content: center;">'; // Apply flexbox and center content horizontally
                echo '<form action="edit/image.edit.php" method="post">';
                echo '<button style="background-color: black; border: 0px;" type="submit" name="edit_image" value="'.$this->id.'">';
                echo '<img class="stats_img" src="images/utility/settings.png">';
                echo '</button>';
                echo '</form>';
                echo '</div>';
            }
        }
    }

    public function updateImage($new_title, $new_desc, $new_visibility){
        $update_counter = 0;
        if(!(empty($new_title))){
            $this->editImageTitle($new_title, $this->id);
            $update_counter++;
        }
        if(!(empty($new_desc))){
            $this->editImageDescription($new_desc, $this->id);
            $update_counter++;
        }
        if(!(empty($new_visibility))){
            $this->editImageVisibility($new_visibility, $this->id);
            $update_counter++;
        }
        if($update_counter > 0){
            $this->logImageEdit($this->id);
        }
    }

    public function updateVisibility($new_visibility){
        $this->editImageVisibility($new_visibility, $this->id);
    }

    public function delete(){
        $this->deleteImage($this->id);
    }
}