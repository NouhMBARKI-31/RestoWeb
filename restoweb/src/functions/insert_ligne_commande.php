<?php
function insert_ligne_commande($id, $qte, $total,$idCom){
    $dbh=connect_db();
    $sql="INSERT INTO lignecommandes (idCom, idProduit, qteLigne, totalLigneHT) VALUES (:idCom, :id, :qte, :total)";
    try{
        $sth=$dbh->prepare($sql);
        $sth->execute(array(':idCom'=>$idCom,':id'=>$id,':qte'=>$qte,':total'=>$total));
    }catch(PDOException $e){
        die("Erreur dans la fonction insertLigneCommande : ".$e->getMessage());   
    }
}


?>