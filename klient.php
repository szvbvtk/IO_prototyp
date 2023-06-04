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
    <style>
        body {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }

        .formularz {
            grid-column: 1 / 2;
        }

        .oczekujace {
            grid-column: 2 / 3;
        }

        .historia {
            grid-column: 3 / 4;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="submit"] {
            display: block;
            margin-top: 10px;
        }
        div{
            border: 1px solid black;
        }
    </style>
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
        <h2>Oczekujące zlecenia</h2>
        <?php
        include 'php/db_connector.php';

        
        $result = $conn->query("SELECT * FROM zlecenia WHERE idKlienta = $id_klienta AND status = 0");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div style="border: 1px dashed green; padding: 5px; margin-bottom: 5px;">';
                echo "Model samochodu: " . $row['model'] . "<br>";
                echo "Typ samochodu: " . $row['typ'] . "<br>";
                echo "Opis: " . $row['opis'];
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
        ji
    </div>
</body>
</html>

