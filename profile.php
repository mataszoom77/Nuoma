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
$lentele = "prisijungimai";

include("include/functions.php");
$tomp = $_SESSION['userid'];
$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "users";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele WHERE userid = '$tomp'";
if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
$row = $result->fetch_assoc();

if ($_SESSION['user'] == "Svečias") {
  header("Location: logout.php");
  exit;
}

//Gauna lyti pagal FK
//----------------------------------------
//Gauti miesta pagal FK




?>

<html>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
  <title>Gyvenk aktyviai</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="include/styles.css" rel="stylesheet" type="text/css">
</head>

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

          <div class="container py-5">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-body">
                  <?php
                  if($_SESSION['ulevel'] && $_SESSION['ulevel'] == 9){
                      ?>
                      <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Pažymėjimo nr.:</p>
                      </div>
                      <div class="col-sm-9">
                        <p class=" mb-0"><?php echo  $row['pazymejimo_numeris'] ?></p>
                      </div>
                    </div>
                  <hr>
                      <?php
                  }
                  ?>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Pilnas vardas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class=" mb-0"><?php echo  $row['vardas'];
                          echo " ";
                          echo $row['pavarde']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">El. pastas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class=" mb-0"><?php echo $row['email']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Telefonas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="mb-0"><?php echo $row['telefonas']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Asmens kodas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class=" mb-0"><?php echo $row['asmens_kodas']; ?></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Adresas</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="mb-0"><?php echo $row['adresas']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <button type="button" onclick="location.href='/irankiuNuoma/useredit.php';" class="btn btn-primary">Redaguoti paskyra</button>
                <button type="button" onclick="location.href='/irankiuNuoma/deleteUser.php';" class="btn btn-primary">Istrinti paskyra</button> -->

            <a class="btn btn-info" href='/irankiuNuoma/useredit.php' role="button">Redaguoti paskyrą</a>
            <a class="btn btn-info" onclick="if(window.confirm('Ar tikrai istrinti?') == true){
                            href='/irankiuNuoma/deleteUser.php'
                            }else{ href='/irankiuNuoma/index.php'}" role="button">Ištrinti paskyrą</a>
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