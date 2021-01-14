<?php
  require_once('../configs/config.php');
  $path_index = "../index.php";
  $path_inscription = "inscription.php";
  $path_connexion = "connexion.php";

  if (isset($_POST['submit'])) {
    $error = inscription($_POST['login_user'], $_POST['password_user'], $_POST['confirmpassword'], $bdd);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php include_once('header.php'); ?>

    <main>
      <h1>Formulaire d'Inscription</h1>
      <?php if (isset($error)) {
          echo "<h2>$error</h2>";
      }?>
      <form action="inscription.php" method="post" id="formulaire_inscriptions" class="flex a_center column j_around">
          <section class="flex column a_center">
              <label for="login_user">Login :</label>
              <input type="text" name="login_user" value="<?php if (isset($login)) { echo $login;  } ?>">
          </section>



          <section class="flex j_around a_around">
              <article class="flex column j_around a_center">
                  <label for="password_user">Password :</label>
                  <input type="password" name="password_user">
              </article>

              <article class="flex column j_around a_center">
                  <label for="confirmpassword">Confirm Password :</label>
                  <input type="password" name="confirmpassword">
              </article>
          </section>

          <button type="submit" name="submit" >Valider</button>
      </form>
    </main>

  </body>
</html>
