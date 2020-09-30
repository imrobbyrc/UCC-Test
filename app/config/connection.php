<?php

class Connection{

    private $host = DB_HOST;
    private $database = DB_NAME;
    private $username =DB_USER;
    private $password = DB_PASS;

    public function get_connection(){
        $connect = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }

        return $connect;
}
} 