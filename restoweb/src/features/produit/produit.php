<?php

include "../../functions/connect_db.php";
include "../../functions/get_product.php";
include "../../functions/product_cart_check.php";

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../connection/connection.php");
}

// No need to connect to db because db_connect already call in each functions that send db request

$id = $_GET['id']; // Get the id of the product in URL
$product = isset($id) ? get_product($id) : null; // Get the product with its idate
$submit = isset($_POST['submit']);


//Check if the product is already in the cart
$product_cart_check = product_cart_check($_SESSION['cart'], $id);


//Add productId and Quatity to $_SESSION in an array that will store the cart of the user
if ($submit) {
    $cart[] = array("productId" => $id, "quantity" => $_POST['quantity']);
    $_SESSION['cart'][] = $cart;

    header("Location: ../../index.php");
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../app.css">
    <link rel="stylesheet" href="produit.css">
    <title>Resto Web</title>

</head>
<body>

    <?php include "../../components/navbar/navBar.php"; ?>

    <div class="page">
        <div class="product_container">
            <!-- Colonne image -->
            <div class="product_image">
                <img src="../../img/product_placeholder_500x500.png" alt="Image du produit">
            </div>

            <!-- Colonne détails du produit -->
            <div class="product_details">
                <h1><?php echo $product['libProduit']; ?></h1>
                <p>Prix/Unité : <?php echo $product['prixProHT']; ?> €</p>
                

                <!-- Sélecteur de quantité -->
                <form action="<?php $_SERVER ["PHP_SELF"] ?>" method="post" class='form_quantity'>
                        <input type="number" name='id' value='<?php $id ?>' hidden>
                        <input type="number" name='quantity' id='quantity' value="1" min="1" max="10">
                        <!-- Bouton Ajouter au panier -->
                        
                        <?php if(!$product_cart_check){
                        echo "<input class='add_to_cart_btn' type='submit' name='submit' value='Ajouter'>";
                        }else{
                            echo "<input class='add_to_cart_btn_disabled' type='submit' name='submit' value='Ajouter' disabled>";
                            echo "<p class='form_error_message'>Ce produit est déjà dans votre panier</p>";
                        }?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
