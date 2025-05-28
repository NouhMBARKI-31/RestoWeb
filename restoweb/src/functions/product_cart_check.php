<?php

// Fonction pour vérifier si le produit est déjà dans le panier
function product_cart_check($cart, $productId) {
    foreach ($cart as $items) {
        foreach ($items as $item) {
            if ($item['productId'] == $productId) {
                return true;
            }
        }
    }
    return false;
}

?>