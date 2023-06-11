<?php 

if(!isset($_POST['haslo']) || !isset($_POST['nazwa_uzytkownika'])){
    header("Location: ../logowanie_pracownik.html"); 
    exit();
}else{
    $nazwa_uzytkownika = $_POST['nazwa_uzytkownika'];
    $haslo = $_POST['haslo'];
}

session_start();

include 'db_connector.php';

$stmt = $conn->prepare("SELECT idPracownika, haslo FROM pracownicy WHERE nazwa = ?");
$stmt->bind_param("s", $_POST['nazwa_uzytkownika']);
$stmt->execute();
$stmt->store_result();


if($stmt->num_rows === 1){

    $stmt->bind_result($id_pracownika, $haslo_z_bazy);
    $stmt->fetch();

    if(strcmp($haslo, $haslo_z_bazy) !== 0)
        die("Złe hasło");
    else{
        $_SESSION['id_pracownika'] = $id_pracownika;

        header("Location: ../pracownik.php");
        exit();
    }



}else
    die("Złe dane");

$conn->close();

?>