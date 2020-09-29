<?php
include './config/connection.php';

class Vehicle extends Connection{
    public function __construct(){
        $this->conn = $this->get_connection();
    }

    public function getData(){
        $query = "SELECT * FROM vehicles";
        $queryExe = $this->conn->query($query);
        $result = [];
        if($queryExe->num_rows > 0){
            while ($row = $queryExe->fetch_object()){
                $result[] = $row;
            }
        }
        return $result;
    }

    public function insertData($uniq,$name,$engine_displacement,$ngine_power,$price,$location,$now){
        $query = "INSERT INTO `vehicles` (`unique_identifier`, `name`, `engine_displacement`, `engine_power`, `price`, `location`, `created_at`) 
                VALUES ($uniq, $name, $engine_displacement, $ngine_power, $price, $location, $now);";
    }
}

