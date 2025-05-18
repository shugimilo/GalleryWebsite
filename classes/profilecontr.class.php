<?php

class ProfileContr extends Profile {
    private $id;
    private $first_name;
    private $last_name;
    private $username;
    private $email;
    private $date_of_birth;
    private $created_at;
    private array $global_errors;

    public function __construct($username) {
        parent::__construct();
        $this->username = $username;
        $this->id = $this->getID($this->username);
        $this->first_name = $this->getFirstName($this->username);
        $this->last_name = $this->getLastName($this->username);
        $this->email = $this->getEmail($this->username);
        $this->date_of_birth = $this->getDoB($this->username);
        $this->created_at = $this->getCreatedAt($this->username);
    }

    public function displayUsername(){
        echo $this->username;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getUserID(){
        return $this->id;
    }

    public function getUserEmail(){
        return $this->email;
    }

    public function getFullName(){
        return $this->first_name." ".$this->last_name;
    }

    public function getDateOfBirth(){
        return $this->date_of_birth;
    }

    public function getDateCreated(){
        return $this->created_at;
    }

    public function displayFullName(){
        echo $this->first_name." ".$this->last_name;
    }

    public function displayEmail(){
        echo $this->email;
    }

    public function displayDoB(){
        echo $this->date_of_birth;
    }

    public function displayCreatedAt(){
        echo $this->created_at;
    }

    public function createDeleteModal(){
        echo '<button style="align-self: center;" type="button" class="button-56" data-bs-toggle="modal" data-bs-target="#deleteAccount'.$this->getUserID().'">';
        echo 'delete account';
        echo '</button>';
    }

    public function displayDeleteModal(){
        echo '<div class="modal" id="deleteAccount'.$this->getUserID().'">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">are you sure you want to delete your account?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="includes/user.delete.inc.php" method="post">
                            <button class="button-55" type="submit" name="yes" value="'.$this->getUserID().'"><b>yes</b></button>
                            <button class="button-55" type="submit" name="no" value="'.$this->getUserID().'"><b>no</b></button>
                        </form>
                    </div>
                </div>
                </div>
            </div>';
    }
}