<?php 

include("includes/functions.inc");

if( $user->getType() == "teacher"){
	include("app/teacher/class.php");
}elseif( $user->getType() == "admin"){
	include("app/admin/class.php");
}




?>