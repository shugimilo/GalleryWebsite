<?php

class Database {
    const host = "localhost";
    const user = "root";
    const password = "";
    const database_name = "project_test";
    protected $handle;

    protected function __construct(){
        $connection_string = "mysql:host=".self::host.";dbname=".self::database_name.";";
        try{
            $this->handle = new PDO($connection_string, Database::user, Database::password);
            $this->handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->handle->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
            die();
        }
    }
}