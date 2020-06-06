<?php
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
        echo "codice: " . $row["codice"]. " - descrizione: " . $row["descrizione"]. " - colonna3: " . $row["colonna3"];
    }
} else {
echo "Nessun ordine da gestire";
}

// evasione di un ordine


$conn->close();
?>