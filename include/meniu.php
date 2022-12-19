<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) {
   header("Location: logout.php");
   exit;
}
include("include/nustatymai.php");
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = ""; {
   foreach ($user_roles as $x => $x_value) {
      if ($x_value == $userlevel) $role = $x;
   }
}

echo "<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">";
echo "<div class=\"collapse navbar-collapse\" id=\"navbarText\">";
echo  "<ul class=\"navbar-nav mr-auto\">";
echo "<a class=\"nav-link\" href=\"index.php\">Pagrindinis</a>";
if ($_SESSION['user'] != "Svečias") {
?>
   <html>
            <li class="nav-item">
               <a class="nav-link"href="orderHistory.php">Užsakymų istorija</a>
            </li>
            <li class="nav-item">
               <a class="nav-link"H href="profile.php">Mano paskyra</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="krepselis.php">Krepselis</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="Parduotuves.php">Parduotuvės</a>
            </li>
            <!-- <li class="nav-item">
               <a class="nav-link"  href="useredit.php">Redaguoti paskyrą</a>
            </li> -->
            
   </html>
<?php
}
if ($userlevel == $user_roles[ADMIN_LEVEL]) {
   echo "<a class=\"nav-link\" href=\"ivestiIranga.php\">Pridėti įrangą</a>";
   echo "<a class=\"nav-link\" href=\"ivestiKategorija.php\">Pridėti kategoriją</a>";
   echo "<a class=\"nav-link\" href=\"ivestiAPrieda.php\">Pridėti apsaugos priedą</a>";
   echo "<a class=\"nav-link\" href=\"ivestiPPrieda.php\">Pridėti priežiūros priedą</a>";
   echo "<a class=\"nav-link\" href=\"admin.php\">Administratoriaus sąsaja</a>";
}
echo "<a class=\"nav-link\" href=\"logout.php\">Atsijungti</a>";
echo "</ul>";
echo "</div>";
echo "</nav>";

echo "<table width=100% border=\"0\"  cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
echo "<tr><td >";
if ($_SESSION['user'] != "Svečias"){
echo "<span style='padding-left: 20px;'>Vartotojas: <b >" . $user . "</b>     Rolė: <b>" . $role . "</b></span> <br>";
}else{
   echo "<span style='padding-left: 20px;'>Rolė: <b >" . $user . "</b>";
}
echo "</td></tr><tr><td>";
echo "</td></tr></table>";
?>