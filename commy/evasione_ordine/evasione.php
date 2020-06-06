<?php
if (isset($_POST['submit'])) {
    $codice_magazzino = $_POST['magazzino'];
    $vendita = $_POST['codice_vendita'];
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

// elenco ordini da evadere per magazzino
$sql = "SELECT * FROM vendite WHERE evaso = False and codice_magazzino = {$codice_magazzino}";

// Invia la query e ne salva il risultato 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // stampa degli ordini da evadere
        echo "codice vendita: " . $row["codice_vendita"]. " - codice farmaco: " . $row["codice_farmaco"]. " - descrizione: " . $row["descrizione"]."-tipo di servizio: ". $row["tipo"]."-costo: ". $row["costo"]."-numero tessera: ". $row["num_tessera"]."-codice deposito: ". $row["codice_deposito"]."-indirizzo spedizione: ". $row["indirizzo_vendita"]."-evasione ordine: ". $row["evaso"];
    }
} else {
echo "Nessun ordine da gestire";
}

// evasione di un ordine
// id ordine_da evadere recuperato dal form
$sql2 = "UPDATE vendite SET evaso = True WHERE codice_vendita={$codice_vendita}";
$res_vendita = $conn->query($sql2);

$conn->close();
?>