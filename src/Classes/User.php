<?php

class User
{
  private $id;
  public $login;
  private $password;

  public function __construct(){
    
  }

  public function register($login, $password, $confirm_password){
    $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
    $error = null;

    if (!empty($login) || !empty($password) || !empty($password)) {
      $login_len = strlen($login);
      $lenght_password = strlen($password);

      if ($login_len < 255 || $lenght_password < 255) {
        $count = $bdd->prepare("SELECT COUNT(*) FROM utilisateurs WHERE login = :login");
        $count->execute(array(':login' => $login));
        $num_rows = $count->fetchColumn();

        if (!$num_rows) {
          $crypted_password = password_hash($password, PASSWORD_BCRYPT);

          $insert = $bdd->prepare("INSERT INTO utilisateurs(login, password) VALUES(:login, :password)");
          $insert->execute(array(
            ':login' => $login,
            ':password' => $crypted_password,
          ));

          if ($insert) {
            $this->login = $login;
            $this->password = $crypted_password;

            header('Location: ../pages/connexion.php');
          }
        }
      }
    }
  }


  public function connexion($login, $password){
    $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
    $error = null;

    if (!empty($login) || !empty($password)) {
      $count = $bdd->prepare("SELECT COUNT(*) FROM utilisateurs WHERE login = :login");
      $count->execute(array(
        ':login' => $login
      ));
      $num_rows = $count->fetchColumn();

      if ($num_rows) {
        $result = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $result->execute(array(
          ':login' => $login,
        ));

        while ($donnees = $result->fetch()) {
          if (password_verify($password, $donnees['password'])) {
            $this->id = $donnees['id'];
            $this->login = $login;
            $this->password = $donnees['password'];

            header('Location: ../pages/profil.php');
          }
        }
      }
    }
  }

  public function disconnect(){
    unset($this->id, $this->login, $this->password);
  }


  public function update($login, $password){
    $bdd = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');

    $old_login = $this->login;

    if (!empty($login) AND !empty($password)) {
      $lenght_login = strlen($login);
      $lenght_password = strlen($password);

      if ($lenght_login <= 255 AND $lenght_password <=255) {
        $count = $bdd->prepare("SELECT id FROM utilisateurs WHERE login = :login");
        $count->execute(array(':login' => $old_login));

        if ($count) {
          $crypted_password = password_hash($password, PASSWORD_BCRYPT);
          $insert = $bdd->prepare("UPDATE utilisateurs SET login = :login, password = :crypted_password WHERE login = '$old_login'");
          $insert->execute(array(
            ':login' => $login,
            ':crypted_password' => $crypted_password,
          ));
        }
      }
    }
  }

  public function isConnected(){
    if ($this->login) {
      return true;
    }
    else {
      echo "Pas d'utilisateur connecté";
    }
  }

}

?>
