<?php
ob_start();

$servername = "localhost";
$port = 8889;
$username = "root";
$password = "root";
$db = "morse";

$DEBUG = 1;
$errors = 0;

//Create connection

$conn = new mysqli($servername, $username, $password, $db, $port);

if(isset($conn->connection_error)){
    die("Connection failed: " . $conn->connect_error);
}

$tables_to_drop = array("board", "table_a", "table_b");

foreach($tables_to_drop as $table){
	$query = "TRUNCATE TABLE " . $table;
	if(mysqli_query($conn, $query)){
		echo "Truncated: " + $table;
	}else{
		$errors += 1;
	}

}


if($errors ==0){
	/* Redirect browser */
    $redirect_link = "Location: angulartest.php";
	header($redirect_link);
	
	echo "<a href='angulartest.php'>Go to Board</a>";
	 
	/* Make sure that code below does not get executed when we redirect. */
	$conn->close();
	exit;
}


?>