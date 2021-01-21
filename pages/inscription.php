<?php
  $path_index = "../index.php";
  $path_inscription = "inscription.php";
  $path_connexion = "connexion.php";

  require_once('../src/pdo.php');

  if (isset($_POST['submit'])) {

    $_SESSION['user']->register($_POST['login_user'], $_POST['password_user'], $_POST['confirmpassword']);
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
      <?php if (isset($_SESSION['error'])) {
          echo "<h2>".$_SESSION['error']."</h2>";
      }?>
      <form action="" method="post" id="formulaire_inscriptions" class="flex a_center column j_around">
          <section class="flex column a_center">
              <label for="login_user">Login :
              <input type="text" name="login_user" value="<?php if (isset($login)) { echo $login;  } ?>">
              </label>
          </section>



          <section class="flex j_around a_around">
              <article class="flex column j_around a_center">
                  <label for="password_user">Password :
                  <input type="password" name="password_user">
                  </label>
              </article>

              <article class="flex column j_around a_center">
                  <label for="confirmpassword">Confirm Password :
                  <input type="password" name="confirmpassword">
                  </label>
              </article>
          </section>

          <button type="submit" name="submit" >Valider</button>
      </form>
    </main>

  </body>
</html>
