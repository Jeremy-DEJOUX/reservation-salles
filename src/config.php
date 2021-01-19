<?php
session_start();
require_once('Classes/User.php');
require_once('Classes/Week.php');
// $_SESSION['week'] = new Week;
$_SESSION['user'] = new User;
?>
