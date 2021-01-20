<?php
session_start();
require_once('../src/Classes/Week.php');
require_once('../src/Classes/User.php');
require_once('../src/Classes/Creneaux.php');

date_default_timezone_set ('Europe/Paris');

$title = 'planning';

$eventsFromDB = new Creneaux();
$tableCell = [];
$currentEvent = [];

$actWeek = new Week($_GET['day'] ?? null, $_GET['month'] ?? null, $_GET['year'] ?? null);
$startingDayWeek = $actWeek->getFirstDay();
$end = (clone $startingDayWeek)->modify('+ 5 days - 1 second');

$events = $eventsFromDB->getEventsBetweenByDayTime($startingDayWeek, $end);
foreach ($events as $k => $event) {
    $tableCell[$event['case']] = $event['length'];
}

?>
<!DOCTYPE html>
<html lang="fr">
<body>
    <main>
    <div class="calendar__nav">
        <a href="planning.php?day=<?= $actWeek->previousWeek()->day; ?>&month=<?= $actWeek->previousWeek()->month; ?>&year=<?= $actWeek->previousWeek()->year; ?>"><</a>
        <h1>planning: <?= $actWeek->ToString(); ?></h1>
        <a href="planning.php?day=<?= $actWeek->nextWeek()->day; ?>&month=<?= $actWeek->nextWeek()->month; ?>&year=<?= $actWeek->nextWeek()->year; ?>">></a>
    </div>
    <table>
        <colgroup>
            <col style="background-color:#ddd;">
            <col span="5">
            <col span="2" style="background-color:#ddd;">
        </colgroup>
        <?php
            // CONSTRUCT THE TABLE
            // ROWS
            for ($y = 0; $y < 12; ++$y) {
                echo '<tr>', "\n";
                // COLUMNS
                for ($x = 0; $x < 8; ++$x) {
                    $coordinate = $y . '-' . $x;
                    $cellLength = null;

                    if ($y == 0 && $x == 0)
                        echo '<th>Horaires</th>';

                    elseif ($y == 0 && $x > 0) {
                        $daysNumber = $actWeek->mondaysDate + $x - 1;
                        echo '<th>' . $actWeek->getDays($x - 1) . ' ' . $daysNumber .  '</th>';
                    }
                    elseif ($y > 0 && $x == 0) {
                        $tempHour = 7 + $y;
                        if ($tempHour < 10) {
                            $hour = '0' . $tempHour . ':00';
                        }
                        else {
                            $hour = $tempHour . ':00';
                        }
                        echo '<th>' . $hour . '</th>';
                    }
                    else {
                        foreach($tableCell as $key => $value) {
                            if ($coordinate === $key) {
                                $cellLength = $value;
                            }
                        }
                        foreach ($events as $k => $event) {
                            if ($coordinate == $event['case']) {
                                $currentEvent = $event;
                            }
                        }
                        if (isset($cellLength) && $cellLength !== FALSE) {
                            echo '<td rowspan="'. $cellLength . '"';
                            echo ' style="color:white;text-shadow: 2px 1px 2px black; background-color:' . randomHsla() . '">';
                            echo '(' . $cellLength . ')', '<br>';
                            echo $currentEvent['login'], ',<br />';
                            echo $currentEvent['titre'], '<br />';
                            echo "<a href=\"reservation.php?id=" . $currentEvent['id'] . '">détails</a>';
                            echo '</td>';

                            // logical part
                            $tempY = $y + 1;
                            while ($cellLength > 1) {
                                $tableCell[$tempY . '-' . $x] = FALSE;
                                $tempY++;
                                $cellLength--;
                            }
                        }
                        else {
                            if (isset($tableCell[$coordinate])) {
                                ;
                            }
                            else {
                                echo '<td>';
                                // // ERASE AFTER DEBUG
                                // echo '[' . $coordinate . ']';
                                echo '</td>';
                            }
                        }
                    }
                }
                echo '</tr>', "\n";
            }
        ?>
    </table>

  </body>
</html>
