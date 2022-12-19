<?php 
session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "iranga";

$pavadinimas = htmlspecialchars($_POST["pavadinimas"]);
$kaina = htmlspecialchars($_POST["kaina"]);
$kiekis = htmlspecialchars($_POST["kiekis"]);
$prieinamumas = htmlspecialchars($_POST["prieinamumas"]);



$spalva = htmlspecialchars($_POST["spalva"]);
$svoris = htmlspecialchars($_POST["svoris"]);
$dydis = htmlspecialchars($_POST["dydis"]);
$ilgis = htmlspecialchars($_POST["ilgis"]);
$nusidevejimas = htmlspecialchars($_POST["nusidevejimas"]);
$prekes_zenklas = htmlspecialchars($_POST["prekes_zenklas"]);
$pagaminimo_salis = htmlspecialchars($_POST["pagaminimo_salis"]);
$reguliuojamas_dydis = htmlspecialchars($_POST["reguliuojamas_dydis"]);
$maksimalus_greitis = htmlspecialchars($_POST["maksimalus_greitis"]);
$maksimalus_nuvaziuojamas_atstumas = htmlspecialchars($_POST["maksimalus_nuvaziuojamas_atstumas"]);
$akumuliatoriaus_talpa = htmlspecialchars($_POST["akumuliatoriaus_talpa"]);
$ikrovimo_laikas = htmlspecialchars($_POST["ikrovimo_laikas"]);
$stiprumas_pagrindine_asimi = htmlspecialchars($_POST["stiprumas_pagrindine_asimi"]);
$stiprumas_pagalbine_asimi = htmlspecialchars($_POST["stiprumas_pagalbine_asimi"]);
$stiprumas_atidarytais_vartais = htmlspecialchars($_POST["stiprumas_atidarytais_vartais"]);


$id = $_POST["id"];
include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "UPDATE $lentele SET pavadinimas = '$pavadinimas', kaina = '$kaina', kiekis = '$kiekis', prieinamumas = '$prieinamumas', spalva = '$spalva', svoris = '$svoris', dydis = '$dydis', ilgis = '$ilgis', nusidevejimas = '$nusidevejimas', prekes_zenklas = '$prekes_zenklas', pagaminimo_salis = '$pagaminimo_salis', reguliuojamas_dydis = '$reguliuojamas_dydis', maksimalus_greitis = '$maksimalus_greitis', maksimalus_nuvaziuojamas_atstumas = '$maksimalus_nuvaziuojamas_atstumas', akumuliatoriaus_talpa = '$akumuliatoriaus_talpa', ikrovimo_laikas = '$ikrovimo_laikas', stiprumas_pagrindine_asimi = '$stiprumas_pagrindine_asimi', stiprumas_pagalbine_asimi = '$stiprumas_pagalbine_asimi', stiprumas_atidarytais_vartais = '$stiprumas_atidarytais_vartais' WHERE id=$id";

$conn->query($sql);
header('Location: index.php');

?>