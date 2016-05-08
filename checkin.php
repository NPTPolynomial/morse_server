<?php

$servername = "localhost";
$port = 8889;
$username = "root";
$password = "root";
$db = "morse";

$DEBUG = 1;
$TIME_INTERVAL_FOR_NODES = '2';


// Create connection

$conn = new mysqli($servername, $username, $password, $db, $port);

if(isset($conn->connection_error)){
    die("Connection failed: " . $conn->connect_error);
}

// Gather the variables

if(isset($_GET["node"])){
    $node = $_GET["node"];
}else{
    $node = 0;
}


///Returns true if A (DateTime) and B (DateTime) are within time interval (String time). (ie, A has not expired yet.
///Example: $a = new DateTime('2016-05-05 03:44');
function isABWithInTime($a, $b, $hour_interval){
	
	$timeInterval = '+'.$hour_interval.' hours';
	$newdate = strtotime ( $timeInterval , strtotime ( $a->format('Y-m-d H:i') ) ) ;
	$newdate = date ( 'Y-m-d H:i' , $newdate );
	
	echo "Given time from fetch: " . $a->format('Y-m-d H:i')."<br />";
	echo "NOW time from fetch: " . $b->format('Y-m-d H:i')."<br />";
	echo "Given time from fetch (+2 Hrs): " . $newdate . "<br />";

	if( strtotime ($newdate) > strtotime($b->format('Y-m-d H:i'))){
		//echo "still within time<br />";
		return true;
	}else{
		//echo "past 2hrs already<br />";
		return false;
	}
}

////Inserts timestamp for specifided node
////RETURN: true if success, false if failed.
function insertAndUpdateTimestamp($node, $conn){
	
	echo "Doing time stamping<br />";
	
	$b = new DateTime('NOW');
	$timestamp = $b->format('Y-m-d H:i');
	
	$updateTimeStampQuery = "INSERT INTO `central_hub`(`node`, `timestamp`) VALUES ('$node','$timestamp') ON DUPLICATE KEY UPDATE `timestamp` = '$timestamp' ";
	$updateTimeStamp = mysqli_query($conn, $updateTimeStampQuery);
	
	if($updateTimeStamp){
		return true;
	}
	return false;
}


////returns the number of nodes still active. Except for the node that called this function.
function numberOfNodesStillActiveExceptFor($node, $conn){
	echo "Starting numberOfNodesStillActiveExceptFor<br />";
	$getTimeStampOfNodeQuery = "SELECT * FROM central_hub WHERE node != '$node' ";
	$getTimeStampOfNode = mysqli_query($conn, $getTimeStampOfNodeQuery);
	if($getTimeStampOfNode && mysqli_num_rows($getTimeStampOfNode) > 0){
		//echo "getting time stamp... <br />";
		
		
		
		$b = new DateTime('NOW');
		$returnNumber = 0;
		
		while($row = mysqli_fetch_array($getTimeStampOfNode)){
			echo "This is the row: " . $row['node'] . " ". $row['timestamp'] . "<br /><br />";
			$a = new DateTime($row['timestamp']);
			
			if(isABWithInTime($a, $b, '2')){
				echo "ACTIVE NODE! <br />";
				$returnNumber++;
			}
		}
		
		//if returnNumber and mysqli_num_rows == the same, then return A
		return $returnNumber;
	}else{
		//no nodes
		return 0;
	
	}
}


///inserts the new global variable into database, or updates if already exists
///RETURN: True if successful, and FALSE if failed. 
function setGlobalVar($var, $value, $conn){
	$setGlobalVarQuery = "INSERT INTO `central_global_vars` (`global_var`, `value`) VALUES ('$var','$value') ON DUPLICATE KEY UPDATE `value` = '$value' ";
	$setGlobalVar = mysqli_query($conn, $setGlobalVarQuery);
	if($setGlobalVar){
		return true;
	}else{
		return false;
	}
}



