<?php

require 'config.php';

// Gather the variables

if(isset($_GET["node"])){
    $node = $_GET["node"];
	if($node == "a"){
		$node_color = "R";
	}else if($node == "b"){
		$node_color = "B";
	}else if($node == "c"){
		$node_color = "Y";
	}
		
}else{
    $node = 0;
}

//wifi 20max, 40min
if(isset($_GET["wifi_sig"])){
    $wifi_sig = $_GET["wifi_sig"];
}else{
    $wifi_sig = -30;
}

///Returns true if A (DateTime) and B (DateTime) are within time interval (String time). (ie, A has not expired yet.
///Example1: $a = new DateTime('2016-05-05 03:44');
///
///Example2:
// $a = new DateTime('2016-05-05 05:55');
// $b = new DateTime('NOW');
//
// if(isABWithInTime($a, $b, $TIME_INTERVAL_FOR_NODES)){
// 	echo "TRUE!";
// }else{
// 	echo "FALSE!";
// }
function isABWithInTime($a, $b, $hour_interval){
	
	$aStr = $a->format('Y-m-d H:i');
	$bStr = $b->format('Y-m-d H:i');
	
	//echo "isABWithInTime: $aStr, $bStr, $hour_interval <br />";
	
	
	$timeInterval = '+'.$hour_interval.' hours';
	$newdate = strtotime ( $timeInterval , strtotime ( $a->format('Y-m-d H:i') ) ) ;
	$newdate = date ( 'Y-m-d H:i' , $newdate );
	
	//echo "Given time from fetch: " . $a->format('Y-m-d H:i')."<br />";
	//echo "NOW time from fetch: " . $b->format('Y-m-d H:i')."<br />";
	//echo "Given time from fetch (+2 Hrs): " . $newdate . "<br />";

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
	
	//echo "Doing time stamping for $node<br />";
	
	$b = new DateTime('NOW');
	$node_timestamp = $b->format('Y-m-d H:i');
	
	$updateTimeStampQuery = "INSERT INTO `central_hub`(`node`, `node_timestamp`) VALUES ('$node','$node_timestamp') ON DUPLICATE KEY UPDATE `node_timestamp` = '$node_timestamp' ";
	$updateTimeStamp = mysqli_query($conn, $updateTimeStampQuery);
	
	if($updateTimeStamp){
		return true;
	}
	return false;
}


