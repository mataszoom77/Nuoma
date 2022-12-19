<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "irankis";
$lentele2 = "modelis";
$lentele3 = "gamintojas";
$iranga = "iranga";
include("include/functions.php");

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $iranga";



if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$premission = false;
$isSvecias = true;

if(isset($_SESSION['ulevel'])){
    if(($_SESSION['ulevel'] == 9)){
        $premission = true;
    }
    if(($_SESSION['ulevel'] == 4)){
        $isSvecias = false;
    }
}
?>

<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gyvenk aktyviai</title>
    <link href="include/styles.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script type="text/javascript">
function confirmationDelete(anchor)
{
   var conf = confirm('Ar tikrai norite ištrinti įrangą?');
   if(conf)
   {
	   window.location=anchor.attr("href");
		alert("Įranga sėkmingai ištrinta");
   }
	alert("Įranga neištrinta");
}
</script>
	
</head>
<?php

                if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
                {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

                    inisession("part");   //   pavalom prisijungimo etapo kintamuosius
                    $_SESSION['prev'] = "index";

                    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
                ?>
                
                    <body>
                        <?php 
                        if(isset($_SESSION['ulevel'])){
                            if(($_SESSION['ulevel'] == 9) || ($_SESSION['ulevel'] == 4)){
                                ?>
                                <div class="relative__container mb-5">  
                                    <div class="full__width object__fit">
                                        <img src="include/images/fornt-page-cover.jpg" alt="background picture">
                                        <div class="absolute">
                                        <h1>Nusprendei, kad užteks sedėti ir nieko neveikti?</h1>
                                        <p>Išsirink norimą laisvalaikio įrangą ir nuobodžiauti tikrai neteks!</p>
                                        <!-- <a href="#iranga" class="button">IRANGA!</a> -->
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        
                        ?>
                        
                        <table class="center">
                            <tr>
                                <td>
<!-------------------------------------------------------------------------------------------------------------------------------- --> 
                    <div style="text-align: center;color:green">
                        <br><br>
                        <h1 id="iranga" style="color: #343a40">Įranga</h1>
                        <div class="container" >
                            <div class="row">
                                <?php
                                //cia jei neturi leidimo
                                while ($row = $result->fetch_assoc()) {
                                    if($row['prieinamumas'] != 0 || $row['prieinamumas'] != 1){
                                    ?>
                                        
                                        <div class="col-md-6 mt-3">
                                            <div class="card" style="background-color: #343a40; color: rgba(255,255,255,.5);">
                                                <div class="card-body">
                                                    <h5 class="card-title" style="color: white;"><?php echo  $row['pavadinimas'] ?></h5>
                                                    <h6 class="card-subtitle mb-2">Pavadinimas: <?php echo  $row['pavadinimas'] ?></h6>
                                                    <?php 
                                                    if($row['reguliuojamas_dydis']){
                                                        ?> 
                                                            <h6 class="card-subtitle mb-2">Reguliuojamas dydis: <?php echo  $row['reguliuojamas_dydis'] ?></h6>
                                                        <?php
                                                    }
                                                    ?>
                                                    <h6 class="card-subtitle mb-2">Spalva: <?php echo  $row['spalva'] ?></h6>

                                                    <?php
                                                        if($premission){
                                                    ?>  
                                                        <a style="color: white;" href="/irankiuNuoma/redaguoti.php?key=<?php echo $row['id']; ?> "class="card-link">Redaguoti</a>
														<a style="color: white;" href="perziureti.php?key=<?php echo $row['id']; ?> "class="card-link">Peržiūrėti</a>
                                                        <a style="color: white;" onclick='javascript:confirmationDelete($(this));return false;' href="/irankiuNuoma/delete.php?key=<?php echo $row['id']; ?> "class="card-link">Ištrinti</a>
                                                    <?php
                                                     }
                                                     if( !$isSvecias){
                                                        ?>  
                                                       <a style="color: white;" href="perziureti.php?key=<?php echo $row['id']; ?> "class="card-link">Peržiūrėti</a>
                                                        <a style="color: white;" href="/irankiuNuoma/iKrepseli.php?key=<?php echo $row['id']; ?> "class="card-link">I krepseli</a>
                                                    
                                                        
                                                    <?php
                                                     }
                                                    ?>  
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                                ?>
                                 
                                </div>
                            </div>
                        </div>
                        <br>
                        </body>

                        </html>
                    <?php
                } else {

                    if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
                    else {
                        if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                    }
                    ?> 
                    
                    <body class="login-bg">

                        <?php
                        // jei ankstesnis puslapis perdavė $_SESSION['message']
                        echo "<div align=\"center\">";
                        echo "<font size=\"4\" color=\"#ff0000\">" . $_SESSION['message'] . "<br></font>";
                    
                        echo "<table class=\"center\"><tr><td>";
                    
                        include("include/login.php");                    // prisijungimo forma
                        echo "</td></tr></table></div><br>";
                        ?>

                    </body>

                    </html>
                <?php
                }
                ?>
