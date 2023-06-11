<?php 

session_start();

if(!isset($_SESSION['id_pracownika'])){
    die("?");
}

$id_pracownika = $_SESSION['id_pracownika'];

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
        <h1>Dodaj część do zlecenia</h1>

        <form method="POST" action="php/dodaj_czesc.php">
            <label for="idZlecenia">ID zlecenia:</label>
            <select name="idZlecenia" id="idZlecenia">
                <?php
                include 'php/db_connector.php';

                $result = $conn->query("SELECT idZlecenia FROM zlecenia WHERE status = 1");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["idZlecenia"] . "'>" . $row["idZlecenia"] . "</option>";
                    }
                } else {
                    echo "<option disabled value=''>Brak</option>";
                }

                $conn->close();
                ?>
            </select>
            <br>
            <label for="idCzesci">ID części:</label>
            <select name="idCzesci" id="idCzesci">
                <?php

                include 'php/db_connector.php';

                $sql = "SELECT idCzesci, nazwa FROM magazyn";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["idCzesci"] . "'>" . $row["nazwa"] . "</option>";
                    }
                } else {
                    echo "<option disabled value=''>Brak</option>";
                }

                $conn->close();
                ?>
            </select>
            <br>
            <input type="submit" value="Dodaj część do zlecenia">
        </form>
    </div>

    <div class="oczekujace">
        <h2>Nowe zlecenia</h2>
        <?php
        include 'php/db_connector.php';

        
        $result = $conn->query("SELECT * FROM zlecenia WHERE status = 0");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div style="border: 1px dashed green; padding: 5px; margin-bottom: 5px;">';
                echo "Model samochodu: " . $row['model'] . "<br>";
                echo "Typ samochodu: " . $row['typ'] . "<br>";
                echo "Opis: " . $row['opis'];
                echo "<form method='POST' action='php/akceptuj_zlecenie.php'><input type='hidden' name='id_zlecenia' value='" . $row['idZlecenia'] . "'><input type='submit' value='Akceptuj zlecenie'></form>";
                echo "</div>";
            }
        } else {
            echo "Brak oczekujących zleceń.";
        }

        $conn->close();
        ?>
    </div>

    <div class="historia">
    <h2>Przyjęte zlecenia</h2>
        <?php
        include 'php/db_connector.php';

        
        $result = $conn->query("SELECT * FROM zlecenia WHERE status = 1");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div style="border: 1px dashed green; padding: 5px; margin-bottom: 5px;">';
                echo "Id zlecenia: " . $row['idZlecenia'] . "<br>";
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
</body>
</html>
