<?php
session_start();
include("include/nustatymai.php");
include("include/functions.php");

if(($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])){
	header("Location: logout.php");
	exit;
}
date_default_timezone_set("Europe/Vilnius");
$server="localhost";
$user="root";
$password="";
$dbname="irankiunuoma";
$lentele="iranga";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
       $pavadinimas = htmlspecialchars($_POST['pavadinimas']);
       $kaina = htmlspecialchars($_POST['kaina']);
       $kiekis = htmlspecialchars($_POST['kiekis']);
       $prieinamumas = htmlspecialchars($_POST['prieinamumas']);
       $spalva = htmlspecialchars($_POST['spalva']);
	   
	   $svoris = htmlspecialchars($_POST['svoris']);
	   $dydis = htmlspecialchars($_POST['dydis']);
	   $ilgis = htmlspecialchars($_POST['ilgis']);
	   $nusidevejimas = htmlspecialchars($_POST['nusidevejimas']);
	   $prekes_zenklas = htmlspecialchars($_POST['prekes_zenklas']);
	   $pagaminimo_salis = htmlspecialchars($_POST['pagaminimo_salis']);
	   $reguliuojamas_dydis = htmlspecialchars($_POST['reguliuojamas_dydis']);
	   $maksimalus_greitis = htmlspecialchars($_POST['maksimalus_greitis']);
	   $maksimalus_nuvaziuojamas_atstumas = htmlspecialchars($_POST['maksimalus_nuvaziuojamas_atstumas']);
	   $akumuliatoriaus_talpa = htmlspecialchars($_POST['akumuliatoriaus_talpa']);
	   $ikrovimo_laikas = htmlspecialchars($_POST['ikrovimo_laikas']);
	   $stiprumas_pagrindine_asimi = htmlspecialchars($_POST['stiprumas_pagrindine_asimi']);
	   $stiprumas_pagalbine_asimi = htmlspecialchars($_POST['stiprumas_pagalbine_asimi']);
	   $stiprumas_atidarytais_vartais = htmlspecialchars($_POST['stiprumas_atidarytais_vartais']);
	   
       $kategorija =  htmlspecialchars($_POST['kategorija']);
       $apsaugospriedas =  htmlspecialchars($_POST['apsaugospriedas']);
       $prieziurospriedas =  htmlspecialchars($_POST['prieziurospriedas']);
      $sql = "INSERT INTO $lentele (pavadinimas, kaina, kiekis, prieinamumas, spalva, svoris, dydis, ilgis, nusidevejimas, prekes_zenklas, pagaminimo_salis, reguliuojamas_dydis, maksimalus_greitis, maksimalus_nuvaziuojamas_atstumas, akumuliatoriaus_talpa, ikrovimo_laikas, stiprumas_pagrindine_asimi, stiprumas_pagalbine_asimi, stiprumas_atidarytais_vartais, fk_kategorija, fk_apsaugospriedas, fk_prieziurospriedas) 
             VALUES ( '$pavadinimas', '$kaina', '$kiekis', '$prieinamumas', '$spalva', '$svoris', '$dydis', '$ilgis', '$nusidevejimas', '$prekes_zenklas', '$pagaminimo_salis', '$reguliuojamas_dydis', '$maksimalus_greitis', '$maksimalus_nuvaziuojamas_atstumas', '$akumuliatoriaus_talpa', '$ikrovimo_laikas', '$stiprumas_pagrindine_asimi', '$stiprumas_pagalbine_asimi', '$stiprumas_atidarytais_vartais', '$kategorija', '$apsaugospriedas', '$prieziurospriedas' )";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
		{header("Location:/irankiuNuoma");exit;} 
      //echo "Įrašyta";
}
$conn->close();
?>