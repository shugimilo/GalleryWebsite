<?php

class Upload extends Database {
    protected function getUserImages($owner_id) {
        parent::__construct();
        $query = "SELECT * FROM images WHERE user_id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $owner_id);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    protected function uploadImage($file_name, $title, $file_description, $user_id, $file_extension){
        parent::__construct();
        $query = "INSERT INTO images (file_name, title, file_description, user_id, file_extension) VALUES (:f, :t, :d, :id, :fe);";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":f", $file_name);
        $statement->bindValue(":t", $title);
        $statement->bindValue(":d", $file_description);
        $statement->bindValue(":id", $user_id);
        $statement->bindValue(":fe", $file_extension);
        $statement->execute();
    }

    protected function checkFileName($file_name){
        parent::__construct();
        $query = "SELECT * FROM images WHERE file_name = :file_name;"; 
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":file_name", $file_name);
        if($statement->execute()){
            if($statement->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        } else {
            $statement = null;
            header("Location: ../gallery.php");
            die();
        }
    }
}