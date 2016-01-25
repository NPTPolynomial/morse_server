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


if(isset($_GET["lastmessage_number"])){
    $last_message_num = $_GET["lastmessage_number"];
}else{

    $last_message_num = 0;
}

$sql = "SELECT * FROM board WHERE board_id > '$last_message_num'";

$result = $conn->query($sql);

$e = array();

if($result->num_rows >0){
    while($row = $result->fetch_assoc()){
  //      echo $row["board_id"].$row["message_id"].$row["from"].$row["to"].$row["message"];
        $e[]=$row;

        //$board_id = $row["board_id"];
        //$message_id  = $row["message_id"];
        //$from  = $row["from"];
        //$to  = $row["to"];
        //$message  = $row["message"];




//        $e = array( "board" => array('board_id' =>$board_id, 'message_id' =>$message_id, 'from'=>$from, 'to'=>$to, 'message'=>$message));

        //$e[$board_id]["board_id"]=$board_id;
        //$e[$board_id]["message_id"]=$message_id;

        //$e[$board_id]["from"]=$from;
        //$e[$board_id]["to"]=$to;
        //$e[$board_id]["message"]=$message;
        //echo json_encode($e);


    }

echo json_encode($e);


}


$conn->close();

?>
