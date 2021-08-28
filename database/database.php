<?php 
	$host = "localhost";
	$user = "root";
	$password = "";
	$dtb_name = "iot_thietke"; 
	$connection = mysqli_connect($host, $user, $password, $dtb_name) or die("lỗi kết nối");
	mysqli_set_charset($connection,"utf8");
?>