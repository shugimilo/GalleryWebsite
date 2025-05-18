<?php

class ModalContr {
    private $image;
    public $comments;

    public function __construct($image){
        $this->image = new ImageContr();
        $comment_fetcher = new CommentContr();
        $this->image->setParams($image);
        $comment_fetcher->setImageID($this->image->getID());
        $fetched_comments = $comment_fetcher->fetchImageComments();
        $this->comments = array();
        foreach($fetched_comments as $fetched_comment){
            $comment = new CommentContr();
            $comment->createComment($fetched_comment);
            $this->comments[] = $comment;
        }
    }

    public function getLikes(){
        return $this->image->getLikes();
    }

    public function getDate(){
        return $this->image->getUploadedAt();
    }
 
    public function createModalButton(){
        if(($this->image->getPrivacy()) || (isset($_SESSION["user_id"]) && ($_SESSION["user_id"] == $this->image->getUserID()))){
            $like_contr = new LikeContr();
            $like_contr->setImageID($this->image->getID());

            $image_likes = $like_contr->getLikes();
            $date_posted = $this->image->getUploadedAt();

            $owner_id = $this->image->getUserID();
            $owner = new UserContr();
            $owner->setParams($owner_id);
            $owner_username = $owner->getUsername();

            echo '<div class="preview_modal" style="margin: 10px 20px;">';
            echo '<div class="owner_info" style="padding-top: 5px;">';
            if(isset($_SESSION["user_id"])){
                if($owner_id == $_SESSION["user_id"]){
                    echo '<form action="profile.php" method="post">';
                    echo '<button class="comment_button" style="background-color: black;" type="submit">';
                } else {
                    echo '<form action="otherprofile.php" method="post">';
                    echo '<button name="otherprofile" class="comment_button" style="background-color: black;" type="submit" value="'.$this->image->getUserID().'">';
                }
            } else {
                echo '<form action="otherprofile.php" method="post">';
                echo '<button name="otherprofile" class="comment_button" style="background-color: black;" type="submit" value="'.$this->image->getUserID().'">';
            }
            echo '<img class="owner_profile_picture" src="images/profilepictures/'.$owner_id.'.jpg">';
            echo '<span style="font-weight: bold; letter-spacing: 2px;">'.$owner_username.'</span>';
            echo '</button>';
            echo '</form>';
            echo '</div>';
            if(isset($_SESSION["user_id"])){
                echo '<button type="button" class="btn custom-modal-button" data-bs-toggle="modal" data-bs-target="#imgModal'.$this->image->getID().'" data-likes="'.$image_likes.'" data-upload-date="'.$date_posted.'" data-image-id="'.$this->image->getID().'" data-user-id="'.$_SESSION["user_id"].'">';
            } else {
                echo '<button type="button" class="btn custom-modal-button" data-bs-toggle="modal" data-bs-target="#imgModal'.$this->image->getID().'" data-likes="'.$image_likes.'" data-upload-date="'.$date_posted.'">';
            }
            echo '<img src="images/'.$this->image->getFullImageName().'" class="image">';
            echo '</button>';
            if(!($this->image->getPrivacy())){
                $lock = "images/utility/locked.png";
            } else {
                $lock = "images/utility/unlocked.png";
            }
            echo '<div style="display: flex; justify-content: center;">';
            if((isset($_SESSION["user_id"])) && ($_SESSION["user_id"] == $owner_id)){
                echo '<img class="stats_img" style="align-self: center; margin-right: 8px; margin-left: 10px;" id="privacyBtn'.$this->image->getID().'" src="'.$lock.'" onclick="changePrivacy('.$this->image->getID().')">';
            }
            $this->createEditModal();
            $this->displayEditModal();
            $this->createDeleteModal();
            $this->displayDeleteModal();
            echo '</div>';
            echo '</div>';
        }
    }
 
