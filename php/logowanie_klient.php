<?php 

session_start();

$valid_username = "a";
$valid_password = "a";

if($_POST['username'] === $valid_username && $_POST['password'] === $valid_password){

    $_SESSION['client_logged_in'] = true;
    header("Location: ../klient.php");
    exit();

}else{
    header("Location: ../logowanie.html"); 
    exit();
}

?>