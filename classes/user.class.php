<?php

class User extends Database {
    public function __construct(){
        parent::__construct();
    }

    protected function promoteUser($user_id){
        $query = "UPDATE users SET user_type = :newtype WHERE id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $user_id);
        $statement->bindValue(":newtype", UserType::ARTIST);
        $statement->execute();
    }

    protected function getAllUsers(){
        $query = "SELECT * FROM users;";
        $fetch = $this->handle->query($query);
        $result = $fetch->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }

    protected function getUsernameByID($user_id){
        $query = "SELECT username FROM users WHERE id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $user_id);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getID($email){
        $query = "SELECT id FROM users WHERE email = :email;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":email", $email);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function changeUserPassword($user_id, $new_pwd){
        $query = "UPDATE users SET pwd = :new_pwd WHERE id = :id;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":id", $user_id);
        $new_hash = password_hash($new_pwd, PASSWORD_DEFAULT);
        $statement->bindValue(":new_pwd", $new_hash);
        $statement->execute();
    }

    protected function deleteUserAccount($user_id){
        $query = "DELETE FROM users WHERE id = :usr;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":usr", $user_id);
        $statement->execute();
    }
}