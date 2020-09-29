<?php
include './Model/vehicle.php';
$vehicle = new Vehicle();
$data = $vehicle->getData();
print_r($data);
?>