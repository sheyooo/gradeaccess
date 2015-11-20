<?php 

include("includes/functions.inc");


if( $user->getType() == "parent"){
	include("app/parent/index.php");
}elseif( $user->getType() == "teacher"){
	include("app/teacher/index.php");
}elseif( $user->getType() == "admin"){
	include("app/admin/school_data.php");
}




?>