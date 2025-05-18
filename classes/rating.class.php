<?php

class Rating extends Database {
    protected function createRating($image_id, $user_id, $rating){
        $query = "INSERT INTO ratings(image_id, rated_by, rating) VALUES (:img, :usr, :rate);";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":img", $image_id);
        $statement->bindValue(":usr", $user_id);
        $statement->bindValue(":rate", $rating);
        $statement->execute();
    }

    protected function removeRating($image_id, $user_id){
        $query = "DELETE FROM ratings WHERE image_id = :img AND rated_by = :usr;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":img", $image_id);
        $statement->bindValue(":usr", $user_id);
        $statement->execute();
    }

    protected function checkIfUserRated($user_id, $image_id){
        $query = "SELECT id FROM ratings WHERE rated_by = :usr AND image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
        $result = $statement->fetchColumn();
        if(empty($result)){
            return false;
        } else {
            return true;
        }
    }

    protected function getPreviousRating($user_id, $image_id){
        $query = "SELECT rating FROM ratings WHERE rated_by = :usr AND image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getAverageRating($image_id){
        $query = "SELECT AVG(rating) FROM ratings WHERE image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
        $result = $statement->fetchColumn();
        $result = round($result, 2);
        return $result;        
    }
}