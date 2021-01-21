<?php
session_start();
require_once('Classes/User.php');
require_once('Classes/Creneaux.php');

$_SESSION['user'] = new User();

    $dsn = "mysql:host=localhost;dbname=reservationsalles";
    $userDB = 'root';
    $passDB = '';
    $_SESSION['bdd'] = new PDO("$dsn","$userDB", "$passDB");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
