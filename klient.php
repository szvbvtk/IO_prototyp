<?php 

session_start();

if(!isset($_SESSION['client_logged_in']) || $_SESSION['client_logged_in'] != true){
    exit("?");
}

?>