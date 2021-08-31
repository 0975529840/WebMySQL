<?php
    require 'database/database.php';
    if($connection->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $sql="SELECT ND, DA, BTcheck,date FROM sensor";
    $response=array();
    $result=$connection->query($sql);
    if($result->num_rows>=0){
        while($row=$result->fetch_assoc()){
            $response['ND'] = $row['ND'];
			$response['DA'] = $row['DA'];
            $response['BTcheck']=$row['BTcheck'];
            $response['date']=$row['date'];
        }
        echo json_encode($response);
        $result->free();
    }
    else{
        echo "0 result";
    }
    $connection->close();
?>