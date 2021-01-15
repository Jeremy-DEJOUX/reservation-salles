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
        if ($password = $confirm_password) {
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
              header('Location: ../pages/connexion.php');
            }
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
          else {
            $error = "Ce n'est pas le bon mot de passe";
          }

        }
      }
    }
    $_SESSION['id'] = $this->id;
    $_SESSION['login'] = $this->login;
    $_SESSION['password'] = $this->password;
    $_SESSION['error'] = $error;
  }

  public function disconnect(){
    unset($this->id, $this->login, $this->password);
  }


  public function update($login, $password, $confirm_password){
    $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
    $error = null;

    if (!empty($login) AND !empty($password) AND !empty($confirm_password)) { //VERIFICATION NON VIDE

      $lenght_login = strlen($login);
      $lenght_password = strlen($password);
      $lenght_cpassword = strlen($confirm_password);

      if ($lenght_login <= 255 AND $lenght_password <=255 AND $lenght_cpassword <=255) { //VERIFICATION TAILLE VARCHAR MAX 255S

        if ($confirm_password = $password) { // CORRESPONDANCE DES PASSWORD

          if ($login !== $_SESSION['login']) { // DIFFERENT LOGIN

            $count = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = :id");
            $count->execute(array(':login' => $_SESSION['id']));
            $vue = $count->fetch(PDO::FETCH_ASSOC);

            if (!empty($vue)) {

              if ($_SESSION['id'] !== $vue['id']) { // MÊME ID

                  $crypted_password = password_hash($password, PASSWORD_BCRYPT);
                  $insert = $bdd->prepare("UPDATE utilisateurs SET login = :login, password = :crypted_password WHERE id = :id");
                  $insert->execute(array(
                    ':login' => $login,
                    ':crypted_password' => $crypted_password,
                    ':id' => $_SESSION['id']
                  ));

                  if ($insert) {

                    $this->login = $login;
                    $_SESSION['login'] = $login;
                  }
                  else {
                    $error = "ERROR";
                  }


              }
            }
          }
          else {
            $error = "C'est le même login";
          }

        } // MOT DE PASSE CORESPONDENT
        else {
          $error = "les mots de passe ne correspondent pas";
        }

      } // 255 CARACTERES
      else {
        $error = "login et password trop grand max 255 caractères";
      }

    } // REMPLIR LES CHAMPS
    else {
      $error = "il faut remplir tous les champs";
    }

    //FIN DE FUNCTION
    $_SESSION['error'] = $error;
  }

  public function isConnected(){
    if ($this->login) {
      return true;
    }
    else {
      return false;
    }
  }
}

?>
