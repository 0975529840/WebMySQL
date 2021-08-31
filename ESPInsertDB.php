<?php
    require 'database/database.php';
    $ND=$_POST['ND'];
    $DA=$_POST['DA'];
    $BTcheck=$_POST["BTcheck"];
    if($connection->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $date = date("Y-m-d H:M:s");
    $time = date("H:i:s");
    $sql="INSERT INTO sensor (ND, DA, BTcheck,date) VALUES ('".$ND."','".$DA."','".$BTcheck."','".$date."')";
    if($connection->query($sql)){
        echo "Insert OK";
    }else{
        die("Insert Failed");
    }
    
    $connection->close();
?>