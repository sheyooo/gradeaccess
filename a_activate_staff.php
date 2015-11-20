<?php 

include("includes/functions.inc");

if( $user->getType() == "admin"){
    include("app/admin/a_activate_staff.php");
}




?>