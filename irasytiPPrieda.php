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
$lentele="prieziurospriedas";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
       $pavadinimas = htmlspecialchars($_POST['pavadinimas']);
       $kiekis = htmlspecialchars($_POST['kiekis']);
	   $svoris = htmlspecialchars($_POST['svoris']);
      $sql = "INSERT INTO $lentele (pavadinimas, kiekis, svoris) 
             VALUES ( '$pavadinimas', '$kiekis' , '$svoris')";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
		{header("Location:/irankiuNuoma");exit;} 
      //echo "Įrašyta";
}
$conn->close();
?>