<?php

    require_once("../../includes/functions.inc");

    if(Tools::isUserLogged() AND $guid = Tools::valueGet("guid")){
        $_SESSION['last_child'] = $guid;
    }

	Tools::redirect("../../index.php");

?>