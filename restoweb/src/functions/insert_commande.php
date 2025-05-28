<?php
function insert_commande($totalComTTC,$typeCom,$idUtil){
    $dbh=connect_db();
    $sql="INSERT INTO commande (etatCom, totalComTTC, typeCom, dateCom, heureCom, idUtil) VALUES (:etatCom, :totalComTTC, :typeCom, :dateCom, :heureCom, :idUtil)";
    try{
        $sth=$dbh->prepare($sql);
        $sth->execute(array(':etatCom'=>0,':totalComTTC'=>$totalComTTC,':typeCom'=>$typeCom,':dateCom'=>date('Y-m-d'),':heureCom'=>date('H:i:s'),':idUtil'=>$idUtil));
        $insertState=true;//Insertion réussie
    }catch(PDOException $e){
        die("Erreur dans la fonction insertCommande : ".$e->getMessage());   
        $insertState=false;//Insertion échouée
    }
    //On enregistre que l'on vient de créer dans la session pour s'en servir dans la page payer.php
    $_SESSION['idCom']=$dbh->lastInsertId();

    return $insertState; //Retour du statut de l'insertion
}



?>