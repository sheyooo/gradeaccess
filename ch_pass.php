<?php 

include("includes/functions.inc");


//echo $user->getType();
if( $user->getType() == "parent"){
    include("app/parent/ch_pass.php");
}elseif( $user->getType() == "teacher"){
	include("app/teacher/ch_pass.php");
}elseif( $user->getType() == "admin"){
	include("app/admin/ch_pass.php");
}


?>