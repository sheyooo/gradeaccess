<?php 

include("includes/functions.inc");

//echo $user->getType();
if( $user->getType() == "parent"){
    include("app/parent/rules_and_reg.php");
}




?>