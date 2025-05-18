<?php

class Login extends Database {
    protected function getUserPassword($username){
        parent::__construct();
        $query = "SELECT pwd FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getUserID($username){
        parent::__construct();
        $query = "SELECT id FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getUserType($username){
        parent::__construct();
        $query = "SELECT user_type FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function checkIfUserExists($username){
        parent::__construct();
        $query = "SELECT * FROM users WHERE username = :u;"; 
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":u", $username);
        if($statement->execute()){
            if($statement->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        } else {
            $statement = null;
            header("Location: ../index.php");
            die();
        }
    }
}