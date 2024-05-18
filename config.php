<?php

header('Content-Type: text/html; charset=utf-8');

$host="localhost";
$user="root";
$password="vertrigo";
$db="new_delivery";
$con=mysqli_connect($host,$user,$password,$db);

mysqli_query($con, "SET NAMES 'utf-8' ");
?>