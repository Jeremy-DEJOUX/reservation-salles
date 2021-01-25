<?php
require_once('src/pdo.php');
$path_index = "index.php";
$path_inscription = "pages/inscription.php";
$path_connexion = "pages/connexion.php";
$path_formulaire = "pages/reservation-form.php";
$path_planning = "pages/planning.php";
$path_reservation = "pages/reservation.php";
$path_profil = "pages/profil.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/header.css">
    <title></title>
  </head>
  <body>
    <?php require_once('pages/header.php'); ?>


    <main>
      <h1>Hello</h1>
    </main>




    <?php include_once('pages/footer.php'); ?>
  </body>
</html>
