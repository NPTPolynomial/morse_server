<?php
date_default_timezone_set("America/Vancouver");
require 'config.php';

class Node {

	public $name;
	public $group;
	
	public function __construct($nameGiven){
		$this->name = $nameGiven;
	}

	public function __toString(){
		return $this->name;
	}


}

///////////////////
// Local Variables

$node_color = "r";



// Gather the variables

if(isset($_GET["node"])){
    $node = new Node($_GET["node"]);
	
	
	if(isset($_GET["group"])){
	    $node->group = $_GET["group"];
	}else{
	    $node->group = 0;
		if($DEBUG) echo "No group set..";
	}
	
	
}else{
	$node = new Node(0);
	if($DEBUG) echo "No node set..";
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
	
	$aStr = $a->format('Y-m-d H:i:s');
	$bStr = $b->format('Y-m-d H:i:s');
	
	//echo "isABWithInTime: $aStr, $bStr, $hour_interval <br />";
	
	
	$timeInterval = $hour_interval;
	
	$newdate = strtotime ( $timeInterval , strtotime ( $a->format('Y-m-d H:i:s') ) ) ;
	$newdate = date ( 'Y-m-d H:i:s' , $newdate );
	
	//echo "Time + Interval = $newdate <br />";
	
	// echo "Given time from fetch: " . $a->format('Y-m-d H:i:s')."<br />";
// 	echo "NOW time from fetch: " . $b->format('Y-m-d H:i:s')."<br />";
// 	echo "Given time from fetch (+2 Hrs): " . $newdate . "<br />";

	if( strtotime ($newdate) > strtotime($b->format('Y-m-d H:i:s'))){
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
	$node_timestamp = $b->format('Y-m-d H:i:s');
	
	$updateTimeStampQuery = "INSERT INTO `central_hub`(`node`, `group`, `node_timestamp`) VALUES ('$node','$node->group','$node_timestamp') ON DUPLICATE KEY UPDATE `node_timestamp` = '$node_timestamp' ";
	$updateTimeStamp = mysqli_query($conn, $updateTimeStampQuery);
	
	if($updateTimeStamp){
		return true;
	}
	return false;
}


////returns the number of nodes still active. Except for the node that called this function.
function numberOfNodesStillActiveExceptFor($node, $conn, $hour_interval){
	//echo "Starting numberOfNodesStillActiveExceptFor Node: $node, Nodegroup: $node->group<br />";
	$group = $node->group;
	$getTimeStampOfNodeQuery = "SELECT * FROM `central_hub` WHERE `node` != '$node' AND `group` = '$group' ";
	$getTimeStampOfNode = mysqli_query($conn, $getTimeStampOfNodeQuery);
	if($getTimeStampOfNode && mysqli_num_rows($getTimeStampOfNode) > 0){
		
		$b = new DateTime('NOW');
		$returnNumber = 0;
		
		while($row = mysqli_fetch_array($getTimeStampOfNode)){
			//echo "Checking: " . $row['node'] . " for timestamp... ";
			$a = new DateTime($row['node_timestamp']);
			
			if(isABWithInTime($a, $b, $hour_interval)){
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
function setGlobalVar($var, $group, $value, $conn){
	//echo "setGlobalVar($var, $value).... <br />";
	$setGlobalVarQuery = "INSERT INTO `central_global_vars` (`global_var`, `value`, `group`) VALUES ('$var','$value', '$group') ON DUPLICATE KEY UPDATE `value` = '$value' ";
	$setGlobalVar = mysqli_query($conn, $setGlobalVarQuery);
	if($setGlobalVar){
		return true;
	}else{
		return false;
	}
}


///RETURN: value of global variable, (-1) if could not be found.
function getGlobalVar($var, $group, $conn){
	$getGlobalVarQuery = "SELECT * FROM `central_global_vars` WHERE `global_var` = '$var' AND `group` = '$group'";
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
	
	$getTimeStampOfNodeQuery = "SELECT * FROM `central_hub` WHERE `node` = '$node' AND `group` = '$node->group'";
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
function getTotalNumberOfNodes($group, $conn){
	//echo "getTotalNumberOfNodes.... <br />";
	$getTotalNumberOfNodesQuery = "SELECT COUNT(*) AS `count` FROM `central_hub` WHERE `group` = '$group'";
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
	$totalNumOfNodes = getTotalNumberOfNodes($node->group, $conn);
		//echo "totalNumOfNodes: $totalNumOfNodes <br />";
	
	
	
	//check how many nodes are not expired
	$numOfActiveNodes = numberOfNodesStillActiveExceptFor($node, $conn, $TIME_INTERVAL_FOR_NODES);
	$numOfActiveNodes = $numOfActiveNodes + 1;
		//echo "numOfActiveNodes (counting me): $numOfActiveNodes <br />";
	
	
	//get current gloval variables
	$currentLevel = getGlobalVar("level", $node->group, $conn);
	$currentMissing = getGlobalVar("missing", $node->group, $conn);
		//echo "Global Var: level: $currentLevel<br />";
		//echo "Global Var: missing: $currentMissing<br />";
	
	
	//if you are the first, or the only node active
	if(!(isset($numOfActiveNodes)) || $numOfActiveNodes == -1 || $numOfActiveNodes <= 1 || $numOfActiveNodes == null){
		setGlobalVar("level", $node->group, "0", $conn);
		setGlobalVar("missing", $node->group, "0", $conn);
		setGlobalVar("wifi_sig_low", $node->group, -55, $conn);
		setGlobalVar("wifi_sig_high", $node->group, -40, $conn);
		insertAndUpdateTimestamp($node, $conn);
		return "I,0,0";
	}
	
	
	//Level 0, and if all the nodes are active
	if($currentLevel == 0 && $numOfActiveNodes >= $totalNumOfNodes){
			
		//if all present, level up
		if($currentLevel == 0){
			setGlobalVar("level", $node->group, "1", $conn);
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
		setGlobalVar("missing", $node->group,  "1", $conn);
		setGlobalVar("level", $node->group,  "2", $conn);
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
		setGlobalVar("level", $node->group, "3", $conn);//strength level.
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
	$currentT = $currentTimeNow->format('Y-m-d H:i:s');
	
	$sendMessageToBoardQuery = "INSERT INTO `board` (`datetime`, `from`, `to`, `type`, `network`) VALUES ('$currentT','$node', 'ALL', '$returnMessage', '$node->group')";
	$sendMessageToBoard = mysqli_query($conn, $sendMessageToBoardQuery);
	if($sendMessageToBoard){
		return true;
	}else{
		return false;
	}
	
}


//Update min and max for the wifi signals record
function updateMinMaxWifiSignals($signal, $group, $conn){
	
	$wifi_sig_low = getGlobalVar("wifi_sig_low", $group, $conn);
	$wifi_sig_high = getGlobalVar("wifi_sig_high", $group, $conn);

	//if it is less than min, update the min
	if($signal < $wifi_sig_low){
		//update the min
		setGlobalVar("wifi_sig_low", $group, $signal, $conn);
		return "low";
	}
	
	
	
	//elseif it is more than the max
	if($signal > $wifi_sig_high){
		//update the max
		setGlobalVar("wifi_sig_high", $group, $signal, $conn);
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
if($DEBUG) echo "I got group:" . $node_group. "<br />";



if($node && $node->group){
	
	$currentTimeNow = new DateTime('NOW');
	
	//echo "NODE OBJ name: " . $node . "<br />";
	//echo "NODE OBJ group: " . $node->group . "<br />";
	// echo "currentTimeNow: " . $currentTimeNow->format('Y-m-d H:i:s') . "<br />";
	//
	// echo "string to time : " . strtotime ( $TIME_INTERVAL_FOR_NODES ) . "<br />";
	// echo "converted to date: " . date('Y-m-d H:i:s' , strtotime ( $TIME_INTERVAL_FOR_NODES ) ) . "<br />";
	
	$returnMessage = "";
	$returnMessage = getReturnMessageForNode($node, $conn, $TIME_INTERVAL_FOR_NODES);
	//echo $returnMessage;
	//echo "<br />";
	$returnMessage = messageToString($returnMessage) .",". updateMinMaxWifiSignals($wifi_sig,$node->group, $conn);
	echo $returnMessage;
	if(sendMessageToBoard($returnMessage, $currentTimeNow, $node, $conn)){
		//echo "<br />sent";
	}else{
		//echo "<br />notsent";
	}
	
	
	
}else{
	if($DEBUG) echo "no node, or no group...";
}

$conn->close();

?>
