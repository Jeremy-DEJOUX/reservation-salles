<?php


  function inscription($login, $password, $confirm_password, $bdd){
      $error = null;

      if (!empty($login) AND !empty($password) AND !empty($confirm_password)) {

          $login_len = strlen($login);
          if ($login_len <= 255) {
            $prepare = "SELECT COUNT(*) FROM utilisateurs WHERE login = :login";
            echo "$prepare";
            $count = $bdd->prepare("SELECT COUNT(*) FROM utilisateurs WHERE login = :login");
            $count->execute(array(':login' => $login));
            $num_rows = $count->fetchColumn();

            var_dump($num_rows);




              if (!$num_rows) {

                if ($password = $confirm_password) {
                  $crypted_password = password_hash($password, PASSWORD_BCRYPT);
                  $insert = $bdd->prepare("INSERT INTO utilisateurs(login, password) VALUES (:login, :password)");
                  $insert->execute(array(
                    ':login' => $login,
                    ':password' => $crypted_password
                  ));
                  if ($insert) {
                    header('Location: ../pages/connexion.php');
                  }
                  else {
                    $error = "ERROR";
                  }
                }
                else {
                  $error = "Les mots de passe ne correspondent pas";
                }
              }
              else {
                $error = "Nom d'utilisateurs existant";
              }
            }
            else {
              $error = "Nom d'utilisateurs trop grand";
            }
          }
          else {
            $error = "Tous les champs doivent être remplis";
          }
    return $error;

  }

  //===========================FONCTION DE CONNEXION================================
  function connexion($login, $password, $bdd){
    $error = null;

    if (!empty($login) AND !empty($password)) {
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
          $_SESSION['id'] = $donnees['id'];
          $_SESSION['login'] = $donnees['login'];
          header("Location: ../pages/profil.php");
        }
        else {
          $error = "Ce n'est pas le bon mot de passe";
        }
      }
      }
      else {
        $error = "Le login n'existe pas";
      }

    }
    else {
      $error = "Il faut remplir tous les champs";
    }
    return $error;
  }





  // ======================================CHANGEMENT PROFIL============================================
  function Profil($bdd, $user_name, $password, $confirm_password){
  $error = null;
  $user_name = mysqli_escape_string($bdd, htmlspecialchars(trim($user_name)));
  $password = mysqli_escape_string($bdd, htmlspecialchars(trim($password)));
  $confirm_password = mysqli_escape_string($bdd, htmlspecialchars(trim($confirm_password)));

  if (!empty($user_name) AND !empty($password) AND !empty($confirm_password)) {

      $user_name_len = strlen($user_name);
      if ($user_name_len <= 255) {
          $query = mysqli_query($bdd, "SELECT id FROM utilisateurs WHERE login = '$user_name'");
          $count = mysqli_num_rows($query);

          if (!$count) {

            if ($password = $confirm_password) {
              $crypted_password = password_hash($password, PASSWORD_BCRYPT);
              $mon_id = $_SESSION['id'];
              $insert = mysqli_query($bdd, "UPDATE utilisateurs SET login = '$user_name', password = '$crypted_password' WHERE id = '$mon_id'");

              if ($insert) {
                header("Location: profil.php?id=".$_SESSION['id']);
              }
              else {
                $error = "ERROR";
              }
            }
            else {
              $error = "Les mots de passe ne correspondent pas";
            }
          }
          else {
            $error = "Nom d'utilisateurs existant";
          }
        }
        else {
          $error = "Nom d'utilisateurs trop grand";
        }
      }
      else {
        $error = "Tous les champs doivent être remplis";
      }
  return $error;

  }
?>
