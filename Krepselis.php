<?php
session_start();
if (($_SESSION['ulevel'] != 4)) {
    header("Location: logout.php");
    exit;
}
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "iranga";
$lentele2 = "krepselis";

$tomp=$_SESSION['userid'];

include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele";
$sql = "SELECT * FROM $lentele INNER JOIN $lentele2 ON iranga.id = krepselis.id";

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Krepselis</title>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<style>
			.btn {
			  background-color: #04AA6D;
			  color: white;
			  padding: 12px;
			  margin: 10px 0;
			  border: none;
			  width: 100%;
			  border-radius: 3px;
			  cursor: pointer;
			  font-size: 17px;
			}

			.btn:hover {
			  background-color: #45a049;
			}
			table{
				border-collapse: colapse;
				font-family: Geneva;
			}
			th{
				background-color: #54585d;
				color: #ffffff;
			}
			td{
				padding: 15px;
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr{
				background-color: #f9fafb;
			}
			input{
				padding: 12px 20px;
				box-sizing: border-box;
				border: 2px solid #cccc;
				border-radius: 4px;
				background-color: #f8f8f8;
				resize:none;
			} 
		</style>



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
                <table style ='margin: 0px auto;' id = 'krepselisTable'>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Kaina</th>
	                <th>Kiekis</th>
                    <th></th></tr><tr>
                    <?php
                    $bendrakaina = 0;
                    while ($row = $result->fetch_assoc()) {
                        $bendrakaina = $bendrakaina + $row['kaina'] * $row['kiekis'];
                        echo "<form method='post'>
                        <input type = hidden id = id name = id value =" . $row['id'] . " readonly >
                        <tr>
                        <td>" . $row['pavadinimas'] . "</td>
                        <td>" . $row['kaina']. "</td>
                        <td><input type='number' id=kiekis name=kiekis value =".$row['kiekis']." min = 0  </td>
                        <td><input type='submit' name='ok' style ='border-color: #04AA6D' action = isKrepselio.php' value='Isimti is krepselio' class='btn'></td>
                        </tr></form>"
                        ;}
                        echo "<form method ='post' action ='order.php'>
                        <tr></tr><tr>
                        <th>Krepšelio suma:</th>
                        <th>". $bendrakaina. "</th>
                        <th></th>
                        <th><input type='submit' style ='border-color: #04AA6D' name='uzsakytiSHORTCUT' value='Uzsakyti prekes' class='btn'></th><th></th></tr></form>";    
                        if ($_POST != null) {
                            $id = $_POST['id'];
                            $pridetasKiekis = $_POST['kiekis'];
                            $sql = "DELETE FROM krepselis WHERE id = '$id'";
                            $conn->query($sql);
                            $sql2 = "SELECT * FROM iranga";
                            $sql2 = "UPDATE iranga SET kiekis = kiekis + $pridetasKiekis WHERE id = '$id'";
                            $conn->query($sql2);
                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                
                ?>
                </table> 

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