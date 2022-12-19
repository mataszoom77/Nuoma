<?php
session_start();
if (($_SESSION['ulevel'] != 9)) {
    header("Location: logout.php");
    exit;
}
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

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Demo projektas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script type="text/javascript">
function confirmationDelete(anchor)
{	   
	alert("Įranga sėkmingai paredaguota");

}
</script>
	
	
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
                    <div class="container" style="padding: 5%;">
                        <h1 style="color: #343a40">Redaguoti įrangą</h1>
                        <form action=update.php method=post>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Pavadinimas</label>
                                    <input type="text" name="pavadinimas" class="form-control" id="inputEmail4" value="<?php echo $row['pavadinimas'] ?> " required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Kaina</label>
                                    <input type="text" name="kaina" value="<?php echo $row['kaina'] ?>" class="form-control" id="inputPassword4" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Kiekis</label>
                                    <input type="text" name="kiekis" value="<?php echo $row['kiekis'] ?>" class="form-control" id="inputAddress" required>
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Prieinamumas</label>
                                    <input type="text" name="prieinamumas" value="<?php echo $row['prieinamumas'] ?>" class="form-control" id="inputPassword4" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Spalva</label>
                                    <input type="text" name="spalva" value="<?php echo $row['spalva'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Svoris</label>
                                    <input type="text" name="svoris" value="<?php echo $row['svoris'] ?>" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Dydis</label>
                                    <input type="text" name="dydis" value="<?php echo $row['dydis'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Ilgis</label>
                                    <input type="text" name="ilgis" value="<?php echo $row['ilgis'] ?>" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Nusidevėjimas</label>
                                    <input type="text" name="nusidevejimas" value="<?php echo $row['nusidevejimas'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Prekės ženklas</label>
                                    <input type="text" name="prekes_zenklas" value="<?php echo $row['prekes_zenklas'] ?>" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Pagaminimo šalis</label>
                                    <input type="text" name="pagaminimo_salis" value="<?php echo $row['pagaminimo_salis'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Reguliuojamas dydis</label>
                                    <input type="text" name="reguliuojamas_dydis" value="<?php echo $row['reguliuojamas_dydis'] ?>" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Maksimalus greitis</label>
                                    <input type="text" name="maksimalus_greitis" value="<?php echo $row['maksimalus_greitis'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Maksimalus nuvažiuojamas atstumas</label>
                                    <input type="text" name="maksimalus_nuvaziuojamas_atstumas" value="<?php echo $row['maksimalus_nuvaziuojamas_atstumas'] ?>" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Akumuliatoriaus talpa</label>
                                    <input type="text" name="akumuliatoriaus_talpa" value="<?php echo $row['akumuliatoriaus_talpa'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Įkrovimo laikas</label>
                                    <input type="text" name="ikrovimo_laikas" value="<?php echo $row['ikrovimo_laikas'] ?>" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Stiprumas pagrindine ašimi</label>
                                    <input type="text" name="stiprumas_pagrindine_asimi" value="<?php echo $row['stiprumas_pagrindine_asimi'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
							
							<div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Stiprumas pagalbine ašimi</label>
                                    <input type="text" name="stiprumas_pagalbine_asimi" value="<?php echo $row['stiprumas_pagalbine_asimi'] ?>" class="form-control" id="inputPassword4">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress">Stiprumas atidarytais vartais</label>
                                    <input type="text" name="stiprumas_atidarytais_vartais" value="<?php echo $row['stiprumas_atidarytais_vartais'] ?>" class="form-control" id="inputAddress">
                                </div>
                            </div>
                            
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <button type="submit" onclick='javascript:confirmationDelete($(this));' name="update" value="Submit" class="btn btn-primary">Patvirtinti</button>
                        </form>
                        <!-- <?php
                                //echo "<br><br><a href=\"index.php\"><b>Grįžti į meniu<b></a>";
                                ?> -->
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