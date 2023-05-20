<?php 

session_start();

if(!isset($_SESSION['id_klienta'])){
    die("?");
}

$id_klienta = $_SESSION['id_klienta'];

?>