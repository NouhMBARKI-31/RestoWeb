<?php

function get_product_panier(){
    
    // Connect to database
    $dbh = connect_db();
    //insert commande
    $sql = "insert into commande (idCom,idProduit,qteLigne,totalLigneHT) 
            values (,:idProduit,:qteLigne,totalLigneHT);";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ':idProduit' => $idProduit,
        ':qteLigne'=>$qteLigne,
        'totalLigneHT'=>$totalLigneHT,

    ));
    $row = $sth->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
}

?>