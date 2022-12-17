
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Gyvenk aktyviai</title>
    <link href="include/styles.css" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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
