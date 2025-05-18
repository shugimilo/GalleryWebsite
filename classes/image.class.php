<?php

class Image extends Database {
    public function __construct(){
        parent::__construct();
    }

    public function getAllImages(){
        $query = "SELECT * FROM images;";
        $fetch = $this->handle->query($query);
        $result = $fetch->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllUserImages($user_id){
        $query = "SELECT * FROM images WHERE user_id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $user_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getImageByID($image_id){
        $query = "SELECT * FROM images WHERE id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $image_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function editImageTitle($title, $id){
        $query = "UPDATE images SET title = :title WHERE id = :id;";
        $sql = $this->handle->prepare($query);
        $sql->bindValue(":title", $title);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    protected function editImageDescription($description, $id){
        $query = "UPDATE images SET file_description = :file_description WHERE id = :id;";
        $sql = $this->handle->prepare($query);
        $sql->bindValue(":file_description", $description);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    protected function editImageVisibility($visibility, $id){
        $query = "UPDATE images SET is_public = :visibility WHERE id = :id;";
        if($visibility == "private"){
            $is_public = 0;
        } else  if($visibility == "public"){
            $is_public = 1;
        }
        $sql = $this->handle->prepare($query);
        $sql->bindValue(":visibility", $is_public);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    protected function logImageEdit($id){
        $query = "UPDATE images SET edited_at = :right_now WHERE id = :id;";
        $sql = $this->handle->prepare($query);
        $right_now = date('Y-m-d H:i:s');
        $sql->bindValue(":right_now", $right_now);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    protected function deleteImage($id){
        $query = "DELETE FROM images WHERE id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}