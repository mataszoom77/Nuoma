<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "atsiemimo_punktas";

$pavadinimas = $_POST["pavadinimas"];
$miestas = $_POST["miestas"];
$adresas = $_POST["adresas"];

include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql = "INSERT INTO $lentele (pavadinimas, miestas, adresas) 
             VALUES ( '$pavadinimas', '$miestas', '$adresas')";


if ($conn->query($sql) === TRUE) {
    header('Location: Parduotuves.php');
} else {
    echo "Error updating record: " . $conn->error;
  }
?>