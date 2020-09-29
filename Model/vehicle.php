<?php
include './config/conf.php';
class Vehicle extends Connection{
    public function __construct(){
        $this->conn = $this->get_connection();
    }

    public function getData(){
        $query = "select * from vehicles";
        $queryExe = $this->conn->query($query);
        $result = [];
        if($queryExe->num_rows > 0){
            while ($row = $queryExe->fetch_object()){
                $result[] = $row;
            }
        }
        return $result;

    }
}

