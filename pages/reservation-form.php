<?php
    session_start();
    require_once('../src/pdo.php');
    require_once('../src/function.php');
    $title = 'réservation: formulaire';
?>
<!DOCTYPE html>
<html lang="fr">
    <body class="container">
        <main>
            <h1>Formulaire de réservation de salle</h1>

            <form class="" action="" method="post">

              <label for="">Titres</label>
              <input type="text" name="Titles" required value="">

              <label for="">Date</label>
              <input type="date" name="Date" required value="">


              <div class="heure">
                <label for="">Heure de Début</label>
                <input type="time" name="start" value="" required placeholder="HH:MM">

                <label for="">Heure de Fin</label>
                <input type="time" name="end" value="" required placeholder="HH:MM">
              </div>

              <label for="">Description</label>
              <textarea name="description" id="Description" rows="8" cols="80"></textarea>


              <button name="Send">Ajouter l'evenement</button>

            </form>
        </main>

    </body>
</html>
