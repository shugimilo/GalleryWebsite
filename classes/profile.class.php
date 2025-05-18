<?php

class Profile extends Database {
    public function __construct() {
        parent::__construct();
    }

    protected function getFirstName($username){
        $query = "SELECT first_name FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getLastName($username){
        $query = "SELECT last_name FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getEmail($username){
        $query = "SELECT email FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getDoB($username){
        $query = "SELECT date_of_birth FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getCreatedAt($username){
        $query = "SELECT created_at FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function getID($username){
        $query = "SELECT id FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }
}