<?php

if (isset($_POST['submit'])) {
    $tessera = $_POST["num_tes"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $codice_farmaco = $_POST["codice_farmaco"];
    $servizio = $_POST["servizio"];
    $qtà = $_POST["quantità"];
    $indirizzo = $_POST["indirizzo"];
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

// recupero il codice dell'ultima vendita
$sql1 = "SELECT MAX(codice) from vendita";

$result = $conn->query($sql1);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $ultima_vendita = $row['codice'];
    }
} else {
echo "Nessun risultato";
}
$nuovo_codice = $ultima_vendita + 1;


if ($servizio == 'Spedizione a casa') {
    // recupero magazzino
    $sql2 = "SELECT codice_magazzino FROM accoglie WHERE codice_farmaco = {$codice_farmaco}, quantità >= {$qtà} LIMIT 1";
    $mag_query = $conn->query($sql2);

    if ($mag_query->num_rows > 0) {
        while($row = $mag_query->fetch_assoc()) {
            $mag = $row['codice_magazzino'];
        }
    } else {
        echo "Farmaco non disponibile in nessun magazzino";
        exit;
    }
} else {
    $sql2 = "SELECT quantità FROM accoglie WHERE codice_magazzino = {$magazzino} and quantità >= {$qtà}";
    $mag_query = $conn->query($sql2);

    if ($mag_query->num_rows < 0) {
        echo "Farmaco richiesto non disponibile nel magazzino";
        exit;
    }
}

// costo ordine
$sql4 = "SELECT costo_unitario FROM farmaco WHERE codice = {$codice_farmaco}";
$costo_query = $conn->query($sql3);

if ($costo_query->num_rows > 0) {
    while($row = $costo_query -> fetch_assoc()) {
        $costo = $row["costo_unitario"] * $qtà;
    }
}

// magazzino 
if (isset($mag)) {
    $magazzino = $mag;
}


// creazione instanza vendita
$sql4 = "INSERT INTO vendita VALUES({$nuovo_codice}, {$cod_farmaco}, descrizione, {$servizio}, {$costo}, {$tessera}, {$mag}, {$indirizzo}, False)";
$vendita = $conn->query($sql4);

$conn->close();
?>