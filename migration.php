<?php

require_once './config/config.php';

/* Create connection */
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
/* Check connection*/
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
/* sql to create table */
$sql = "CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_identifier` varchar(150) NOT NULL,
  `name` varchar(50) NOT NULL,
  `engine_displacement` varchar(20) NOT NULL,
  `engine_power` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

if ($connection->query($sql) === TRUE) {
    echo "Table disburs created successfully";
}
 else {
    echo "Error creating table: " . $connection->error;
}
$connection->close();
?>