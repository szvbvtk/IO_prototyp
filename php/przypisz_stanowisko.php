<?php 
include 'db_connector.php';

if (isset($_POST['stanowisko']) && isset($_POST['id_zlecenia'])) {
    $id_stanowiska = $_POST['stanowisko'];
    $id_zlecenia = $_POST['id_zlecenia'];
    echo $id_zlecenia;
    $conn->query("UPDATE zlecenia SET idStanowiska = $id_stanowiska WHERE idZlecenia = $id_zlecenia");
}else{
    die("Błąd");
}

$conn->close();

$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");
exit();
?>