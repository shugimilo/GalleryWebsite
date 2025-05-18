<?php

class UserContr extends User {
    private $username;
    private $id;

    public function __construct(){
        parent::__construct();
    }

    public function promote(){
        $this->promoteUser($this->id);
    }

    public function getAll(){
        return $this->getAllUsers();
    }

    public function setParams($id){
        $this->id = $id;
        $this->username = $this->getUsernameByID($id);
    }

    public function getUsername(){
        return $this->username;
    }

    public function fetchIDbyEmail($email){
        return $this->getID($email);
    }

    public function changePassword($user_id, $new_pwd){
        $this->changeUserPassword($user_id, $new_pwd);
    }

    public function deleteUser(){
        $this->deleteUserAccount($this->id);
    }
}