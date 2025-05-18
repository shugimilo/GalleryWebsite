<?php

class Like extends Database {
    public function __construct(){
        parent::__construct();
    }

    protected function createLike($user_id, $image_id){
        $query = "INSERT INTO likes (user_id, image_id) VALUES (:usr, :img);";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
    }

    protected function deleteLike($user_id, $image_id){
        $query = "DELETE FROM likes WHERE user_id = :usr AND image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
    }

    protected function fetchImageLikes($image_id){
        $query = "SELECT * FROM likes WHERE image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
        $results = $statement->fetchAll();
        $count = 0;
        foreach($results as $result){
            if(!(empty($result))){
                $count++;
            }
        }
        return $count;
    }

    protected function checkIfLiked($user_id, $image_id){
        $query = "SELECT * FROM likes WHERE user_id = :usr AND image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
        $result = $statement->fetchAll();
        if(empty($result)){
            return false;
        } else {
            return true;
        }
    }

    protected function fetchID($image_id, $user_id){
        $query = "SELECT id FROM likes WHERE image_id = :img AND user_id = :usr;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":img", $image_id);
        $statement->bindValue(":usr", $user_id);
        $statement->execute();
        $id = $statement->fetchColumn();
        return $id;
    }

    protected function getUserLikedImages($user_id){
        $query = "SELECT * FROM likes WHERE user_id = :usr;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->execute();
        $results = $statement->fetchAll();
        $image_ids = array();
        if(!(empty($results))){
            foreach($results as $result){
                $image_ids[] = $result["image_id"];
            }
        }
        return $image_ids;
    }
}