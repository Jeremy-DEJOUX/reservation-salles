<?php
require_once('../src/config.php');
$user->disconnect();
session_destroy();
header('Location: connexion.php');

 ?>
