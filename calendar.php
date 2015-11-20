<?php 

include("includes/functions.inc");

if( $user->getType() == "admin"){    
    include("app/admin/calendar.php");
}




?>