///RETURN: value of global variable, (-1) if could not be found.
function getGlobalVar($var, $conn){
	$getGlobalVarQuery = "SELECT * FROM `central_global_vars` WHERE `global_var` = '$var' ";
	$getGlobalVar = mysqli_query($conn, $getGlobalVarQuery);
	if($getGlobalVar){
		
		while($row = mysqli_fetch_array($getGlobalVar)){
			return $row['value'];
		}
		
	}else{
		return -1;
	}
}


//RETURN: total number of nodes in the global hub. (-1) if the command fails.
function getTotalNumberOfNodes($conn){
	$getTotalNumberOfNodesQuery = "SELECT COUNT(*) AS `count` FROM `central_hub`";
	$getTotalNumberOfNodes = mysqli_query($conn, $getTotalNumberOfNodes);
	if($getTotalNumberOfNodes){
		
		while($row = mysqli_fetch_array($getTotalNumberOfNodes)){
			return $row['count'];
		}
		
	}else{
		return -1;
	}
	
	
}


if($DEBUG) echo "I got node:" . $node. "<br />";

//Special Variables:
$existance = "I";
$level = 0;
$wentMissing = 0;



if($node){
	
	
	//check how many nodes are not expired (do not count this node)
	$numOfActiveNodes = numberOfNodesStillActiveExceptFor($node, $conn);
	echo "numOfActiveNodes (not counting myself): $numOfActiveNodes <br />";
	
	
	
	//check current timestamp on the node:
	echo "..................<br /><br />";
	echo "<b>Starting </b><br />";
	$getTimeStampOfNodeQuery = "SELECT * FROM central_hub WHERE node = '$node' ";
	$getTimeStampOfNode = mysqli_query($conn, $getTimeStampOfNodeQuery);
	if($getTimeStampOfNode && mysqli_num_rows($getTimeStampOfNode) > 0){
		echo "getting time stamp... <br />";
		
		while($row = mysqli_fetch_array($getTimeStampOfNode)){
			echo "This is the row: " . $row['node']  . " ".  $row['timestamp'] . "<br /><br />";
		}
		
	
	}else{
		//This means the node doesn't exist, must insert and update;
		if(insertAndUpdateTimestamp($node, $conn)){
			echo "successfully timestamped $node";
			$existance = "I";
		}else{
			echo "failed to time stamp...";
		}
		
	
	}
	
	//$node
	
	$a = new DateTime('2016-05-05 05:55');
	$b = new DateTime('NOW');
	
	if(isABWithInTime($a, $b, $TIME_INTERVAL_FOR_NODES)){
		echo "TRUE!";
	}else{
		echo "FALSE!";
	}
	
	
	
	
	////write function that returns I, W, A, or M given Node name
	
	
	
	
	////update global variable if necessary.
	
	
	////Insert, if already exists, update timestamp.
	
	
	
	
	
}
	
	
	
	
	
	
	
	
	
	
	
/*	
	
  // Perform the fetch
  $table_name = "table_" . $node;

  $sql = "SELECT * FROM `$table_name` ORDER BY `id` LIMIT 1";

  $result = mysqli_query($conn, $sql);

  $number_of_rows = mysqli_num_rows($result);
  if($number_of_rows>0){
      while($row = mysqli_fetch_array($result)){
          $id=$row["id"];
          $type=$row["type"];
          $from=$row["from"];
          $end=$row["end"];
		  $count=$row["count"];
		  $closeness= 0;
		  
		  // calculating closeness variable
		  // Return the number of bye end = 1 where 
		  
		  $sql_closeness = "SELECT * FROM `board` WHERE ((`from` = '$from' AND `to` = '$node') OR (`from` = '$node' AND `to` = '$from')) AND `type` = 'bye' AND `end` = '1'";
		  $closeness_result = mysqli_query($conn, $sql_closeness);
		  if($closeness_result){
		  	$closeness = mysqli_num_rows($closeness_result);
		  }

          echo "$type,$from,$end,$count,$closeness";
      }
  }else{
    if($DEBUG) echo "Could not find anything in the table";
    echo "noRowError,0,0,0,0";
  }

  //echo json_encode($e);
}else{
  $type="inputError";
  $from="0";
  $end="0";
  $count="0";
  $closeness="0";


  echo "$type,$from,$end,$count,$closeness";

}


*/


$conn->close();

?>
