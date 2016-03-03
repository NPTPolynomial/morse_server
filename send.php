<?php

$servername = "localhost";
$port = 8889;
$username = "root";
$password = "root";
$db = "morse";

$DEBUG = 1;

//Create connection

$conn = new mysqli($servername, $username, $password, $db, $port);

if(isset($conn->connection_error)){
    die("Connection failed: " . $conn->connect_error);
}



// check if all parameters are present
if(isset($_GET['from']) && isset($_GET['to']) && isset($_GET['type']) && isset($_GET['dial_id']) && isset($_GET['count'])){
	$from = $_GET['from'];
	$to = $_GET['to'];
	$type = $_GET['type'];
	$dial_id = $_GET['dial_id'];
	$count = $_GET['count'];

	if(isset($_GET['end'])){
	$end = $_GET['end'];
	}else{
	$end = 0;
	}

	// get the right table to insert into
	$table_name = "table_" . $to;


	


	if(mysqli_error($conn)){
		if($DEBUG) echo "mySQL error" . ": " . mysqli_error($conn). "\n";
	
	}else{
		
		
		$duplicate_entry = false;
		// check for duplicated "hello" instructions from the same place.

			$check_duplicate = mysqli_query($conn, "SELECT * FROM `$table_name` WHERE `from` = '$from'");
			if(mysqli_num_rows($check_duplicate) < 1){
				$duplicate_entry = false;
			}else{
				$duplicate_entry = true;
			}
			
			//No hellos allowed after more than 2 exchanges.
			if($type == "hello" && $count > "2"){
				$duplicate_entry = true;
			}


		if(!$duplicate_entry){

			if(!($type == "bye" && $end == "1")){
				$sql = "INSERT INTO `$table_name` (`from`, `type`, `end`, `dial_id`, `count`) VALUES ('$from', '$type', '$end', '$dial_id', '$count'); ";
				$result = mysqli_query($conn, $sql);
				$bye_end_detected = 0;
			}else{
				if($DEBUG) echo "Bye End detected. Entry dropped on target. Still inserted in Board.";
				$bye_end_detected = 1;
				$result = 0;
			}
			if($result || ($bye_end_detected == 1) ){
				if($DEBUG) echo "Successfully inserted";

				// remove the last instruction that you did previously.
				$table_from_name = "table_" . $from;
				$sql_delete_top = mysqli_query($conn, "DELETE FROM `$table_from_name` ORDER BY `id` LIMIT 1");
				if($sql_delete_top){
					if($DEBUG) echo "Successfully Deleted Previous instruction";
					echo "OK";

					// insert into board
					
					// get time
					$utc_str = gmdate("Y-m-d H:i:s", time());
					$utc = strtotime($utc_str);
					
					
					$sql_insert_into_board = mysqli_query($conn, "INSERT INTO `board` (`datetime`, `board_id`, `from`, `to`, `type`, `dial_id`, `end`, `count`) VALUES ('$utc_str', NULL ,'$from', '$to', '$type', '$dial_id', '$end', '$count')");
					if($sql_insert_into_board){
					 	if($DEBUG) echo "Successfully ADDED TO BOARD";
					}else{
					 	if($DEBUG) echo "FAILED TO ADD TO BOARD";
						echo $conn->error;
					}

				}else{
					if($DEBUG) echo "Failed to Deleted Previous instruction";
				}


			}else{
				if($DEBUG) echo "Failed inserted";
			}
		}else{
			if($DEBUG) echo "Duplicate hello entry. Entry dropped.";
		}
	}


}else{
  if($DEBUG) echo "Missing parameters";
  echo "Missing parameters";

}

$conn->close();

?>
