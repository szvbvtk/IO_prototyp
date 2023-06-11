<?php 
include 'db_connector.php';

$id_zlecenia = $_POST['id_zlecenia'];
echo $id_zlecenia;
if($conn->query("UPDATE zlecenia SET status = 1 WHERE idZlecenia = $id_zlecenia"))
    echo "Zlecenie zostało zaakceptowane.";
    
?>