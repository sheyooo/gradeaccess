<?php 

include("includes/functions.inc");

if( $user->getType() == "teacher"){
	include("app/teacher/t_set_subjects.php");
}




?>