    public function displayModal(){
        $owner_id = $this->image->getUserID();
        $owner = new UserContr();
        $owner->setParams($owner_id);
        $owner_username = $owner->getUsername();
        echo '<div class="modal fade" id="imgModal'.$this->image->getID().'" tabindex="-1" aria-labelledby="imgModalLabel'.$this->image->getID().'" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-size: 0.9em;text-transform: uppercase; font-family: SisterSpray;">'.
                            $this->image->getTitle().
                            '</h4><span style="margin-left: 10px; opacity: 0.5; font-weight: bold;"> by '.$owner_username.'</span>
                            <img class="comment_profilepic" src="images/profilepictures/'.$owner_id.'.jpg">
                            <span>'.$this->image->getUploadedAt().'</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="max-width">
                            <div class="col-md-6">
                                <a title="View full image" href="images/'.$this->image->getFullImageName().'" target="_blank">
                                    <img src="images/'.$this->image->getFullImageName().'" class="img-fluid" style="max-height: 500px; height: auto; width: auto; max-width: 100%;">
                                </a>
                                <div class="description">
                                    <p>"'.$this->image->getDescription().'"</p>
                                </div>
                            </div>
                            <div class="col-md-6">';                        
                                echo '<div class="comment_section">';
                                    foreach($this->comments as $comment){
                                        $comment->displayComment();
                                    }
                                echo '</div>';
                                if(isset($_SESSION["user_id"])){
                                    if(empty($this->comments)){
                                        echo '<div class="stats" style="display: flex; justify-content: center;"><span style="font-weight: bold; font-family: Open Sans, sans-serif;">It'."'s a bit quiet here. Be the first to comment!</span></div>";
                                    }
                                    $stats_contr = new StatsContr($_SESSION["user_id"], $this->image->getID());
                                    $stats_contr->displayStats();
                                    $util = new Utility();
                                    $util->createRatingForm($this->image->getID());
                                }
                            echo '</div>
                        </div>';
                        if(isset($_SESSION["user_id"])){
                            echo '<div style="text-align: left;">';
                            include "inputforms/comment.php";
                            echo '</div>';
                        }
                    echo '</div>
                </div>
            </div>
        </div>';
    }

    public function createEditModal(){
        if((isset($_SESSION["user_id"])) && ($_SESSION["user_id"] == $this->image->getUserID())){
            echo '<button type="button" class="btn custom-modal-button" data-bs-toggle="modal" data-bs-target="#edit'.$this->image->getID().'">';
            echo '<div>';
            echo '<img class="stats_img" src="images/utility/settings.png">';
            echo '</div>';
            echo '</button>';
        }
    }

    public function createDeleteModal(){
        if((isset($_SESSION["user_id"])) && ($_SESSION["user_id"] == $this->image->getUserID())){
            echo '<button type="button" class="btn custom-modal-button" data-bs-toggle="modal" data-bs-target="#delete'.$this->image->getID().'">';
            echo '<div>';
            echo '<img class="stats_img" src="images/utility/delete.png">';
            echo '</div>';
            echo '</button>';
        }
    }

    public function displayEditModal(){
        echo '<div class="modal" id="edit'.$this->image->getID().'">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">editing <span class="title">'.$this->image->getTitle().'</span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <form action="includes/image.edit.inc.php" method="post">
                        <div class="inputfield">
                            <label for="new_title">New title: </label>
                            <input class="custom_input" type="text" name="new_title" placeholder="'.$this->image->getTitle().'"><br>
                        </div>
                        <div class="inputfield">
                            <label for="new_description">New description: </label>
                            <input class="custom_input" type="text" name="new_description" placeholder="'.$this->image->getDescription().'">
                        </div>
                        <div class="inputfield">
                            <label for="new_visibility">Visibility: </label>
                            <label for="new_visibility">Public </label>
                            <input type="radio" name="new_visibility" value="public">
                            <label for="new_visibility">Private</label>
                            <input type="radio" name="new_visibility" value="private">
                        </div>
                        <button class="button-55" type="submit" name="confirm" value="'.$this->image->getID().'">confirm</button>
                    </form>';
                    echo '</div>
                </div>
                </div>
            </div>';
    }

    public function displayDeleteModal(){
        echo '<div class="modal" id="delete'.$this->image->getID().'">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">are you sure you want to delete <span class="title">'.$this->image->getTitle().'</span> ?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <form action="includes/image.delete.inc.php" method="post">
                        <button class="button-55" type="submit" name="yes" value="'.$this->image->getID().'"><b>yes</b></button>
                        <button class="button-55" type="submit" name="no" value="'.$this->image->getID().'"><b>no</b></button>
                    </form>';
                    echo '</div>
                </div>
                </div>
            </div>';
    }
}