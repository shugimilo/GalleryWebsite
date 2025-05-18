<?php

class CommentContr extends Comment {
    private $id;
    private $posted_by;
    private $image_id;
    private $comment_body;
    private $posted_at;

    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        return $this->getAllComments();
    }

    public function setParams($poster, $image, $text){
        $this->posted_by = $poster;
        $this->image_id = $image;
        $this->comment_body = $text;
    }

    public function getImageComments(){
        $comments = $this->getAllImageComments($this->image_id);
        $count = 0;
        foreach($comments as $comment){
            if(isset($comment)){
                $count++;
            }
        }
        return $count;
    }

    public function createComment($comment){
        $this->id = $comment["id"];
        $this->posted_by = $comment["posted_by"];
        $this->image_id = $comment["image_id"];
        $this->comment_body = $comment["comment_body"];
        $this->posted_at = $comment["posted_at"];
    }

    public function setImageID($image_id){
        $this->image_id = $image_id;
    }

    public function setUserID($user_id){
        $this->posted_by = $user_id;
    }

    public function getCommentBody(){
        return $this->comment_body;
    }

    public function getPosterID(){
        return $this->posted_by;
    }

    public function getImageID(){
        return $this->image_id;
    }

    public function getTimePosted(){
        return $this->posted_at;
    }

    public function displayComment(){
        $user = new UserContr();
        $user->setParams($this->posted_by);
        echo '<div class="comment_container" style="background-color: black; color: white;">';
        echo '<div class="user_info">';
        if(isset($_SESSION["user_id"])){
            if($this->posted_by == $_SESSION["user_id"]){
                echo '<form action="profile.php" method="post">';
                echo '<button class="comment_button" style="background-color: black;" type="submit">';
            } else {
                echo '<form action="otherprofile.php" method="post">';
                echo '<button name="otherprofile" class="comment_button" style="background-color: black;" type="submit" value="'.$this->posted_by.'">';
            }
        } else {
            echo '<form action="otherprofile.php" method="post">';
            echo '<button name="otherprofile" class="comment_button" style="background-color: black;" type="submit" value="'.$this->posted_by.'">';
        }
        echo '<img class="comment_profilepic" src="images/profilepictures/'.$this->posted_by.'.jpg">';
        echo '<span><b>'.$user->getUsername().'</b> said:</span>';
        echo '</button>';
        echo '</form>';
        echo '</div>';
        echo '<div class="comment_body">';
        echo '<p>'.$this->comment_body.'</p>';
        echo '</div>';
        echo '<span class="time_of_posting"> on '.$this->posted_at.'.</span>';
        echo '</div>';
    }

    public function fetchImageComments(){
        $comments = $this->getAllImageComments($this->image_id);
        return $comments;
    }

    public function upload(){
        if(!(empty($this->comment_body))){
            $this->submitComment($this->posted_by, $this->image_id, $this->comment_body);
            if(isset($_SERVER['HTTP_REFERER'])) {
                header("Location: {$_SERVER['HTTP_REFERER']}");
            } else {
                header("Location: ../gallery.php");
            }
        } else {
            $errors = array();
            $errors[] = "You cannot leave an empty comment!";
            $_SESSION["errors"] = $errors;
            header("Location: ../errors/comment.error.php");
        }
    }

    public function delete(){
        $this->deleteComment($this->posted_by, $this->image_id);
    }
}