<?php
require_once("../../includes/functions.inc");

if (Tools::valuePost("current_password") AND Tools::valuePost("new_password")) {
    $cur_pass = Tools::valuePost("current_password");
    $new_pass = Tools::valuePost("new_password");
    

    if($user->changePassword($cur_pass, $new_pass)){
        Tools::redirect("../../ch_pass.php?status=2");
    } else{
        Tools::redirect("../../ch_pass.php?status=1");
    }
    
}
?>