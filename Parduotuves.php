<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();


if ($_SESSION['user'] == "Svečias"){
    header("Location: logout.php");
	exit;
}


$server = "localhost";
$user = "root";
$password = "";
$dbname = "irankiunuoma";
$lentele = "atsiemimo_punktas";
include("include/functions.php");


$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn, "utf8"); // dėl lietuviškų raidžių

$sql =  "SELECT * FROM $lentele";

if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

$premission = false;
if(isset($_SESSION['ulevel'])){
    if(($_SESSION['ulevel'] == 9)){
        $premission = true;
    }
}

?>

<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Rezervacijos</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
</head>

<?php
if (!empty($_SESSION['user'])) //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
{ // Sesijoje nustatyti kintamieji su reiksmemis is DB
    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

    inisession("part"); //   pavalom prisijungimo etapo kintamuosius
    $_SESSION['prev'] = "index";

    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
}
?>

<div><h1>Parduotuvių sąrašas</h1></div>
<div class="w-50 p-3">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">pavadinimas</th>
      <th scope="col">miestas</th>
      <th scope="col">adresas</th>
      <?php if($premission){
          echo "<th scope='col'>Ištrinti</th>";
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
        $query_run = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $items) {
            ?>
            <tr>
            <th scope="row"><?php echo $items["id"]; ?></th>
            <td><?php echo $items["pavadinimas"]; ?></td>
            <td><?php echo $items["miestas"]; ?></td>
            <td><?php echo $items["adresas"]; ?></td>
            <?php
            if($premission){
                echo "<td>";
                ?>
                <a style="color: black;" onclick='javascript:confirmationDelete($(this));return false;' href="/irankiuNuoma/DeleteShop.php?key=<?php echo $items['id']; ?> "class="card-link">Ištrinti</a>
                <?php echo "</td>";
            }
            echo "</tr>";
        }
        }
        ?>
            <?php
            if($premission){
                echo "<tr>";
                ?>
                <td><a class=nav-link data-toggle=modal data-target=#exampleModal>Pridėti naują</a></td?
                <?php echo "</td>";
            }
            echo "</tr>";
            ?>
    
</tbody>

</table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Parduotuvės forma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-signin text-center for-signin" action="PridetiMiesta.php" method="post">
      <div class="checkbox mb-3">

      <div class="form-group row">
        <label for="Pavadinimas" class="col-sm-5 col-form-label">Pavadinimas: </label>
      <div class="col-sm-6">
      <input type="text" name="pavadinimas" class="form-control" required>
      </div>
      </div>

      <div class="form-group row">
        <label for="Miestas" class="col-sm-5 col-form-label">Miestas: </label>
      <div class="col-sm-6">
      <input type="text" name="miestas" class="form-control" required>
      </div>
      </div>

      <div class="form-group row">
        <label for="Adresas" class="col-sm-5 col-form-label">Adresas: </label>
      <div class="col-sm-6">
      <input type="text" name="adresas" class="form-control" required>
      </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
        <button class="btn btn-primary" type="submit" name="confirmBuy">Pirkti</button>
      </div>
      </form>

    </div>
  </div>
            </div>
</div>
<body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>