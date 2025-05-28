<?php
{
include "../src/functions/connect_db.php";

session_start();

$pdo= connect_db();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id == null) {
    die("Veuillez renseigner un ID dans l'url");
}


 $sql = "UPDATE commande set etatCom=2 WHERE idCom = :id";


 try {
     $sth = $pdo->prepare($sql);
     $sth->execute(array(':id' => $id));
 } catch (PDOException $ex) {
     die("Erreur lors de la requête SQL : " . $ex->getMessage());
 }

echo "la commande " . $id . " a été refusée";



}