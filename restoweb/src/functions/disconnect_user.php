<?php

    function disconnect_user(){
        session_unset(); // Détruit toutes les variables de session
        session_destroy(); // Détruit la session (mais pas le cookie)
        setcookie(session_name(), '', -1, '/'); // Détruit le cookie de session
        // Redirection vers index.php
        header("Location: /projets/RestoWeb/restoweb/src/index.php");
        exit();
    }
?>