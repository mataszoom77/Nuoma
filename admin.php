<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/functions.php");
$_SESSION['prev'] = "admin";
date_default_timezone_set("Europe/Vilnius");
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
            include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
        }
		
		// cia sesijos kontrole
		if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])) {
			header("Location: logout.php");
			exit;
		}
        ?>
    </div>
</header>
	<table class="center">
		
	<form name="vartotojai" action="procadmin.php" method="post">
		<div class="container align-content-center">
		<table class="center" style=" width:100%; border:none;align-items:center;">

			<tr>
				<td width=30%>
					<?php
					if ($uregister != "self") echo "<a href=\"register.php\"><b>Registruoti naują vartotoją<b></a><td>";
					else echo "</td>";
					?>
			</tr>
		</table> <br>

		<?php

		$db_connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$sql_retrn_user = "SELECT username,userlevel,email,timestamp "
			. "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
		$result = mysqli_query($db_connection, $sql_retrn_user);
		if (!$result || (mysqli_num_rows($result) < 1)) {
			echo "Klaida skaitant lentelę users";
			exit;
		}
		?>
		<table class="center" border="1" cellspacing="0" cellpadding="3">
			<tr>
				<td><b>Vartotojo vardas</b></td>
				<td><b>Rolė</b></td>
				<td><b>E-paštas</b></td>
				<td><b>Paskutinį kartą aktyvus</b></td>
				<td><b>Šalinti?</b></td>
			</tr>
			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				$level = $row['userlevel'];
				$user = $row['username'];
				$email = $row['email'];
				$time = date("Y-m-d G:i", strtotime($row['timestamp']));
				echo "<tr><td>" . $user . "</td><td>";
				echo "<select name=\"role_" . $user . "\">";
				$yra = false;
				foreach ($user_roles as $x => $x_value) {
					echo "<option ";
					if ($x_value == $level) {
						$yra = true;
						echo "selected ";
					}
					echo "value=\"" . $x_value . "\" ";
					echo ">" . $x . "</option>";
				}
				if (!$yra) {
					echo "<option selected value=" . $level . ">Neegzistuoja=" . $level . "</option>";
				}
				$UZBLOKUOTAS = UZBLOKUOTAS;
				echo "<option ";
				if ($level == UZBLOKUOTAS) echo "selected ";
				echo "value=" . $UZBLOKUOTAS . " ";
				echo ">Užblokuotas</option>";      // papildoma opcija
				echo "</select></td>";

				echo "<td>" . $email . "</td><td>" . $time . "</td>";
				echo "<td><input type=\"checkbox\" name=\"naikinti_" . $user . "\">";
			}
			?>
		</table>
		<br>
		<div class="row d-flex justify-content-center align-content-center">
		<input class="btn btn-primary" type="submit" value="Vykdyti">	
		</div> 
		
		</div>
	</form>
	</td>
		</tr>
	</table> <br>
</body>

</html>