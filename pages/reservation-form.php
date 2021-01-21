<?php
    require_once('../src/pdo.php');
    require_once ('../src/function.php');
    $title = 'réservation: formulaire';


    if (isset($_POST['submit'])) {
        $event = new Creneaux();
        $event->Validateform($_POST['Titles'], $_POST['Date'], $_POST['start'], $_POST['end'], $_POST['description']);
        if (isset($_SESSION['alert'])) {
            var_dump($_SESSION['alert']);
            echo $_SESSION['alert'];

        }
    }

?>
<!DOCTYPE html>
<html lang="fr">
    <body class="container">
        <main>
            <h1>Formulaire de réservation de salle</h1>
            <?php if (isset($_SESSION['alert'])) { echo "<h2>".$_SESSION['alert']."</h2>"; }?>

            <form class="" action="" method="post">

              <label for="">Titres
              <input type="text" name="Titles" required value="">
              </label>

              <label for="">Date
              <input type="date" name="Date" required value="">
              </label>


              <div class="heure">
                <label for="">Heure de Début
                <input type="time" name="start" value="" required placeholder="HH:MM">
                </label>

                <label for="">Heure de Fin
                <input type="time" name="end" value="" required placeholder="HH:MM">
                </label>
              </div>

              <label for="">Description
              <textarea name="description" id="Description" rows="8" cols="80"></textarea>
              </label>


              <button type="submit" name="Send">Ajouter l'evenement</button>

            </form>
        </main>

    </body>
</html>
