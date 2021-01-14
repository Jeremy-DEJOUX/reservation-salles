<?php
  require_once("../configs/config.php");

  $path_index = "../index.php";
  $path_inscription = "inscription.php";
  $path_connexion = "connexion.php";
  
  if (isset($_POST['submit'])) {
    $error = connexion($_POST['login_user'], $_POST['password_user'], $bdd);
  }
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../CSS/connexion.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <script src="https://kit.fontawesome.com/56188ecd90.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- ===================================HEADER========================================== -->
    <?php require_once('../pages/header.php'); ?>


<!-- =======================================MAIN=============================================== -->
    <main class="flex a_center column j_around" id="main_connexion">
        <h1>Connexion</h1>
        <?php if (isset($error)) { echo "<h2>$error</h2>"; }?>


        <form action="connexion.php" method="post" id="connexion_formulaire" class="flex a_center column j_around">
            <section class="flex column a_center">
                <label for="login_user">Login :</label>
                <input type="text" name="login_user">
            </section>

             <section class="flex column a_center">
                    <label for="password_user">Password :</label>
                    <input type="password" name="password_user">
            </section>

            <button type="submit" name="submit">Connexion</button>
        </form>
    </main>



<!-- ====================================FOOTER============================================ -->
    <?php require_once('../pages/footer.php') ?>
</body>
</html>
