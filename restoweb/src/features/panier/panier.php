<?php
session_start();

include "../../functions/connect_db.php";
include "../../functions/get_products.php";
include "../../functions/get_product.php";
include "../../functions/insert_ligne_commande.php"; 
include "../../functions/insert_commande.php";

//--------------------------------definition des vaziables-------------------------------------


if (!isset($_SESSION['login'])) {
    header("Location: ../connection/connection.php");
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); //initialise le tableau
}


$cart=$_SESSION['cart'];
$totalHT=0;

$idUtil=$_SESSION['idUtil']; 

$instertState=false;


$submit = isset($_POST['submit']);
if ($submit && count($cart)>0){
  if(isset($_POST['check'])){
        $typeCom='A emporter';
    }else{
        $typeCom='Sur place';
    }
    $instertState=insert_commande($_POST['totalHT'],$typeCom,$idUtil);
    $idCom = $_SESSION['idCom'];//recuperation de l'id de la commande qui vient d'être créée

    for($i=0;$i<count($cart);$i++){
        insert_ligne_commande($_POST['idPro'.$i],$_POST['qteLigne'.$i],$_POST['totalLigneHT'.$i],$idCom);
        

}
header("Refresh:4; ../payer/payer.php");
}


//-----------------------------------------------------------------------------------------------


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="panier.css">
    <link rel="stylesheet" href="../../app.css">
    <title>Resto Web</title>
</head>
<body>
<?php
    include "../../components/navBar/navBar.php";
?>
    <div class="page">
        <div class="cart_container">
            <h1>Total</h1>
            <div class='product_list_container'>
                
            <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                <?php
                  
                   echo "<table>
                        <tr>
                            <th>Produit(s)</th>
                            <th>Quantité(s)</th>
                            <th>Prix</th>
                            <th>Total</th>
                        </tr>";
                        $j=0; 
                        foreach($cart as $products){
                             
                             
                            foreach($products as $product){
                                
    
                                $id=$product['productId'];
                                $qt=$product['quantity'];
                                $product=get_product($id);
                                $lib=$product['libProduit'];
                                $prix=$product['prixProHT'];
                                $total=$prix*$qt;
                                $totalHT+=$total;
                                echo "<tr>
                                <td ><input type='hidden' name='idPro" . $j . "' value='" . $id . "'>" . $lib . "</td>
                                <td><input type='hidden' name='qteLigne" . $j . "' value='" . $qt . "'>". $qt . "</td>
                                <td><input type='hidden' name='prixProHT" . $j . "' value='" . $prix . "'>".$prix."</td>
                                <td><input type='hidden' name='totalLigneHT" . $j . "' value='" . $total . "'>".$total."</td>
                                </tr>";
                              
                                $j++;
                            }
                        }
    
                    echo "<input type='hidden' name='totalHT' value='" . $totalHT . "'>";
                    echo "</table>";
                
                ?>
            </div>
            <hr>
            <div class='cart_total_container'>
                <?php
            
                    echo " <h3> Total HT: " . $totalHT . " €</h3>";
                ?>
                <div class='check_box_container'>
                    <input type="checkbox" name="check" value="true">
                    <label for="check">à emporter ?</label>
                </div>
                
            </div>
            <?php if(count($cart)>0){
                echo "<input type='submit' name= 'submit' value='Valider'>";
            }else{
                echo "<input type='submit' name= 'submit' value='Valider' disabled>";
                echo "<p class='form_error_message'>Veuillez ajouter au moins un produit à votre panier</p>";
            }
            if($instertState==true){
                echo "<p class='form_success_message'>Commande ajoutée avec succès</p>";
                echo "<p class='form_success_message'>Redirection vers la page de paiement dans 5 secondes</p>";
            }
            ?>
            </form>
        </div>

    </div>
</body>
</html>