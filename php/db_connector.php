<?php 

$serverName = 'localhost';
$dbUsername = '';
$dbPassword = '';
$dbName = '';

$conn = @new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
$conn->set_charset("utf8");

if($conn->connect_errno)
    die('Connection failed: ' . $conn->connect_error);

?>
