<?php
require_once('../src/config.php');

$path_index = "../index.php";
$path_inscription = "inscription.php";
$path_connexion = "connexion.php";
$path_formulaire = "reservation-form.php";
$path_planning = "planning.php";
$path_reservation = "reservation.php";
$path_profil = "profl.php";

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../CSS/planning.css">
  </head>

  <body>

    <?php
      $week = new Week($_GET['week'] ?? null, $_GET['month'] ?? null, $_GET['year'] ?? null);
    ?>

     <h1><?= $week->toString();?></h1>

     <table  class="semainier">
           <?php for ($i=0; $i < $week->getDays() ; $i++){ ?>
             <tr>
               <?php foreach($week->days as $day) { ?>
                 <td>
                   <?php if ($i === 0) {?>
                   <?= $day; ?>
                 <?php } ?>
               </td>
               <?php } ?>
             </tr>
            <?php } ?>


     </table>


  </body>
</html>
