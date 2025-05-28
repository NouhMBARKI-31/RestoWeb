<?php

    include("../../functions/disconnect_user.php");

    session_start();

    //Add condtion if seesion user exist
    disconnect_user();
    


?>