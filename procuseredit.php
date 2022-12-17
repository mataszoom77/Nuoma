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