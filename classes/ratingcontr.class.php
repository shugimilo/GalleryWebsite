<?php

class RatingContr extends Rating {
    private $user_id;
    private $image_id;
    private $rating;

    public function __construct(){
        parent::__construct();

    }

    public function setImageID($image_id){
        $this->image_id = $image_id;
    }

    public function setParams($user_id, $image_id, $rating){
        $this->user_id = $user_id;
        $this->image_id = $image_id;
        $this->rating = $rating;
    }

    public function uploadRating(){
        $user_has_rated = $this->checkIfUserRated($this->user_id, $this->image_id);
        if($user_has_rated){
            $this->removeRating($this->image_id, $this->user_id);
            $this->createRating($this->image_id, $this->user_id, $this->rating);
        } else {
            $this->createRating($this->image_id, $this->user_id, $this->rating);
        }
    }

    public function hasUserRated(){
        return $this->checkIfUserRated($this->user_id, $this->image_id);
    }

    public function fetchPreviousRating(){
        return $this->getPreviousRating($this->user_id, $this->image_id);
    }

    public function fetchAverageRating(){
        return $this->getAverageRating($this->image_id);
    }
}