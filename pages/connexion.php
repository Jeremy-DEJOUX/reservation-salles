<?php

require_once('../src/pdo.php');

  $path_index = "../index.php";
  $path_inscription = "inscription.php";
  $path_connexion = "connexion.php";

  if (isset($_POST['submit'])) {
      $_SESSION['user']->connexion($bdd,
        $_POST['login_user'],
        $_POST['password_user']);
  }
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
</head>
<body>


<!-- =======================================MAIN=============================================== -->
    <main class="flex a_center column j_around" id="main_connexion">
        <h1>Connexion</h1>
        <?php if (isset($_SESSION['error'])) { echo "<h2>".$_SESSION['error']."</h2>"; }?>


        <form action="connexion.php" method="post" id="connexion_formulaire" class="flex a_center column j_around">
            <section class="flex column a_center">
                <label for="login_user">Login :
                <input type="text" name="login_user">
                </label>
            </section>

             <section class="flex column a_center">
                    <label for="password_user">Password :
                    <input type="password" name="password_user">
                    </label>
            </section>

            <button type="submit" name="submit">Connexion</button>
        </form>
    </main>

</body>
</html>
