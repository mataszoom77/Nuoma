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

$sql = "INSERT INTO $lentele (id, kiekis) VALUES ( '$value', 1) ON DUPLICATE KEY UPDATE kiekis = kiekis + 1";
$sql2 = "UPDATE $lentele2 SET kiekis = kiekis - 1 WHERE id = '$value'";

$conn->query($sql);
$conn->query($sql2);
header('Location: /irankiuNuoma');

?>