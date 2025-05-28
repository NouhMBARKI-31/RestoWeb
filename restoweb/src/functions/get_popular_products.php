<?php
    // Functions to get the 4 most ordered products in "restoweb" database
    function get_popular_products(){

        // Connect to database
        $dbh = connect_db();

        // Request to get the 4 most ordered products
        $sql = "SELECT lc.idProduit, p.libProduit, SUM(lc.qteLigne) AS total_commandes, p.prixProHT
                FROM ligneCommandes lc, Produit p
                WHERE lc.idProduit = p.idProduit
                GROUP BY lc.idProduit
                ORDER BY total_commandes DESC
                LIMIT 4;";

        // Prepare and execute the request
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $popular_products = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        // Returning an array that contains the 4 most ordered products with their id, lib, total command and price
        return $popular_products;
    }
?>