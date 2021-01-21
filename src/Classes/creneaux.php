<?php
    class Creneaux {
      public $lengthEvents = [];
      public $eventsForTheWeek = [];
      public $pdo;

      public function __construct() {
          $dsn = "mysql:host=localhost;dbname=reservationsalles";
          $userDB = 'root';
          $passDB = '';
          $pdo = new PDO("$dsn","$userDB", "$passDB");
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->pdo = $pdo;
      }

      public function getCreneauxBetween(DateTime $start, DateTime $end): array {
          $sql = "SELECT
                  reservations.id, reservations.titre, reservations.debut, reservations.fin, utilisateurs.login
                  FROM reservations JOIN utilisateurs
                  WHERE debut BETWEEN '{$start->format('Y-m-d 08:00:00')}' AND '{$end->format('Y-m-d 19:00:00')}'
                  AND utilisateurs.id = reservations.id_utilisateur";
          $stmt = $this->pdo->query($sql);
          return $stmt->fetchAll();
      }

      /**
       * Retourne un tableau trier par jour
       * UTILISATION DE debut pour les sélectionner
       * @param DateTime $start
       * @param DateTime $end
       * @return array
       */
      public function getCreneauxBetweenByDay(DateTime $start, DateTime $end): array {
          $Creneaux = $this->getCreneauxBetween($start, $end);
          foreach ($Creneaux as $event) {
              $date = explode(' ', $event['debut'])[0];
              if (!isset($days[$date])) {
                  $days[$date] = [$event];
              } else {
                  $days[$date][] = [$event];
              }
          }
          return $days;
      }

      /**
       * Retourne un tableaux avec tous les événements compris entre deux dates, INDEXÉ PAR JOUR
       * UTILISATION DE debut pour les sélectionner
       * @param DateTime $start
       * @param DateTime $end
       * @return array
       */
      public function getCreneauxBetweenByDayTime(DateTime $start, DateTime $end): array {
          $Creneaux = $this->getCreneauxBetween($start, $end);
          $days = [];
          foreach ($Creneaux as $event) {
              $day[$event['debut']] = $event;

              $diff = new Creneaux;
              $length = $diff->timeLength($event['debut'], $event['fin']);

              $day[$event['debut']]['length'] = $length;
              $dateStart = new DateTime($event['debut']);
              $dateDay = $dateStart->format('N');
              $timeHour = $dateStart->format('G');
              $case = ($timeHour - 7) . '-' . $dateDay;
              $day[$event['debut']]['case'] = $case;
              $lengthCreneaux[$case] = $length;

          }
          return $days;
      }

      /**
       * prend deux diiferentes dates en entrée et renvoie la durée en heures
       * @param string $start
       * @param string $end
       * @return int
       */
      public function timeLength(string $start, string $end): int {
          $tempOne = new DateTime($start);
          $tempTwo = new DateTime($end);

          $length = date_diff($tempOne, $tempTwo);
          return $length->h;
      }

      /**
       * retourne les évenements
       * @param int $id
       */
      public function getEvent(int $id): array {
          $sql = "SELECT
                  reservations.id, reservations.titre, reservations.description, reservations.debut, reservations.fin, utilisateurs.login
                  FROM reservations JOIN utilisateurs
                  WHERE reservations.id = :id";
          echo $sql;
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute([':id' => $id]);
          $results = $stmt->fetch(PDO::FETCH_ASSOC);
          return $results;
      }

      /**
       * retourne les evenments
       * @param int $id
       */
      public function getEventById(int $id): array {
          $sql = "SELECT
                  reservations.id, reservations.titre, reservations.description, reservations.debut, reservations.fin, utilisateurs.login
                  FROM reservations JOIN utilisateurs
                  WHERE reservations.id = :id
                  AND utilisateurs.id = reservations.id_utilisateur";

          $stmt = $this->pdo->prepare($sql);
          $stmt->execute([':id' => $id]);
          $results = $stmt->fetch(PDO::FETCH_ASSOC);

          return $results;
      }
  }
?>
