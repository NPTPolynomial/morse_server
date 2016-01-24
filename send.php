<?php

$servername = "localhost";
$port = 8889;
$username = "root";
$password = "root";
$db = "morse";

//Create connection

$conn = new mysqli($servername, $username, $password, $db, $port);

if(isset($conn->connection_error)){
    die("Connection failed: " . $conn->connect_error);
}




if(isset($_GET['send'])){
	$new_message =$_GET['send']; 
	
	$sql = "UPDATE ran SET message = '$new_message' WHERE ran_id = 1";
	
	$result = $conn->query($sql);

}



?>