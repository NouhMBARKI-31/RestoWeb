<?php
include "functions/connect_db.php";
include "functions/get_products.php";
include "functions/get_popular_products.php";

session_start();
// No need to connect to db because db_connect already call in each functions that send db request

$products = get_products(); // Get all products 
$popular_products = get_popular_products(); // Get 4 most ordered products

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); //initialise le tableau
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="index.css">
    <title>Resto Web</title>
</head>
<body>
    <?php
    include "components/navbar/navBar.php";
    ?>
    <div class="page">
        <?php
        //Display 4 more ordered products
        echo "<h2>Produits les plus commandés</h2>";
            echo "<div class='product_list_container'>";
            //Generating the 4 most ordered products cards
            foreach ($popular_products as $product) {
                echo "<a href='features/produit/produit.php?id=" . $product['idProduit'] . "' class='product_card_link'>";
                echo "<div class='product_card'>
                        <h2>" . $product['libProduit'] . "</h2>
                        <p>" . $product['prixProHT'] . " €</p>
                    </div>"; 
                echo "</a>";
            }
            echo "</div>";
        ?>

        <hr>

        <?php
        //Display all productsin db
            echo "<h2>Tous les produits</h2>";
       
                $p = 1; // Needed to get get the number of the card we are creating to close the line each 4 products

                //Display a line of 4 products
                foreach ($products as $product) {
                    //Closing the line if we reach the end of the line of 4 products
                    if($p > 1 && $p%4 == 1) {
                        echo "</div>";
                    }
                    //Open the line if we are on the first product of the line
                    if($p == 1 || $p%4 == 1) {
                        echo "<div class='product_list_container'>";
                    }
                    //Create the product card
                    echo "<a href='features/produit/produit.php?id=" . $product['idProduit'] . "' class='product_card_link'>";
                    echo "<div class='product_card'>
                            <h2>" . $product['libProduit'] . "</h2>
                            <p>" . $product['prixProHT'] . " €</p>
                        </div>"; 
                    echo "</a>";

                    //Increment the number of the card before starting a new cycle
                    $p++;
                }

        ?>

    </div>
    
</body>
</html>