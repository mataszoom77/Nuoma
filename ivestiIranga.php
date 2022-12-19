<?php
session_start();

//include("include/nustatymai.php");
include("include/functions.php");

// if(($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])){
// 	header("Location: logout.php");
// 	exit;
// }
if(($_SESSION['ulevel'] != 9)){
	header("Location: logout.php");
	exit;
}


$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "kategorija";
$lentele2 = "apsaugospriedas";
$lentele3 = "prieziurospriedas";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele";

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);


$sql2 =  "SELECT * FROM $lentele2";

if (!$result2 = $conn->query($sql2)) die("Negaliu nuskaityti: " . $conn->error);

$sql3 =  "SELECT * FROM $lentele3";

if (!$result3 = $conn->query($sql3)) die("Negaliu nuskaityti: " . $conn->error);

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Sistema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script type="text/javascript">
function confirmationDelete(anchor)
{	   
	alert("Įranga sėkmingai pridėta");

}
</script>
	

</head>
<body>
<table class="center">
        <tr>
            <td>
                <center><img src="include/top2.png" width="1047" height="200"></center>
            </td>
        </tr>
        <tr>
            <td>
                <?php

                if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
                {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

                    inisession("part");   //   pavalom prisijungimo etapo kintamuosius
                    $_SESSION['prev'] = "index";

                    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
                ?>
    <div class="container" style="padding: 5%;">
    <h1 style="color: #343a40">Pridėti įrangą</h1>
<form method='post' action='irasytiIranga.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Įrankio pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Kaina</label>
      <input type="text" name='kaina' class="form-control" id="inputPassword4" required>
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Kiekis</label>
    <input type="text" name='kiekis' class="form-control" id="inputAddress" required>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Prieinamumas</label>
      <input type="text" name='prieinamumas' class="form-control" id="inputPassword4" required>
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Spalva</label>
    <input type="text" name='spalva' class="form-control" id="inputAddress">
  </div>
  </div>
  
  
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Svoris</label>
      <input type="text" name='svoris' class="form-control" id="inputPassword4">
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Dydis</label>
    <input type="text" name='dydis' class="form-control" id="inputAddress">
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Ilgis</label>
      <input type="text" name='ilgis' class="form-control" id="inputPassword4">
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Nusidevejimas</label>
    <input type="text" name='nusidevejimas' class="form-control" id="inputAddress">
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Prekės ženklas</label>
      <input type="text" name='prekes_zenklas' class="form-control" id="inputPassword4">
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Pagaminimo šalis</label>
    <input type="text" name='pagaminimo_salis' class="form-control" id="inputAddress">
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Reguliuojamas dydis</label>
      <input type="text" name='reguliuojamas_dydis' class="form-control" id="inputPassword4">
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Maksimalus greitis</label>
    <input type="text" name='maksimalus_greitis' class="form-control" id="inputAddress">
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Maksimalus nuvažiuojamas atstumas</label>
      <input type="text" name='maksimalus_nuvaziuojamas_atstumas' class="form-control" id="inputPassword4">
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Akumuliatoriaus talpa</label>
    <input type="text" name='akumuliatoriaus_talpa' class="form-control" id="inputAddress">
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Įkrovimo laikas</label>
      <input type="text" name='ikrovimo_laikas' class="form-control" id="inputPassword4">
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Stiprumas pagrindine ašimi</label>
    <input type="text" name='stiprumas_pagrindine_asimi' class="form-control" id="inputAddress">
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Stiprumas pagalbine ašimi</label>
      <input type="text" name='stiprumas_pagalbine_asimi' class="form-control" id="inputPassword4">
    </div>
  
  <div class="form-group col-md-12">
    <label for="inputAddress">Stiprumas atidarytais vartais</label>
    <input type="text" name='stiprumas_atidarytais_vartais' class="form-control" id="inputAddress">
  </div>
  </div>
  
  

    <label class="form-label" for="form2Example1">Kategorija:</label>          
    <select class="form-select" name="kategorija" aria-label="Default select example">
    <option selected>Paspauskite, kad pasirinktumėt kategoriją</option>
    <?php
    while ($row = $result->fetch_assoc()) {
    ?>
    <option value=<?php echo  $row['id'] ?>><?php echo  $row['pavadinimas'] ?></option>
    <?php
    }
    ?>
    </select>              

    <label class="form-label" for="form2Example1">Apsaugos priedas:</label>
    <select class="form-select" name="apsaugospriedas" aria-label="Default select example">
    <option selected>Paspauskite, kad pasirinktumėt apsaugos priedą</option>
    <?php
    while ($row2 = $result2->fetch_assoc()) {
    ?>
    <option value=<?php echo  $row2['id'] ?>><?php echo  $row2['pavadinimas'] ?></option>
    <?php
    }
    ?>
    </select>


    <label class="form-label" for="form2Example1">Prieziuros priedas:</label>
    <select class="form-select" name="prieziurospriedas" aria-label="Default select example">
    <option selected>Paspauskite, kad pasirinktumėt priežiūros priedą</option>
    <?php
    while ($row3 = $result3->fetch_assoc()) {
    ?>
    <option value=<?php echo  $row3['id'] ?>><?php echo  $row3['pavadinimas'] ?></option>
    <?php
    }
    ?>
    </select>
  <button type="submit" name='ok' onclick='javascript:confirmationDelete($(this));' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
</form>
    </div>

<?php
                } else {

                    if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
                    else {
                        if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                    }
                    // jei ankstesnis puslapis perdavė $_SESSION['message']
                    echo "<div align=\"center\">";
                    echo "<font size=\"4\" color=\"#ff0000\">" . $_SESSION['message'] . "<br></font>";

                    echo "<table class=\"center\"><tr><td>";
                    include("include/login.php");                    // prisijungimo forma
                    echo "</td></tr></table></div><br>";
                }
                    ?>
</body>
</html>