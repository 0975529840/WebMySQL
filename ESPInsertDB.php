<?php
    require 'database.php';
    $ND=$_POST['ND'];
    $DA=$_POST['DA'];
    $BTcheck=$_POST["BTcheck"];
    if($connection->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $date = date("Y-m-d");
	$time = date("H:i:s");
    $sql="INSERT INTO sensor  (ND, DA, BTcheck,date,time) VALUES('".$ND."','".$DA."','".$BTcheck."') FROM sensor";
    if($connection->query($sql)){
        echo "Insert OK";
    }else{
        die("Insert Failed");
    }
    
    $connection->close();
?>