<?php

class Comment extends Database {
    public function __construct(){
        parent::__construct();
    }

    protected function getAllComments(){
        $query = "SELECT * FROM comments;";
        $fetcher = $this->handle->query($query);
        $results = $fetcher->fetchAll();
        return $results;
    }

    protected function submitComment($user, $image, $text){
        $query = "INSERT INTO comments(posted_by, image_id, comment_body, posted_at) VALUES (:usrid, :imgid, :txt, :tstmp);";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usrid", $user);
        $statement->bindValue(":imgid", $image);
        $statement->bindValue(":txt", $text);
        $now = date('Y-m-d H:i:s');
        $statement->bindValue(":tstmp", $now);
        $statement->execute();
    }

    protected function deleteComment($user_id, $image_id){
        $query = "DELETE FROM comments WHERE posted_by = :usr AND image_id = :img;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->bindValue(":img", $image_id);
        $statement->execute();
    }

    protected function getAllUserComments($uid){
        $query = "SELECT * FROM comments WHERE posted_by = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $uid);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function getAllImageComments($img_id){
        $query = "SELECT * FROM comments WHERE image_id = :image_id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":image_id", $img_id);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }
}