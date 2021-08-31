<?php 
session_start();
setcookie('username','',time()+0);
session_destroy();
header('location: login.php');
 ?>