<?php

function post_validation_cart_reset(){
    
    session_start();

    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }

    if (isset($_SESSION['idCom'])) {
        unset($_SESSION['idCom']);
    }

};

?>