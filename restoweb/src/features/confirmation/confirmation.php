<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../app.css">
    <link rel="stylesheet" href="confirmation.css">
    <title>Resto Web</title>
</head>
<body>
    <?php
    session_start(); // Démarrer la session PHP pour maintenir l'état de l'utilisateur

    // Inclusion des éléments de la barre de navigation et du fichier de connexion à la base de données
    include "../../components/navBar/navBar.php";
    include "../../functions/connect_db.php";

    // Connexion à la base de données
    $dbh = connect_db(); // Connexion via PDO

    // Récupération de l'ID de la commande, par exemple via un paramètre GET ou POST (ici statiquement défini pour l'exemple)
    $idCom=$_SESSION['idCom'];

    // Vérifier que l'ID de commande est bien défini et supérieur à 0
    if ($idCom) {
        // Préparation de la requête pour récupérer les informations de la commande
        $sql = "SELECT totalComTTC FROM Commande WHERE idCom = :id_commande";
        $sth = $dbh->prepare($sql); 
        $sth->execute(array(':id_commande' => $idCom));
        $order = $sth->fetch(PDO::FETCH_ASSOC);

        // Récupération des informations de la commande
        $totalComTTC = $order['totalComTTC'];

    } else {
        echo "Numero de commande inexistant.";
    }
    ?>

    <!-- Contenu de la page de confirmation de commande -->
    <div class="page">
        <div class='confirmation_container'>
            <h2>Commande confirmée !</h2>
            <?php
            echo 
                "<p> Votre commande <strong>". $idCom ."</strong> a été confirmée avec succès.</p>
                <p> Le total de la commande est de <strong>". $totalComTTC ."</strong> € .</p>";
            ?>
            <a href="../reset/reset.php">Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>
