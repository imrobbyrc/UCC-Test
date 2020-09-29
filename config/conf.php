<?php
date_default_timezone_set("Asia/Jakarta");

class Connection{

    public $host = "localhost";
    public $database = "ucc_test";
    public $username = "root";
    public $password = "";

    public function get_connection(){
        $connect = new mysqli($this->host, $this->username, $this->password, $this->database);
        return $connect;
}
} 