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
echo "<a class=\"nav-link\" href=\"reviews.php\">Atsiliepimai</a>";
if ($_SESSION['user'] != "Svečias") {
?>
   <html>

            <li class="nav-item">
               <a class="nav-link"href="orderHistory.php">Užsakymų istorija</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="profile.php">Mano paskyra</a>
            </li>
   </html>
<?php
}
if ($userlevel == $user_roles[ADMIN_LEVEL]) {
   echo "<a class=\"nav-link\" href=\"ivestiIranki.php\">Pridėti įrankį</a>";
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
if ($userlevel == $user_roles[ADMIN_LEVEL]) {
?>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="index.php">
         <img src="include/images/favicon.ico" alt="background picture">
      </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
               <a class="nav-link" href="profile.php">Profilis</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="admin.php">Visi naudotojai</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Link</a>
            </li>
            </ul>
         </div>
         <div class="form-inline my-2 my-lg-0">
            <span class="nav-item">
               <a class="nav-link" href="logout.php">Atsijungti</a>
            </span>
         </div>
   </nav>

<?php
}else{
?>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <a class="navbar-brand" href="index.php">
         <img src="include/images/favicon.ico" alt="background picture">
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
               <a class="nav-link" href="profile.php">Profilis</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="admin.php">Visi naudotojai</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="logout.php">Atsijungti</a>
            </li>
            </ul>
         </div>
         <div class="form-inline my-2 my-lg-0">
            <li class="nav-item">
               <a class="nav-link" href="logout.php">Atsijungti</a>
            </li>
         </div>
   </nav>
<?php
}
?>