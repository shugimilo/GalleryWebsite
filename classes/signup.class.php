<?php
// Class intended to query the database
class Signup extends Database {
    protected function checkIfUserExists($username, $email){
        parent::__construct();
        $query = "SELECT * FROM users WHERE username = :u OR email = :e"; 
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":u", $username);
        $statement->bindValue(":e", $email);
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

    protected function getUserID($username){
        parent::__construct();
        $query = "SELECT id FROM users WHERE username = :username;";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    protected function signUp($f_n, $l_n, $usr, $pwd, $email, $d_o_b, $u_t){
        parent::__construct();
        $hashed = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(first_name, last_name, username, pwd, email, date_of_birth, user_type) VALUES (:f_n, :l_n, :usr, :pwd, :email, :d_o_b, :u_t)";
        $statement = $this->handle->prepare($query);
        $statement->bindValue(":f_n", $f_n);
        $statement->bindValue(":l_n", $l_n);
        $statement->bindValue(":usr", $usr);
        $statement->bindValue(":pwd", $hashed);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":d_o_b", $d_o_b);
        $statement->bindValue(":u_t", $u_t);
        $statement->execute();
    }
}