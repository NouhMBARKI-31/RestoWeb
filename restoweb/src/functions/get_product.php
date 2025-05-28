<?php

    //Functions to get a specific product in "restoweb" database with its id
    function get_product($id){

        // Connect to database
        $dbh = connect_db();

        // Request to get the product with its id
        $sql = "SELECT * FROM Produit WHERE idProduit = :id";

        // Prepare and execute the request
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(':id' => $id));
            $product = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        // Returning an array that contains the product with its id, lib, price
        return $product;
    }
?>