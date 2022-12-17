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
    <link href="include/styles.css" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified JavaScript -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  </head>

<body>
<header>
    <div>
        <?php
        if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
        {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
            inisession("part");   //   pavalom prisijungimo etapo kintamuosius
            $_SESSION['prev'] = "index";
            include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
        }
        ?>
    </div>
</header>
<?php
    if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
          // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

        ?>
        <div class="container mt-5">
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-body">
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

          <a class="btn btn-info" href='/nuoma/useredit.php' role="button">Redaguoti paskyrą</a>
          <a class="btn btn-info" onclick="if(window.confirm('Ar tikrai istrinti?') == true){
                          href='/irankiuNuoma/deleteUser.php'
                          }" role="button">Ištrinti paskyrą</a>
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