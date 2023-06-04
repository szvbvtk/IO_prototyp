<?php 

include 'db_connector.php';

session_start();
if(!isset($_SESSION['id_klienta'])){
    die("?");
}

$model = $_POST['model'];
$typ = $_POST['typ'];
$opis = $_POST['opis'];
$idKlienta = $_SESSION['id_klienta'];

$stmt = $conn->prepare("INSERT INTO zlecenia (model, typ, opis, idKlienta) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $model, $typ, $opis, $idKlienta);
$stmt->execute();

$conn->close();
?>