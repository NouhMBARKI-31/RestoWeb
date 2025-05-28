<?php 
/*Reset le panier et l'id commande lors du retour à l'accueil aprés la validation
 de la commande pour permettre une nouvelle commande en partant de zéro */

include "../../functions/post_validation_cart_reset.php";

post_validation_cart_reset();

header("Location: ../../index.php");

?>