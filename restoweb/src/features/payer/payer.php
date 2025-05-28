<?php
include "../../functions/connect_db.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../connection/connection.php");
    exit;
}

$pdo = connect_db(); 
$error_message = null;
$submit = isset($_POST['submit']);
$paymentState=false;

$idCom=$_SESSION['idCom'];

    // Vérifier que l'ID de commande est bien défini et supérieur à 0
    if ($idCom) {
        // Préparation de la requête pour récupérer les informations de la commande
        $sql = "SELECT totalComTTC FROM Commande WHERE idCom = :id_commande";
        $sth = $pdo->prepare($sql); 
        $sth->execute(array(':id_commande' => $idCom));
        $order = $sth->fetch(PDO::FETCH_ASSOC);

        // Récupération des informations de la commande
        $totalComTTC = $order['totalComTTC'];

    } else {
        echo "Numero de commande inexistant.";
    }

if ($submit) {
    $idCom = $_SESSION['idCom'];

    try {
        $etatCom = "Calculée";
        $sql = "UPDATE commande SET etatCom = :etatCom WHERE idCom = :idCom;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':etatCom' => $etatCom,
            ':idCom' => $idCom
        ]);

        $paymentState=true;
        header("Refresh:3; ../confirmation/confirmation.php");
    } catch (PDOException $error) {
        echo "Erreur lors de la mise à jour de la commande : " . $error->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../app.css">
    <link rel="stylesheet" href="payer.css">
    <title>Resto Web</title>
</head>
<body>
    <?php include "../../components/navBar/navBar.php"; ?>

    <div class="page">
        <div class="payment_container">
            <h1>Paiement de votre commande</h1>
            <?php
            echo "<h3> Total de la commande : ". $totalComTTC ." €</h3>";
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="cb_number" placeholder="N° de CB" required="required">
                <input type="text" name="exp_date" placeholder="Date expiration" required="required">
                <input type="text" name="ccv" placeholder="CCV" required="required">
                <input type="submit" name ="submit" value="Payer">
                <?php
                if($paymentState==true){
                    echo "<p class='form_success_message'>Paiement effectué avec succès</p>";
                    echo "<p class='form_success_message'>Vous allez être redirigé vers la page de confirmation de commande</p>";
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
