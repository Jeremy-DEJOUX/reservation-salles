<?php
require_once('../src/config.php');

$path_index = "../index.php";
$path_inscription = "inscription.php";
$path_connexion = "connexion.php";
$path_formulaire = "reservation-form.php";
$path_planning = "planning.php";
$path_reservation = "reservation.php";
$path_profil = "profl.php";


  if (isset($_SESSION['id'])) {
    // code...

    if (isset($_POST['new_submit'])) {
      $_SESSION['user']->update($_POST['new_login'], $_POST['new_password'], $_POST['confirm_new_password']);
    }




  ?>


  <!DOCTYPE html>
  <html lang="fr">
  <head>
      <meta charset="UTF-8">
      <title>Profil</title>
      <link rel="stylesheet" href="../CSS/profil.css">
      <link rel="stylesheet" href="../CSS/header.css">
      <link rel="stylesheet" href="../CSS/footer.css">
      <script src="https://kit.fontawesome.com/56188ecd90.js" crossorigin="anonymous"></script>
  </head>
  <body>

      <!-- ===================================HEADER========================================== -->
      <?php include_once('../pages/header.php'); ?>

  <!-- =======================================MAIN=============================================== -->
      <main class="flex a_center column j_around" id="main_connexion">

        <section class="flex a_center column j_around">
          <h1>Profil de <?php echo $_SESSION['login']; ?></h1> <br />

          <h3>Login = <?php echo $_SESSION['login']; ?></h3> <br />
          <?php if (isset($_SESSION['error'])) { echo "<h2>".$_SESSION['error']."</h2>"; }?>

          <a href="deconnexion.php">Se Déconnecter</a>
        </section>

          <form action="" method="post" id="formulaire_edition" class="flex a_center column j_around">

              <section class="flex column a_center">
                  <label for="new_login">Nouveau Login :</label>
                  <input type="text" name="new_login" value="<?php echo $_SESSION['login']; ?>">
              </section>

              <section class="flex j_around a_around">
                  <article class="flex column j_around a_center">
                      <label for="new_password">Nouveau mot de passe</label>
                      <input type="password" name="new_password" value="">
                  </article>

                  <article class="flex column j_around a_center">
                      <label for="confirm_new_passsword">Confirm Password :</label>
                      <input type="password" name="confirm_new_password">
                  </article>
              </section>

              <button type="submit" name="new_submit" >Mettre à jour mon profil</button>
      </main>

  <!-- ====================================FOOTER============================================ -->
      <?php include_once('../pages/footer.php') ?>

  </body>
  </html>
<?php } ?>
