<?php
///////////////////////////
// Morse Config File

date_default_timezone_set("America/Vancouver");

$servername = "localhost";
$port = 8889;
$username = "root";
$password = "Morse!23";
$db = "morse";

$DEBUG = 0;

//'+'.$hour_interval.' hours'
$TIME_INTERVAL_FOR_NODES = '+2 minutes';



// Create connection

$conn = new mysqli($servername, $username, $password, $db, $port);

if(isset($conn->connection_error)){
    die("Connection failed: " . $conn->connect_error);
}




?>