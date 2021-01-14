<?php
require_once('../configs/config.php');
$_SESSION = array();
session_destroy();
header('Location: connexion.php');

 ?>
