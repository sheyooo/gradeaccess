<?php 

include("includes/functions.inc");

if( $user->getType() == "admin"){
    include("app/admin/a_students.php");
}




?>