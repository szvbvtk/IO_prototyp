<?php 
include 'db_connector.php';

$nazwa = $_POST['nazwa'];
$typ = $_POST['typ'];
$opis = $_POST['opis'];
  
echo "$nazwa $typ $opis";
$conn->query("INSERT INTO stanowiska (nazwa, typ, opis) VALUES ($nazwa, $typ, $opis)");
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");
exit();
?>