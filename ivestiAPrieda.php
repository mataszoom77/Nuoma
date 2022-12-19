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
	<title>>Gyvenk aktyviai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">

</head>
<body>
<table class="center">
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
    <h1 style="color: #343a40">Pridėti apsaugos priedą</h1>
<form method='post' action='irasytiAPrieda.php'>
  <div class="form-row" >
    <div class="form-group col-md-12">
      <label for="inputEmail4">Pavadinimas</label>
      <input type="text" name='pavadinimas' class="form-control" id="inputEmail4" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputPassword4">Dydis</label>
      <input type="text" name='dydis' class="form-control" id="inputPassword4" required>
    </div>
  
  
  <button type="submit" name='ok' value='patvirtinti' class="btn btn-primary">Patvirtinti</button>
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