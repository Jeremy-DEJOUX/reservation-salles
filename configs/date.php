<?php

  class Day
  {

    function __construct($day, $month, $year)
    {
      $error = null;
      if ($month < 1 || $month > 7) {
        $error = "Le jour n'existe pas";
      }
    }
  }


 ?>
