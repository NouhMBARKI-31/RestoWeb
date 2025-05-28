<?php

    function my_autoloader($classe) {
    include '' . $classe . '.php';
    }
    spl_autoload_register('my_autoloader');
?>