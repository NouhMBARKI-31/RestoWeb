<?php

    function connection_check(){


            if (isset($_SESSION['login'])){

                header("Location: /projets/RestoWeb/restoweb/src/index.php");
                exit();
            }
        }

?>