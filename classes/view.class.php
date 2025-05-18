<?php

class View extends Database {
    public function __construct(){
        parent::__construct();
    }

    protected function addView($image_id, $user_id){
        $query = "INSERT INTO image_views(image_id, user_id) VALUES (:img, :usr);";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":img", $image_id);
        $statement->bindValue(":usr", $user_id);
        $statement->execute();
    }

    protected function getLastViewByUser($user_id, $image_id){
        $query = "SELECT viewed_at FROM image_views WHERE user_id = :usr AND image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":img", $image_id);
        $statement->bindValue(":usr", $user_id);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getTotalImageViews($image_id){
        $query = "SELECT * FROM image_views WHERE image_id = :img;";
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
}
