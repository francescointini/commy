<?php
// controllo che i dati siano stati inviati dal form
if (isset( $_POST['submit'])) {
    $username_dip = $_POST['username'];
    $password_dip = $_POST['password'];
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
$sql = "SELECT id FROM dipendente WHERE nome = {$username_dip}, password = {$password_dip}";

// Invia la query e ne salva il risultato 
$result = $conn->query($sql);

if (!result) {
    echo "Loggin fallito";
} else {
    echo "Login risuscito\n Benvenuto {$username}";
}

$conn->close();
?>