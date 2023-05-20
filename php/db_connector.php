<?php 

$serverName = 'localhost';
$dbUsername = 'mszfrelbst_admin';
$dbPassword = '7-mG_#X]Jp-vcHN5';
$dbName = 'mszfrelbst_asodeck';

$conn = @new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
$conn->set_charset("utf8");

if($conn->connect_errno)
    die('Connection failed: ' . $conn->connect_error);

?>