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

// paramentri utente e creazione query
$tavola = "tavola";
$param_select = 'null';

$sql = "SELECT * FROM {$tavola} SELECT {$param_select}";

// Invia la query e ne salva il risultato 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// stampa il risultato riga per riga
while($row = $result->fetch_assoc()) {
    echo "colonna1: " . $row["colonna1"]. " - colonna2: " . $row["colonna2"]. " - colonna3: " . $row["colonna3"]. "<br>";
}
} else {
echo "Nessun risultato";
}
$conn->close();
?>