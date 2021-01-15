<?php
require_once('../src/config.php');
$_SESSION['user']->disconnect();
session_destroy();
header('Location: connexion.php');

 ?>
