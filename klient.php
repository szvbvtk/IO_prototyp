<?php 

session_start();

if(!isset($_SESSION['id_klienta'])){
    die("?");
}

$id_klienta = $_SESSION['id_klienta'];

?>


<!DOCTYPE html>
<html>
<head>
    <title>Zlecenie</title>
    <link rel="stylesheet" href="css/klient.css">
</head>
<body>
    <div class="formularz">
        <h1>Formularz zlecenia</h1>
        <form action="php/formularz.php" method="POST">
            <label for="model">Model samochodu:</label><br>
            <input type="text" id="model" name="model" required><br><br>

            <label for="typ">Typ samochodu:</label><br>
            <input type="text" id="typ" name="typ" required><br><br>

            <label for="opis">Opis:</label><br>
            <textarea id="opis" name="opis" rows="4" cols="50" required></textarea><br><br>

            <input type="submit" value="Wyślij zlecenie">
        </form>
    </div>

    <div class="oczekujace">
        <h2>Aktywne zlecenia</h2>
        <?php
        include 'php/db_connector.php';

        
        $result = $conn->query("SELECT * FROM zlecenia JOIN statusTyp ON zlecenia.status = statusTyp.idTypu WHERE zlecenia.idKlienta = $id_klienta AND zlecenia.status NOT IN (-1, 2); ");


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div style="border: 1px dashed green; padding: 5px; margin-bottom: 5px;">';
                echo "Model samochodu: " . $row['model'] . "<br>";
                echo "Typ samochodu: " . $row['typ'] . "<br>";
                echo "Opis: " . $row['opis'] . "<br>";
                echo "Status: " . $row['nazwa_statusu'];
                echo "</div>";
            }
        } else {
            echo "Brak oczekujących zleceń.";
        }

        $conn->close();
        ?>
    </div>

    <div class="historia">
        <h2>Historia zleceń</h2>
        <?php
        include 'php/db_connector.php';

        
        $result = $conn->query("SELECT * FROM zlecenia JOIN statusTyp ON zlecenia.status = statusTyp.idTypu WHERE zlecenia.idKlienta = $id_klienta AND zlecenia.status IN (-1, 2); ");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div style="border: 1px dashed green; padding: 5px; margin-bottom: 5px;">';
                echo "Model samochodu: " . $row['model'] . "<br>";
                echo "Typ samochodu: " . $row['typ'] . "<br>";
                echo "Opis: " . $row['opis'] . "<br>";
                echo "Status: " . $row['nazwa_statusu'];
                echo "</div>";
            }
        } else {
            echo "Brak zrealizowanych zleceń.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

