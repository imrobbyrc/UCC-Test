<?php

class Vehicle_Models extends Connection{
    private $table = 'vehicles';
    public function __construct(){
        $this->conn = $this->get_connection();
        $this->now = date("Y-m-d H:i:s");
    }

    public function getData(){
        $query = "SELECT * FROM $this->table";
        $queryExe = $this->conn->query($query);
        $result = [];
        if($queryExe->num_rows > 0){
            while ($row = $queryExe->fetch_object()){
                $result[] = $row;
            }
        }
        return $result;
    }

    public function findByUid($uid){

        $query = "SELECT count(id) FROM $this->table WHERE unique_identifier = '$uid'";

        $queryExe = $this->conn->query($query);
        $result = [];
        if($queryExe->num_rows > 0){
            while ($row = $queryExe->fetch_object()){
                $result[] = $row;
            }
        }
        return $result;
    }

    public function insertData($data){
        $query = "INSERT INTO $this->table (`unique_identifier`, `name`, `engine_displacement`, `engine_power`, `price`, `location`, `created_at`) 
                VALUES ('$data->unique_identifier', '$data->name', '$data->engine_displacement', '$data->engine_power', '$data->price', '$data->location', '$this->now');";
             
        $queryExe = $this->conn->query($query);
        return $queryExe == 1 ? 1 : 0;
    }
}

