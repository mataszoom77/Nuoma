<?php
// procuseredit.php tikrina paskyros keitimo reikšmes
// įvestas reikšmes išsaugo $_SESSION['xxxx_login']
// jei randa klaidų jas sužymi $_SESSION['xxxx_error']
// jei naujas slaptažodis ir email tinka, pataiso DB, nukreipia į index.php prisijungimui iš naujo
// po klaidų- vel i useredit.php 

session_start(); 
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "useredit"))
//{ header("Location: logout.php");exit;}

  include("include/nustatymai.php");
  include("include/functions.php");
  $_SESSION['prev'] = "procuseredit";
  $_SESSION['pass_error']="";
  $_SESSION['mail_error']="";
  $_SESSION['passn_error']="";
  $user=$_SESSION['user'];
  $mail=$_POST['email']; $_SESSION['mail_login']=$mail; 
  $vardas=$_POST['vardas'];
  $pavarde=$_POST['pavarde'];
  $tel=$_POST['tel'];
  $adresas=$_POST['adresas'];
  $kodas=$_POST['kodas'];


  $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  $sql = "UPDATE ". TBL_USERS." SET  email='$mail', vardas='$vardas', pavarde='$pavarde', telefonas='$tel', adresas='$adresas', asmens_kodas='$kodas'  WHERE  username='$user'";
  if (!mysqli_query($db, $sql)) {
    echo " DB klaida keiciant slaptazodi ir epasto adresa: " . $sql . "<br>" . mysqli_error($db);
    mysqli_close($db);
    
    exit;}

  header("Location:useredit.php?status=success");exit;




  exit;
  list(,$dbpass)=checkdb($user); //paimam slaptazodzio maisa is DB
	   if (!$dbpass)
	   { echo " DB klaida nuskaitant slaptazodi vartotojui ".$user;
		               exit;}

  if (checkpass($pass,$dbpass))  // senas slaptazodis ivestas geras  
    {$ar_pasnn=checkpass($passn,substr(hash('sha256',$passn),5,32)); // ar geras naujas
	 $ar_mail=checkmail($mail);                        // ar geras epasto laukas
	 if ( $ar_pasnn && $ar_mail)  // lauku reiksmes geros
      { if ($pass != $passn || $mail != $_SESSION['umail'] || $pass == $passn)   // vartotojas kazka keicia
	            {$dbpass=substr(hash('sha256',$passn),5,32);
                 $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                 $sql = "UPDATE ". TBL_USERS." SET password='$dbpass' ,  email='$mail', vardas='$vardas', pavarde='$pavarde', lytis='$lytis', telefonas='$tel', adresas='$adresas', asmens_kodas='$kodas', miestas='$miestas'   WHERE  username='$user'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida keiciant slaptazodi ir epasto adresa: " . $sql . "<br>" . mysqli_error($db);
                   mysqli_close($db);
		               exit;}
		            $_SESSION['message']="Paskyra pakeista";
				} else {$_SESSION['message']="Nieko nekeitėt, paskyra nepakeista";}
                $_SESSION['user']="";
            //    session_regenerate_id(true);
      header("Location:index.php?status=success");exit;
	  }  // yra kazkokiu klaidu, jos liecia ne galiojanti, o nauja slaptazodi, perrasom
           {$_SESSION['passn_error']=$_SESSION['pass_error'];$_SESSION['pass_error']="";} 
	// jei neteisingas galiojantis, nieko daugiau netikrinom 
    }  
   // taisyti
   $_SESSION['message']="Yra klaidų";
  // session_regenerate_id(true);
   header("Location:useredit.php?status=failed");exit;
