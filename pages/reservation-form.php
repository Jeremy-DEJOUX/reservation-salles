<?php
    require_once('../src/pdo.php');
    require_once ('../src/function.php');
    $title = 'réservation: formulaire';


    $data = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = $_POST;
        $errors = [];
        $validation = new EventValidator();
        $errors = $validation->validates($_POST);

        if (empty($errors)){
            $dateStart = $_POST['date'] . ' ' . $_POST['start'] . ':00';
            $dateEnd = $_POST['date'] . ' ' . $_POST['end'] . ':00';
            $insert = "INSERT INTO reservations 
                (titre, description, debut, fin, id_utilisateur) 
                VALUES (:title, :description, :debut, :fin, :id_user)";

            $stmt = $bdd->prepare($insert);

            $stmt->execute([
                ':title'=> htmlentities($_POST['name']),
                ':description'=> htmlentities($_POST['description']),
                ':debut'=> $dateStart,
                ':fin'=> $dateEnd,
                ':id_user'=> $_SESSION['id']
            ]);
            var_dump($errors);
        }

    }

?>
<!DOCTYPE html>
<html lang="fr">
    <body class="container">
        <main>
            <h1>Formulaire de réservation de salle</h1>

            <form class="" action="" method="post">

              <label for="">Titres
              <input type="text" name="name" required value="<?= isset($data['name']) ? ($data['name']) : ''; ?>">
                  <?php if (isset($errors['name'])): ?>
                  <?= $errors['name']; ?>
                  <?php endif; ?>
              </label>

              <label for="">Date
              <input type="date" name="date" required value="<?= isset($data['date']) ? ($data['date']) : ''; ?>">

                  <?php if (isset($errors['Date'])): ?>
                      <?= $errors['Date']; ?>
                  <?php endif; ?>
              </label>


              <div class="heure">
                <label for="">Heure de Début
                <input type="time" name="start" value="<?= isset($data['start']) ? ($data['start']) : ''; ?>" required placeholder="HH:MM">
                    <?php if (isset($errors['start'])): ?>
                        <?= $errors['start']; ?>
                    <?php endif; ?>
                </label>

                <label for="">Heure de Fin
                <input type="time" name="end" value="<?= isset($data['end']) ? ($data['end']) : ''; ?>" required placeholder="HH:MM">
                </label>
              </div>

              <label for="">Description
              <textarea name="description" id="description" rows="8" cols="80"><?= isset($data['description']) ? ($data['description']) : ''; ?></textarea>
              </label>


              <button type="submit" name="Send">Ajouter l'evenement</button>

            </form>
        </main>

    </body>
</html>
