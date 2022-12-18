<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "iranga";

$pavadinimas = htmlspecialchars($_POST["pavadinimas"]);
$spalva = htmlspecialchars($_POST["spalva"]);
$svoris = htmlspecialchars($_POST["svoris"]);
$id = $_POST["id"];
include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "UPDATE $lentele SET pavadinimas = '$pavadinimas', spalva = '$spalva', svoris = '$svoris' WHERE id=$id";

$conn->query($sql);
header('Location: /index.php');

?>