////returns the number of nodes still active. Except for the node that called this function.
function numberOfNodesStillActiveExceptFor($node, $conn){
	//echo "Starting numberOfNodesStillActiveExceptFor<br />";
	$getTimeStampOfNodeQuery = "SELECT * FROM central_hub WHERE node != '$node' ";
	$getTimeStampOfNode = mysqli_query($conn, $getTimeStampOfNodeQuery);
	if($getTimeStampOfNode && mysqli_num_rows($getTimeStampOfNode) > 0){
		
		$b = new DateTime('NOW');
		$returnNumber = 0;
		
		while($row = mysqli_fetch_array($getTimeStampOfNode)){
			//echo "Checking: " . $row['node'] . " for timestamp... ";
			$a = new DateTime($row['node_timestamp']);
			
			if(isABWithInTime($a, $b, '2')){
				//echo "ACTIVE NODE! <br />";
				$returnNumber++;
			}else{
				//echo "not active... <br />";
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
	//echo "setGlobalVar($var, $value).... <br />";
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


//get current timestamp of the node
//RETURNS: timestamp of node, or (-1) if node is not found.
function getCurrentTimestampForNode($node, $conn){
	//echo "getCurrentTimestampForNode($node).... <br />";
	
	$getTimeStampOfNodeQuery = "SELECT * FROM central_hub WHERE node = '$node' ";
	$getTimeStampOfNode = mysqli_query($conn, $getTimeStampOfNodeQuery);
	if($getTimeStampOfNode && mysqli_num_rows($getTimeStampOfNode) > 0){
		//echo "getting time stamp... <br />";
		
		while($row = mysqli_fetch_array($getTimeStampOfNode)){
			//echo "This is the row: " . $row['node']  . " ".  $row['node_timestamp'] . "<br /><br />";
			return $row['node_timestamp'];
		}	
	
	}else{
		return -1;
	}
}


//RETURN: total number of nodes in the global hub. (-1) if the command fails.
function getTotalNumberOfNodes($conn){
	//echo "getTotalNumberOfNodes.... <br />";
	$getTotalNumberOfNodesQuery = "SELECT COUNT(*) AS `count` FROM `central_hub`";
	$getTotalNumberOfNodes = mysqli_query($conn, $getTotalNumberOfNodesQuery);
	if($getTotalNumberOfNodes){
		
		while($row = mysqli_fetch_array($getTotalNumberOfNodes)){
			return $row['count'];
		}
		
	}else{
		return -1;
	}
	
	
}

//RETURN: True if the node is the missing node, else false.
function getAmIMissingNode($node, $conn, $hour_interval){
	//echo "getAmIMissingNode? $node<br />";
	
	$nodeCurrentTimestamp = getCurrentTimestampForNode($node, $conn);
	if($nodeCurrentTimestamp != -1){
		$nodeCurrentTimestamp = new DateTime($nodeCurrentTimestamp);
	
		$b = new DateTime('NOW');
		if(isABWithInTime($nodeCurrentTimestamp, $b, $hour_interval)){
			return false;
		}else{
			return true;
		}
	}

}



////function that returns I, W, A, or M given Node name
////RETURN string, I(W or A or M), level# , missing 
function getReturnMessageForNode($node, $conn, $TIME_INTERVAL_FOR_NODES){
	
	//get total number of nodes ever checked-in
	$totalNumOfNodes = getTotalNumberOfNodes($conn);
		//echo "totalNumOfNodes: $totalNumOfNodes <br />";
	
	
	
	//check how many nodes are not expired
	$numOfActiveNodes = numberOfNodesStillActiveExceptFor($node, $conn);
	$numOfActiveNodes = $numOfActiveNodes + 1;
		//echo "numOfActiveNodes (counting me): $numOfActiveNodes <br />";
	
	
	//get current gloval variables
	$currentLevel = getGlobalVar("level", $conn);
	$currentMissing = getGlobalVar("missing", $conn);
		//echo "Global Var: level: $currentLevel<br />";
		//echo "Global Var: missing: $currentMissing<br />";
	
	
	//if you are the first, or the only node active
	if(!(isset($numOfActiveNodes)) || $numOfActiveNodes == -1 || $numOfActiveNodes <= 1 || $numOfActiveNodes == null){
		setGlobalVar("level", "0", $conn);
		setGlobalVar("missing", "0", $conn);
		setGlobalVar("wifi_sig_low", -55, $conn);
		setGlobalVar("wifi_sig_high", -40, $conn);
		insertAndUpdateTimestamp($node, $conn);
		return "I,0,0";
	}
	
	
	//Level 0, and if all the nodes are active
	if($currentLevel == 0 && $numOfActiveNodes >= $totalNumOfNodes){
			
		//if all present, level up
		if($currentLevel == 0){
			setGlobalVar("level", "1", $conn);
			insertAndUpdateTimestamp($node, $conn);
			return "A,1,$currentMissing";
		}
	}
	
	//Level 1, and if all nodes are active
	if($currentLevel == 1 && $numOfActiveNodes >= $totalNumOfNodes){
	
		// //if at level 1, all present, but no one went missing yet
// 		if($currentMissing == 0){
//
// 			//if that node comes back, then send them a M, else send a W for every else.
// 			if(getAmIMissingNode($node, $conn, $TIME_INTERVAL_FOR_NODES)){
// 				setGlobalVar("missing", "1", $conn);
// 				insertAndUpdateTimestamp($node, $conn);
// 				return "M,$currentLevel,1";
// 			}else{
// 				//echo "failed missing node test <br />";
//
// 				insertAndUpdateTimestamp($node, $conn);
// 				return "A,$currentLevel,$currentMissing";
// 			}
//
// 		}
//
// 		//if at level 1, all present, someone went missing already
// 		elseif($currentMissing == 1){
// 			setGlobalVar("level", "2", $conn);
// 			insertAndUpdateTimestamp($node, $conn);
// 			return "A,2,$currentMissing";
// 		}


		insertAndUpdateTimestamp($node, $conn);
		return "A,$currentLevel,$currentMissing";
	
		
	}
	
	//if at level 0, and if more than 1 node is active
	if($numOfActiveNodes > 1 && $currentLevel == 0){
		insertAndUpdateTimestamp($node, $conn);
		return "W,$currentLevel,$currentMissing";
	}
	
	
	//if more than 1 node is active, and level is 1, that means someone is missing.
	if($numOfActiveNodes > 1 && $currentLevel == 1){
		
		
		// //if that node comes back, then send them a M, else send a W for every else.
// 		if(getAmIMissingNode($node, $conn, $TIME_INTERVAL_FOR_NODES)){
// 			setGlobalVar("missing", "1", $conn);
// 			insertAndUpdateTimestamp($node, $conn);
// 			return "M,$currentLevel,1";
// 		}else{
// 			//echo "failed missing node test2 <br />";
//
// 			insertAndUpdateTimestamp($node, $conn);
// 			return "W,$currentLevel,$currentMissing";
// 		}


		//NEW STUFF
		//A node has gone missing, set global missing variable to 1
		setGlobalVar("missing", "1", $conn);
		setGlobalVar("level", "2", $conn);
		insertAndUpdateTimestamp($node, $conn);
		
		return "S,$currentLevel,$currentMissing";
		


		
	}
	
	// //if all nodes are active, and level is 2, that means ... (to be decided) temp: what else is there?
	// if($currentLevel == 2 && $numOfActiveNodes >= $totalNumOfNodes){
	// 	insertAndUpdateTimestamp($node, $conn);
	// 	return "A,$currentLevel,$currentMissing";
	// }
	
	//if more than 1 node is active, and level is 2, that means ... Report strength and go to level 3.
	if($currentLevel == 2 && $numOfActiveNodes > 1){
		setGlobalVar("level", "3", $conn);//strength level.
		insertAndUpdateTimestamp($node, $conn);
		return "T,$currentLevel,$currentMissing";
	}
	
	
	//if more than 1 node is active, and level is 2, that means ... Report strength and go to level 3.
	if($currentLevel == 3 && $numOfActiveNodes > 1){
		//setGlobalVar("level", "4", $conn);//strength level.
		insertAndUpdateTimestamp($node, $conn);
		return "N,$currentLevel,$currentMissing";
	}
	

}

//Returns a concatenated english string version in front of the coded string.
function messageToString($codeMsg){
	$returnString = "";
	
	if($codeMsg == "I,0,0"){
		$returnString = "i exists,".$codeMsg;
	}elseif($codeMsg == "W,0,0"){
		$returnString = "we exists,".$codeMsg;
	}elseif($codeMsg == "W,1,0"){
		$returnString = "where did you go,".$codeMsg;
	}elseif($codeMsg == "W,1,1"){
		$returnString = "where did you go,".$codeMsg;
	}elseif($codeMsg == "W,2,1"){
		$returnString = "we all exist, what else is there,".$codeMsg;
	}elseif($codeMsg == "A,0,0"){
		$returnString = "we all exist,".$codeMsg;
	}elseif($codeMsg == "A,1,0"){
		$returnString = "we all exist,".$codeMsg;
	}elseif($codeMsg == "A,2,0"){
		$returnString = "we all exist what else is there,".$codeMsg;
	}elseif($codeMsg == "A,2,1"){
		$returnString = "we all exist what else is there,".$codeMsg;
	}elseif($codeMsg == "S,1,0"){
		$returnString = "search,".$codeMsg;
	}elseif($codeMsg == "T,2,0"){
		$returnString = "strength,".$codeMsg;
	}elseif($codeMsg == "T,2,1"){
		$returnString = "strength,".$codeMsg;
	}elseif($codeMsg == "N,3,0"){
		$returnString = "network,".$codeMsg;
	}elseif($codeMsg == "N,3,1"){
		$returnString = "network,".$codeMsg;
	}else{
		$returnString = "????,".$codeMsg;
	}
	//S,1,0
	//T,2,1
	//N,3,1
	return $returnString;
}


//SENDS returnmessage to the autoupdating board
function sendMessageToBoard($returnMessage, $currentTimeNow, $node, $conn){
	
	//echo "setGlobalVar($var, $value).... <br />";
	$currentT = $currentTimeNow->format('Y-m-d H:i');
	
	$sendMessageToBoardQuery = "INSERT INTO `board` (`datetime`, `from`, `to`, `type`, `network`) VALUES ('$currentT','$node', 'ALL', '$returnMessage', 3)";
	$sendMessageToBoard = mysqli_query($conn, $sendMessageToBoardQuery);
	if($sendMessageToBoard){
		return true;
	}else{
		return false;
	}
	
}


//Update min and max for the wifi signals record
function updateMinMaxWifiSignals($signal, $conn){
	
	$wifi_sig_low = getGlobalVar("wifi_sig_low", $conn);
	$wifi_sig_high = getGlobalVar("wifi_sig_high", $conn);

	//if it is less than min, update the min
	if($signal < $wifi_sig_low){
		//update the min
		setGlobalVar("wifi_sig_low", $signal, $conn);
		return "low";
	}
	
	
	
	//elseif it is more than the max
	if($signal > $wifi_sig_high){
		//update the max
		setGlobalVar("wifi_sig_high", $signal, $conn);
		return "high";
	}
	
	
	$difference = abs($wifi_sig_high - $wifi_sig_low);
	$difference_slots = $difference/3;
	
	if($signal <= ($wifi_sig_low + $difference_slots)){
		return "low";
	}
	
	if($signal >= $wifi_sig_low + $difference_slots && $signal < $wifi_sig_low + 2*$difference_slots){
		return "med";
	}
	
	if($signal >= $wifi_sig_low + 2*$difference_slots){
		return "high";
	}else{
		
		
		//is not in any region. so just say "low";
		return "med";
	}

}

if($DEBUG) echo "I got node:" . $node. "<br />";


if($node){
	
	$currentTimeNow = new DateTime('NOW');
	//echo "currentTimeNow: " . $currentTimeNow->format('Y-m-d H:i') . "<br />";
	$returnMessage = "";
	$returnMessage = getReturnMessageForNode($node, $conn, $TIME_INTERVAL_FOR_NODES);
	//echo $returnMessage;
	//echo "<br />";
	$returnMessage = messageToString($returnMessage) .",". updateMinMaxWifiSignals($wifi_sig, $conn);
	echo $returnMessage;
	sendMessageToBoard($returnMessage, $currentTimeNow, $node, $conn);
	
	
}

$conn->close();

?>
