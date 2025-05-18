<?php

class LoginContr extends Login {
    private $username;
    private $pwd;
    private array $global_errors;

    public function __construct($username, $pwd) {
        $this->username = htmlspecialchars($username);
        $this->pwd = $pwd;
    }

    public function tryToLogIn(){
        $check_result = $this->checkIfUsernamePasswordEmpty();
        if($check_result !== "good"){
            $this->global_errors[] = $check_result;
            session_start();
            $_SESSION['errors'] = $this->getGlobalErrors();
            header("Location: ../errors/login.error.php");
        } else {
            if($this->checkIfUserExists($this->username)){
                $stored = $this->getUserPassword($this->username);
                if($this->checkPassword($stored)){
                    //-------Successful log in-------//
                    $_SESSION["username"] = $this->username;
                    $_SESSION["user_type"] = $this->getUserType($this->username);
                    $_SESSION["user_id"] = $this->getUserID($this->username);
                    $_SESSION["logged_in"] = 1;
                    header("Location: ../success.php");
                } else {
                    session_start();
                    $this->global_errors[] = "Incorrect password.";
                    $_SESSION['errors'] = $this->getGlobalErrors();
                    header("Location: ../errors/login.error.php");
                }
            } else {
                session_start();
                $this->global_errors[] = "Username doesn't exist.";
                $this->global_errors[] = "Would you like to create an account? Click 'Try again'.";
                $_SESSION['errors'] = $this->getGlobalErrors();
                header("Location: ../errors/login.error.php");
            }
        }
    }

    private function checkIfUsernamePasswordEmpty(){
        $count = 0;
        if(empty($this->username)){
            $count += 1;
        }
        if(empty($this->pwd)){
            $count += 2;
        }
        switch($count){
            default:
            case 0:
                return "good";
                break;
            case 1:
                return "You must enter a username!";
                break;
            case 2:
                return "You must enter a password!";
                break;
            case 3:
                return "You must enter a username and a password!";
                break;
        }
    }

    private function getGlobalErrors(){
        return $this->global_errors;
    }

    private function checkPassword($stored){
        return password_verify($this->pwd, $stored);
    }
}