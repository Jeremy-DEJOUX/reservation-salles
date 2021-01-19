<?php

/**
 *
 */
class Week
{

  public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  private $months = ['Janvier', 'Février', 'Mars', 'Avril' , 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
  private $month;
  private $week;
  private $year;


  /**
   * [__construct description]
   * @param int $week  [compris entre 1 et 5]
   * @param int $month [compris entre 1 et 12]
   * @param int $year  [description]
   */
  public function __construct(?int $week = null, ?int $month = null, ?int $year = null)
  {
    if ($week === null) {
      $week = intval(date('W'));
    }
    if ($week < 1 || $week > 5) {
      throw new \Exception("La semaine n'est pas valide");

    }

    if ($month === null) {
      $month = intval(date('m'));
    }

    if ($year === null) {
      $year = intval(date('Y'));
    }

    $month = $month % 12;


    $this->week = $week;
    $this->month = $month;
    $this->year = $year;
  }

  /**
   * Retourne la date en toute lettre
   * @return string [description]
   */
  public function toString(): string{
    return 'Semaine '.$this->week.' '.$this->months[$this->month - 1] .' '. $this->year;
  }


  public function getDays(): int{
    $start = new \DateTime("{$this->year}-{$this->month}-01-00:00");
    $end = (clone $start)->modify('+23 hours');
    return intval($end->format('H')) - intval($start->format('H'));
  }
}


 ?>
