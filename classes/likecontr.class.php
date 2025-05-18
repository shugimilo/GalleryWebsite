<?php

class LikeContr extends Like {
    private $id;
    private $image_id;
    private $user_id;
    private $is_liked;

    public function __construct(){
        parent::__construct();
    }

    public function setImageID($image_id){
        $this->image_id = $image_id;
    }

    public function setUserID($user_id){
        $this->user_id = $user_id;
    }

    public function setParams($user_id, $image_id){
        if($this->checkIfLiked($user_id, $image_id)){
            $this->is_liked = true;
            $this->id = $this->fetchID($image_id, $user_id);
            $this->image_id = $image_id;
            $this->user_id = $user_id;
        } else {
            $this->user_id = $user_id;
            $this->image_id = $image_id;
            $this->is_liked = false;
        }
    }

    public function checkIfUserLiked(){
        return $this->is_liked;
    }

    public function getLikes(){
        return $this->fetchImageLikes($this->image_id);
    }

    public function getImageID(){
        return $this->image_id;
    }

    public function like(){
        $this->createLike($this->user_id, $this->image_id);
    }

    public function unlike(){
        $this->deleteLike($this->user_id, $this->image_id);
    }

    public function getUsersLikedImages(){
        return $this->getUserLikedImages($this->user_id);
    }
}