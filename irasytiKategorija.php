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
$lentele="kategorija";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
       $pavadinimas = htmlspecialchars($_POST['pavadinimas']);
       $naudojimas = htmlspecialchars($_POST['naudojimas']);
       $medziaga = htmlspecialchars($_POST['medziaga']);
       $skirta = htmlspecialchars($_POST['skirta']);
      $sql = "INSERT INTO $lentele (pavadinimas, naudojimas, medziaga, skirta) 
             VALUES ( '$pavadinimas', '$naudojimas', '$medziaga', '$skirta' )";
      if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
		{header("Location:/irankiuNuoma");exit;} 
      //echo "Įrašyta";
}
$conn->close();
?>