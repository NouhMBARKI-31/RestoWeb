<?php
// Inclure les fichiers de connexion et de vérification des utilisateurs
include "../../functions/connect_db.php";
include "../../functions/login_user_db.php";

session_start();

// Initialisation de variables pour les messages d'erreur
$error_message = null;
$submit = isset($_POST['submit']);

if ($submit) {
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Vérification que les champs ne sont pas vides
    if (!empty($login) && !empty($password)) {
        // Appeler la fonction pour vérifier l'utilisateur dans la base de données
        if (login_user_db($login, $password)) {
            // Si l'utilisateur est trouvé et le mot de passe est correct
            header("Location: ../../index.php"); // Redirection vers la page d'accueil
            exit();
        } else {
            // Message d'erreur si le login ou mot de passe est incorrect
            $error_message = "Login ou mot de passe incorrect.";
        }
    } else {
        // Message d'erreur si les champs sont vides
        $error_message = "Veuillez remplir tous les champs.";
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
    <link rel="stylesheet" href="connection.css">
    <title>Resto Web</title>
</head>
<body>
    <?php
    include "../../components/navBar/navBar.php";
    include "../../functions/connection_check.php";

    // Check if user is already connected and initialize session
    connection_check();
    ?>

    <div class="page">
        <div class="connect_container">
            <h1>Connexion</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="login" placeholder="Login" required="required">
                <input type="password" name="password" placeholder="Password" required="required">
                <input type="submit" name="submit" value="Connexion">
            </form>

            <!-- Affichage du message d'erreur si la connexion échoue -->
            <?php
            if ($error_message) {
                echo "<p class='form_error_message'>$error_message</p>";
            }
            ?>
        </div>
    </div>
    
</body>
</html>
