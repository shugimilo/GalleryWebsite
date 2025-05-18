<?php

class UploadContr extends Upload {
    private $file_name;
    private $title;
    private $file_description;
    private $user_id;
    private $original_file_name;
    private $file_extension;
    private $global_errors;

    public function __construct($file_name, $title, $file_description, $user_id) {
        $this->file_name = $file_name;
        $this->title = htmlspecialchars($title);
        $this->file_description = htmlspecialchars($file_description);
        $this->user_id = $user_id;
    }

    public function upload(){
        if(!($this->checkUploadInputs())){
            $_SESSION["errors"] = $this->getGlobalErrors();
            header("Location: ../errors/upload.error.php");
        }
        if(!($this->checkUploadFile())){
            $_SESSION["errors"] = $this->getGlobalErrors();
            header("Location: ../errors/upload.error.php");
        }
        if(!($this->tryToUpload())){
            $_SESSION["errors"] = $this->getGlobalErrors();
            header("Location: ../errors/upload.error.php");
        } else {
            if(isset($_SERVER['HTTP_REFERER'])) {
                header("Location: {$_SERVER['HTTP_REFERER']}");
            } else {
                header("Location: ../gallery.php");
            }
        }
    }

    private function checkIfFileNameEmpty(){
        if(empty($this->file_name)){
            $global_errors[] = "You must enter a file name.";
            return true;
        } else {
            return false;
        }
    }

    private function checkIfFileNameExists($file_name){
        if($this->checkFileName($file_name)){
            $global_errors[] = "File name already exists.";
            return true;
        } else {
            return false;
        }
    }

    private function checkIfTitleEmpty(){
        if(empty($this->title)){
            $global_errors[] = "You must enter a file title.";
            return true;
        } else {
            return false;
        }
    }

    private function getGlobalErrors(){
        return $this->global_errors;
    }

    private function checkIfFileUploaded(){
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $this->global_errors[] = "No file uploaded or an error occurred.";
            return false;
        } else {
            return true;
        }
    }

    private function getOriginalFileName(){
        $this->original_file_name = $_FILES["file"]["name"];
    }

    private function getExtension(){
        $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $this->file_extension = ".".$file_extension;
    }

    private function generatePath(){
        $this->getExtension();
        $sanitized_file_name = preg_replace("/[^a-zA-Z0-9-_]/", "", $this->file_name);
        $file_path = "../images/".$sanitized_file_name.$this->file_extension;
        return $file_path;
    }

    private function checkFileSize(){
        if($_FILES["file"]["size"] > 5 * 1024 * 1024){
            $this->global_errors[] = "Your image is too large. Please upload an image that is less than 5MB in size.";
            return false;
        } else {
            return true;
        }
    }

    private function checkFileFormat(){
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['file']['type'], $allowed_types)) {
            $this->global_errors[] = "Invalid file type. Please upload a JPEG, PNG or GIF.";
            return false;
        } else {
            return true;
        }
    }

    private function checkUploadInputs(){
        $error_count = 0;
        if($this->checkIfFileNameEmpty()){
            $error_count++;
        }
        if($this->checkIfFileNameExists($this->file_name)){
            $error_count++;
        }
        if($this->checkIfTitleEmpty()){
            $error_count++;
        }
        if($error_count != 0){
            return false;
        } else {
            return true;
        }
    }

    private function checkUploadFile(){
        $error_count = 0;
        if(!($this->checkIfFileUploaded())){
            $error_count++;
        }
        if(!($this->checkFileSize())){
            $error_count++;
        }
        if(!($this->checkFileFormat())){
            $error_count++;
        }
        if($error_count != 0){
            return false;
        } else {
            return true;
        }
    }

    private function tryToUpload(){
        $uploadPath = $this->generatePath();
        $this->global_errors[] = $_FILES["file"]["tmp_name"];
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
            $this->global_errors[] = "Failed to move the uploaded file.";
            return false;
        } else {
            $this->uploadImage($this->file_name, $this->title, $this->file_description, $this->user_id, $this->file_extension);
            return true;
        }
    }
}