<?php 

include("includes/functions.inc");

if( $user->getType() == "parent"){    
    include("app/parent/behaviours.php");
}




?>