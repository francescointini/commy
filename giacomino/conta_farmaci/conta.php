<?php
// controllo che i dati siano stati inviati dal form
if (isset( $_POST['submit'])) {
    $magazzino = $_POST['magazzino'];
}

// parametri di connessione al server MYSQL
$servername = "localhost";
// utente associato al db
$username = "username";
$password = "password";
// database interessato
$dbname = "myDB";

// Creazione di una connessione
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Se la query ritorna un valore non nullo l'autenticazione è riuscita => result != NULL
$sql = "SELECT codice_farmaco, quantità FROM Accogliere WHERE codice_magazzino = {$magazzino}";

// Invia la query e ne salva il risultato 
$result = $conn->query($sql);

// contatore valore
$cnt = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cod_farmaco = $row["codice_farmaco"];
        $qtà = $row["quantità"];
        $sql_qta = "SELECT costo_unitario FROM Farmaco WHERE codice = {$cod_farmaco}";
        // eseguo seconda query
        $in_res = $conn->query($sql_qtà);
        $in_row = $in_res -> fetch_assoc();
        // aumento il contatore
        $cnt = $cnt + ($in_row['costo_unitario'] * $qtà);
    }
    echo "Valore farmaci nel magazzino {$magazzino}: {$cnt} €";
} else {
    echo "Errore codice magazzino";
}

$conn->close();
?>