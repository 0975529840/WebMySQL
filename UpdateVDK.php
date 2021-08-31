<?php
    require 'database/database.php';
    $BTcheck=$_POST["BTcheck"];

    if($connection->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    if($BTcheck!=NULL){
        $sql=" UPDATE dieukhien SET BTcheck = '".$BTcheck."' where id = 1";
    }
    if($connection->query($sql)){
        echo "Update OK";
    }else{
        die("Update Failed");
    }
    
    $connection->close();
?>