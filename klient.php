<?php 

session_start();

if(!isset($_SESSION['id_klienta'])){
    exit("?");
}

echo $_SESSION['id_klienta'];

?>