<?php
session_start();

$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "iranga";

$value = $_GET['key'];

include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele WHERE id = $value";

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row = $result->fetch_assoc()
?>
<html>

<style>

#entity-container {
  width: 50%;
  margin: 0 auto;
  text-align: center;
}

#entity-container h2 {
  font-size: 1.5em;
  margin-bottom: 0.5em;
}

#entity-container table {
  width: 100%;
  border-collapse: collapse;
}

#entity-container th,
#entity-container td {
  border: 1px solid #ccc;
  padding: 0.5em;
}

#entity-container th {
  background-color: #ddd;
}
</style>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Demo projektas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
</head>

<body>



    <table class="center" style="text-align:center;">
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
                    <div id="entity-container">
  <h2>Įrangos peržiūra</h2>
  <table>
    <tr>
      <th>Atributas</th>
      <th>Reikšmė</th>
    </tr>
    <tr>
      <td>Pavadinimas</td>
      <td><?php echo $row['pavadinimas']; ?></td>
    </tr>
    <tr>
      <td>Kaina</td>
      <td><?php echo $row['kaina']; ?></td>
    </tr>
    <tr>
      <td>Kiekis</td>
      <td><?php echo $row['kiekis']; ?></td>
    </tr>
	
	
	<?php 
	  if($row['spalva']){
		  ?>
		  <tr>
      <td>Spalva</td>
      <td><?php echo $row['spalva']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['svoris'] > 0 && $row['svoris']){
		  ?>
		  <tr>
      <td>Svoris</td>
      <td><?php echo $row['svoris']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['dydis'] > 0 && $row['dydis']){
		  ?>
		  <tr>
      <td>Dydis</td>
      <td><?php echo $row['dydis']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['ilgis'] > 0 && $row['ilgis']){
		  ?>
		  <tr>
      <td>Ilgis</td>
      <td><?php echo $row['ilgis']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	
	<?php 
	  if($row['nusidevejimas']){
		  ?>
		  <tr>
      <td>Nusidevėjimas</td>
      <td><?php echo $row['nusidevejimas']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['prekes_zenklas']){
		  ?>
		  <tr>
      <td>Prekės ženklas</td>
      <td><?php echo $row['prekes_zenklas']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['pagaminimo_salis']){
		  ?>
		  <tr>
      <td>Pagaminimo šalis</td>
      <td><?php echo $row['pagaminimo_salis']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['reguliuojamas_dydis'] > 0 && $row['reguliuojamas_dydis']){
		  ?>
		  <tr>
      <td>Reguliuojamas dydis</td>
      <td><?php echo $row['reguliuojamas_dydis']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['maksimalus_greitis'] > 0 && $row['maksimalus_greitis']){
		  ?>
		  <tr>
      <td>Maksimalus greitis</td>
      <td><?php echo $row['maksimalus_greitis']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['maksimalus_nuvaziuojamas_atstumas'] > 0 && $row['maksimalus_nuvaziuojamas_atstumas']){
		  ?>
		  <tr>
      <td>Maksimalus nuvažiuojamas atstumas</td>
      <td><?php echo $row['maksimalus_nuvaziuojamas_atstumas']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['akumuliatoriaus_talpa'] > 0 && $row['akumuliatoriaus_talpa']){
		  ?>
		  <tr>
      <td>Akumuliatoriaus talpa</td>
      <td><?php echo $row['akumuliatoriaus_talpa']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['ikrovimo_laikas']){
		  ?>
		  <tr>
      <td>Įkrovimo laikas</td>
      <td><?php echo $row['ikrovimo_laikas']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['stiprumas_pagrindine_asimi'] > 0 && $row['stiprumas_pagrindine_asimi']){
		  ?>
		  <tr>
      <td>Stiprumas pagrindine ašimi</td>
      <td><?php echo $row['stiprumas_pagrindine_asimi']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['stiprumas_pagalbine_asimi'] > 0 && $row['stiprumas_pagalbine_asimi']){
		  ?>
		  <tr>
      <td>Stiprumas pagalbine ašimi</td>
      <td><?php echo $row['stiprumas_pagalbine_asimi']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	<?php 
	  if($row['stiprumas_atidarytais_vartais'] > 0 && $row['stiprumas_atidarytais_vartais']){
		  ?>
		  <tr>
      <td>Stiprumas atidarytais vartais</td>
      <td><?php echo $row['stiprumas_atidarytais_vartais']; ?></td>
    </tr>
	<?php
	  }
	  ?>
	
	
  </table>
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
                <!-- <form action=update.php method=post>
    <input type="text" name="Pavadinimas" value="<?php echo $row['Pavadinimas'] ?>">
    <input type="text" name="bukle" value="<?php echo $row['bukle'] ?>">
    <input type="datetime-local" name="tipas" value="<?php echo $row['tipas'] ?>">
    <input type="datetime-local" name="kalse" value="<?php echo $row['kalse'] ?>">
    <input type="text" name="kaina" value="<?php echo $row['kaina'] ?>">
    <textarea name='Aprasymas'><?php echo $row['Aprasymas'] ?></textarea>
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    <a href="update.php"><input type="submit" name="update" value="Submit"></a>
</form> -->



</body>

</html>