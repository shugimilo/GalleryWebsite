<?php
// Class intended to handle user data
class SignupContr extends Signup {
    private $first_name;
    private $last_name;
    private $username;
    private $pwd;
    private $pwd_repeat;
    private $email;
    private $date_of_birth;
    private $user_type;
    private array $global_errors;

    public function __construct($f_n, $l_n, $usr, $pwd, $pwd_rpt, $email, $d_o_b, $u_t){
        $this->first_name = htmlspecialchars($f_n);
        $this->last_name = htmlspecialchars($l_n);
        $this->username = htmlspecialchars($usr);
        $this->pwd = $pwd;
        $this->pwd_repeat = $pwd_rpt;
        $this->email = htmlspecialchars($email);
        $this->date_of_birth = $d_o_b;
        $this->user_type = $u_t;
    }

    public function tryToSignUp(){
        if($this->testSignUpInfo()){
            //-------Successful sign up-------//
            $this->signUp($this->first_name, $this->last_name, $this->username, $this->pwd, $this->email, $this->date_of_birth, $this->user_type);
            $_SESSION["username"] = $this->username;
            $_SESSION["user_type"] = $this->user_type;
            $_SESSION["user_id"] = $this->getUserID($this->username);
            $_SESSION["logged_in"] = 1;
            header("Location: ../customizeprofile.php");
        } else {
            session_start();
            $_SESSION['errors'] = $this->getGlobalErrors();
            header("Location: ../errors/signup.error.php");
        }
    }

    private function checkIfRealNameEmpty(){
        $count = 0;
        if(empty($this->first_name)){
            $count += 1;
        }
        if(empty($this->last_name)){
            $count += 2;
        }
        switch($count){
            default:
            case 0:
                return "good";
                break;
            case 1:
                return "You must enter your first name!";
                break;
            case 2:
                return "You must enter your last name!";
                break;
            case 3:
                return "You must enter your first and last names!";
                break;
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

    private function checkIfRepeatAndEmailEmpty(){
        $count = 0;
        if(empty($this->pwd_repeat)){
            $count += 1;
        }
        if(empty($this->email)){
            $count += 2;
        }
        switch($count){
            default:
            case 0:
                return "good";
                break;
            case 1:
                return "You must repeat the same password!";
                break;
            case 2:
                return "You must enter an email!";
                break;
            case 3:
                return "You must repeat the password and enter your email!";
                break;
        }
    }

    private function checkIfBirthAndUserTypeEmpty(){
        $count = 0;
        if(empty($this->date_of_birth)){
            $count += 1;
        }
        if(empty($this->user_type)){
            $count += 2;
        }
        switch($count){
            default:
            case 0:
                return "good";
                break;
            case 1:
                return "You must enter your date of birth!";
                break;
            case 2:
                return "You must choose a user type!";
                break;
            case 3:
                return "You must enter your date of birth and choose a user type!";
                break;
        }
    }

    private function checkAllInputs(){
        $non_empty = 0;
        $errors[0] = $this->checkIfRealNameEmpty();
        $errors[1] = $this->checkIfUsernamePasswordEmpty();
        $errors[2] = $this->checkIfRepeatAndEmailEmpty();
        $errors[3] = $this->checkIfBirthAndUserTypeEmpty();
        for($i = 0; $i < 4; $i++){
            if($errors[$i] !== "good"){
                //echo "{$errors[$i]}";
                $this->global_errors[] = $errors[$i];
            } else {
                $non_empty++;
            }
        }
        if ($non_empty == 4){
            return true;
        } else {
            return false;
        }
    }

    private function checkIfUsernameValid(){
        if((preg_match("/^[a-zA-Z0-9]*$/", $this->username)) && ($this->username !== "")){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    private function checkIfEmailValid(){
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkIfPasswordsMatch(){
        if($this->pwd !== $this->pwd_repeat){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkIfDateValid(){
        $current_date = new DateTime();
        $entered_date = new DateTime($this->date_of_birth);
        if($entered_date > $current_date){
            return false;
        } else {
            return true;
        }
    }
    
    // Redundant
    static function createTryAgainButton(){
        echo '<form action="../index.php" method="post">';
        echo '<input type="submit" name="tryagain" value="Try again">';
        echo '</form>';
    }

    private function testSignUpInfo(){
        $error_count = 0;
        if(!($this->checkAllInputs())){
            $this->global_errors[] = "Not all input fields have been filled.";
            $error_count++;
        }
        if(!($this->checkIfUsernameValid())){
            $this->global_errors[] = "Invalid username.";
            $error_count++;
        }
        if(!($this->checkIfEmailValid())){
            $this->global_errors[] = "Invalid email.";
            $error_count++;
        }
        if($this->checkIfUserExists($this->username, $this->email)){
            $this->global_errors[] = "Existing username or email.";
            $error_count++;
        }
        if(!($this->checkIfPasswordsMatch())){
            $this->global_errors[] = "Passwords don't match.";
            $error_count++;
        }
        if(!($this->checkIfDateValid())){
            $this->global_errors[] = "Invalid date of birth.";
            $error_count++;
        }
        if($error_count != 0){
            return false;
        } else {
            return true;
        }
    }

    private function getGlobalErrors(){
        return $this->global_errors;
    }
}