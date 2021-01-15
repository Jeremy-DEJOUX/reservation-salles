<!-- ====================CONNECTED==================== -->
<?php
  $connected = $_SESSION['user']->isConnected();
  if ($connected) {
?>
<header>
  <nav>
    <ul>
      <li> <?php echo "<a href='$path_index'> Acceuil </a>"; ?> </li>
      <li> <?php echo "<a href='$path_planning'> Planning </a>"; ?> </li>
      <li> <?php echo "<a href='$path_reservation'> Reservation </a>"; ?> </li>
      <li> <?php echo "<a href='$path_formulaire'> Formulaire </a>"; ?> </li>
      <li> <?php echo "<a href='$path_profil'> Profil </a>"; ?> </li>
    </ul>
  </nav>
</header>

 <!-- =======================NOT CONNECTED================== -->
<?php
  }
  else {
?>

<header>
  <nav>
    <ul>
      <li> <?php echo "<a href='$path_index'>Acceuil</a>"; ?> </li>
      <li> <?php echo "<a  href='$path_inscription'> Inscription </a>";  ?> </li>
      <li> <?php echo "<a  href='$path_connexion'> Connexion </a>";  ?> </li>
    </ul>
  </nav>
</header>

<?php
  }
?>
