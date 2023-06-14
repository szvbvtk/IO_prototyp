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
    <script src="js/jquery_3.7.0.js"></script>
    <title>Zlecenie</title>
    <link rel="stylesheet" href="css/pracownik.css">
</head>
<body>
<button id="pokazFormularz">Pokaż formularz</button>
  
  <div id="formularzStanowisko">
    <h2>Formularz</h2>
    <form action="php/dodaj_stanowisko.php" method="POST">
      <label for="nazwa">Nazwa stanowiska:</label>
      <input type="text" id="nazwa" name="nazwa" required>
      <label for="typ">Typ stanowiska:</label>
      <select id="typ" name="typ" required>
        <?php 
        include 'php/db_connector.php';
        $result = $conn->query("SELECT * FROM typStanowiska");
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['idTypuStanowiska'] . '">' . $row['nazwa'] . '</option>';
        }
        ?>
      </select>
      
      <label for="opis">Opis:</label>
      <textarea id="opis" name="opis" required></textarea>
      
      <button type="submit">Utwórz stanowisko</button>
    </form>
  </div>
  <script src="js/stanowiskoForm.js"></script>

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
                echo "<form method='POST' action='php/odrzuc_zlecenie.php'><input type='hidden' name='id_zlecenia' value='" . $row['idZlecenia'] . "'><input type='submit' value='Odrzuć zlecenie'></form>";
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
                
                $result2 = $conn->query("SELECT * FROM stanowiska");
                if ($result2->num_rows > 0) {
                    echo '<form method="POST" action="php/przypisz_stanowisko.php">';
                    echo '<input type="hidden" name="id_zlecenia" value="' . $row['idZlecenia'] . '">';
                    echo '<select name="stanowisko">';
                    while ($row2 = $result2->fetch_assoc()) {
                        echo '<option value="' . $row2['idStanowiska'] . '">' . $row2['nazwa'] . '</option>';
                    }
                    echo '</select>';
                    echo '<input type="submit" value="Przypisz stanowisko">';
                    echo '</form>';
                }
                echo "<form method='POST' action='php/zakoncz_zlecenie.php'><input type='hidden' name='id_zlecenia' value='" . $row['idZlecenia'] . "'><input type='submit' value='Zakończ zlecenie'></form>";
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
