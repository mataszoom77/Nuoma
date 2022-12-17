<?php 
// forgotpass.php  jei nesiseka prisijungti
// is proclogin gauna:
// $_SESSION['name_login']  vartotojas
// $_SESSION['userid']  userid, bus slaptažodziui pirmi 4 simboliai
//                          !! jei e-paštu negaunate, atsirinkite 4 simbolius iš DB "userid" stulpelio
// $_SESSION['umail']   epaštas, kur pasiųsti 

session_start(); 
// cia sesijos kontrole
if (empty($_SESSION['name_login'])) { header("Location: logout.php");exit;}
  $_SESSION['prev'] = "forgotpass";
 ?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Negali prisijungti</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
  <body>
  <table class="center"><tr><td><img src="include/top2.png" width="1047" height="200"></td></tr><tr><td> 
       <table style="border-width: 2px; border-style: dotted;"><tr><td>
       Atgal į <a class="btn btn-primary" href="index.php" role="button">Pradžia</a></td></tr>
       </table>               
       <div align="center">
       <table> <tr><td>     
           <center style="font-size:18pt;"><b>Vartotojas <?php echo $_SESSION['name_login']; ?> negali prisijungti</b></center>
           </td></tr>
           <tr><td>
            Jei paspausite "Tęsti" bus pakeistas slaptažodis.<br>
            Laikinas slaptažodis bus pasiųstas adresu <?php echo $_SESSION['umail']; ?><br><br>
                                                                                 
            <table class="center">
              <form action="newpass.php" method="POST">  
	               <p style="text-align:right;">
                 <input type="submit" name="login" class="btn btn-primary" value="Tęsti">    
                 </p>
              </form> 
            </table>
   </body>
</html>




