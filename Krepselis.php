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
$lentele3 = "atsiemimo_punktas";

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
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
    <table class="center" style="text-align:center;">
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
                <h1 style="color: #343a40">Užsisakyti įrankį</h1>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Kaina</th>
	                <th>Kiekis</th>
                    <th></th></tr>
                    <?php
                    $bendrakaina = 0;
                    while ($row = $result->fetch_assoc()) {
                        $bendrakaina = $bendrakaina + $row['kaina'] * $row['kiekis'];
                        echo "<form action=createOrder.php method=post>
                        <input type = 'hidden' id = 'id' name = 'id' value =" . $row['id'] . " readonly >
                        <tr>
                        <td>" . $row['pavadinimas'] . "</td>
                        <td>" . $row['kaina']. "</td>
                        <td><input type='number' id='kiekis' name='kiekis' value =".$row['kiekis']." min = 1  </td>
                        <td><input type='submit' name='ok' style ='border-color: #04AA6D' action = isKrepselio.php' value='Isimti is krepselio' class='btn'></td>
                        </tr>"
                        ;}
                        echo "
                        <tr></tr><tr>
                        <th>Krepšelio suma:</th>
                        <th>". $bendrakaina. "</th>
                        <th></th></tr>";    
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
                    <?php
                        $sql =  "SELECT * FROM $lentele3";

                        if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                    ?>
                </table> 
                    <div class="container" style="padding: 5%;">
                        

                                    <input type="hidden" id="postId" name="zmogus" value="<?php echo $tomp ?>" />
                                    <label class="form-label" for="form2Example1">Atsiemimo punktas:</label>
									<select class="form-select" name="adresas" aria-label="Default select example" required>
									<!-- <option selected>Paspauskite, kad pasirinktumėt miestą</option> -->
									<?php
									while ($row = $result->fetch_assoc()) {
									?>
									<option value=<?php echo  $row['id'] ?>><?php echo  $row['adresas'] ?></option>
									<?php
									}
									?>
									</select>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Atsiemimo laikas:</label>
                                    <input type="datetime-local" name="data_a" class="form-control" id="inputPassword4" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Gražinimo laikas:</label>
                                    <input type="datetime-local" name="data_b" class="form-control" id="inputAddress" required>
                                </div>
                            </div>
                            <button type="submit" name="update" value="Submit" class="btn btn-primary">Patvirtinti</button>
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



</body>

</html>