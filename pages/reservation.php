<?php

$path_index = "../index.php";
$path_inscription = "inscription.php";
$path_connexion = "connexion.php";
$path_formulaire = "reservation-form.php";
$path_planning = "planning.php";
$path_reservation = "reservation.php";
$path_profil = "profl.php";

require_once('../src/function.php');
require_once('../src/pdo.php');

$title = 'réservation';

if (isset($_GET['id'])) {
    // GET INFOS FROM DB
    $event = new Events;
    $eventInfos = $event->getEventById($_GET['id']);

    // FORMAT DATE & TIME
    $timestampStart = strtotime($eventInfos['debut']);
    $timestampEnd = strtotime($eventInfos['fin']);
    $formated = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::MEDIUM);
}
else {
    $_SESSION['error'] = "Cette page n'a pas été accédé par le planning";
}

?>

<!DOCTYPE html>
<html lang="fr">
<body class="container">
<main>
    <h1>Réservation</h1>
    <?php
    if (!isset($_SESSION['logged']) || !$_SESSION['logged']) :
        echo '<p class="error">Cette partie du site où vous pourrez voir la réservation de salle sélectionnée, ne sera visible qu\'une fois connecté</p>';
    elseif (isset($_SESSION['error'])):
        echo '<p class="error">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    else :
        ?>
        <article class="reservation">
            <p><span class="info">Réservation réalisée par</span>: <span class="loginReserv"><?= $eventInfos['login']; ?></p>
            <p><span class="info">titre</span>: <span class="reservationTitre">"<?= $eventInfos['titre']; ?>"</span></p>
            <p><span class="info">description</span>:<br>
                <?= $eventInfos['description']; ?>
            </p>
            <p>Commence le <?= $formated->format($timestampStart); ?>, <br>
                et finit le <?= $formated->format($timestampEnd); ?>.
            </p>
        </article>
    <?php endif; ?>
</main>
</body>
</html>
