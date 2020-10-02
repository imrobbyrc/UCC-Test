<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

date_default_timezone_set('Asia/Jakarta');

if( !session_id() ) session_start();

require_once '../app/init.php';

$app = new App;

