<?php
    //Functions to get all products in "restoweb" database
    function get_products(){

        // Connect to database
        $dbh = connect_db();

        // Request to get all products
        $sql = "SELECT * FROM Produit";

        // Prepare and execute the request
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $products = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        // Returning an array that contains all products with their id, lib, price
        return $products;
    }
?>