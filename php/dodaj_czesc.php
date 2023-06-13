<?php 
include 'db_connector.php';

$idZlecenia = $_POST['idZlecenia'];
$idCzesci = $_POST['idCzesci'];

// echo $idZlecenia;
// echo $idCzesci;

$conn->query("INSERT INTO zlecenie_czesci VALUES ($idZlecenia, $idCzesci)");
$conn->close();
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");
exit();
?>