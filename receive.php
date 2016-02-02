<?php

$servername = "localhost";
$port = 8889;
$username = "root";
$password = "root";
$db = "morse";

$DEBUG = 0;


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


if($DEBUG) echo "I got node:" . $node;


if($node){
  // Perform the fetch
  $table_name = "table_" . $node;

  $sql = "SELECT * FROM `$table_name` ORDER BY `id` LIMIT 1";

  $result = mysqli_query($conn, $sql);

  $number_of_rows = mysqli_num_rows($result);
  if($number_of_rows>0){
      while($row = mysqli_fetch_array($result)){
          $id=$row["id"];
          $instruct=$row["instruct"];
          $to=$row["to"];
          $end=$row["end"];


          echo "$instruct,$to,$end";
      }
  }else{
    if($DEBUG) echo "Could not find anything in the table";
    echo "noTableError,0,0";
  }

  //echo json_encode($e);
}else{
  $instruct="inputError";
  $to="0";
  $end="0";


  echo "$instruct,$to,$end";

}
$conn->close();

?>
