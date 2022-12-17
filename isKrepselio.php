<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "krepselis";
$lentele2 = "iranga";
$value = $_GET['key'];


include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql = "DELETE FROM $lentele WHERE id = '$value'";
$sql = "UPDATE $lentele2 SET kiekis = kiekis + $pridetasKiekis WHERE id = '$value'";

$conn->query($sql);
$conn->query($sql2);
header('Location: /irankiuNuoma');

?>