<?php 

function add_user_db()
{ 
  //TRUE SI USER CREE OU RESTE FALSE SI PAS CREE
  $_GET['userUtil_cree'] = FALSE;
  //CONNECTION A LA BDD
  $dbh = connect_db();
  //CREATION DES VARIABLES QUI CONTIENNENT LES DONNEES SAISIES DANS LE FORM
  $idUser = "NULL";
  $loginUtil = isset($_POST['loginUtil']) ? $_POST['loginUtil'] : "";
  $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
  $pwd_check = isset($_POST['pwd_check']) ? $_POST['pwd_check'] : "";
  $mail = isset($_POST['mail']) ? $_POST['mail'] : "";
  $error_message = [null];

  //REQUETE POUR VOIR SI PSEUDO DEJA DANS LA BDD

  $sql1 = "select loginUtil from utilisateur where loginUtil =:loginUtil";
  try {
    $sth = $dbh->prepare($sql1);
    $sth->execute(array(':loginUtil' => $loginUtil));
    $loginUtil_bdd = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
  }

  //REQUETE POUR VOIR SI MAIL DEJA DANS LA BDD
  $sql2 = "select mailUtil from utilisateur where mailUtil =:mail";
  try {
    $sth = $dbh->prepare($sql2);
    $sth->execute(array(':mail' => $mail));
    $mail_bdd = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
  }

  //CHECK DES ERREURS DE SAISIS POUR EVITER DES INSERTIONS NON-CONFORME(S)
  if ($pwd != $pwd_check || count($loginUtil_bdd) > 0 || count($mail_bdd) > 0) {

    //CAS OU LES 2 pwd SAISIS NE CORRESPONDENT PAS
    if ($pwd != $pwd_check) {
      array_push($error_message, "Les mots de passe ne correspondent pas !");
    }

    //CAS PSEUDO DEJA UTILISE
    if (count($loginUtil_bdd) > 0) {
      array_push($error_message, "Ce pseudo est déja utilisé !");
    }

    //CAS MAIL DEJA UTILISE
    if (count($mail_bdd) > 0) {
      array_push($error_message, "Ce mail est déja utilisé !");
    }
  }
  //DANS LES AUTRES CAS ON PEUT AJOUTER L'USER A LA BDD
  else {

    //REQUETES QUI CONTIENT LA REQUETES SQL D'INSERTION DE L'USER
    $sql = "insert into utilisateur ( loginUtil,mailUtil,pwdUtil) values (:loginUtil, :mail, :pwd)";

    //HACHAGE DU pwd AVANT DE LE STOCKER
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    try {
      $sth = $dbh->prepare($sql);
      $sth->execute(array(
        ":loginUtil" => $loginUtil,
        ":pwd" => $pwd,
        ":mail" => $mail,
      ));
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }

    $_GET['userUtil_cree'] = true;

    echo "<p>Compte créé avec succés !</p>";//<p class='message_validation'>Redirection vers login dans 4 sec !</p>";
    echo "<p>Redirection vers login dans 4 sec !</p>";


    header("Refresh: 4; ../connection/connection.php" ); // recharge la page aprés 5 sec et renvoie vers la page de connection (/!\ ATTENTION URL marche quue si cette fonction est include dans inscription .php)

  }

  return $error_message;
}

?>