<?php 

include("includes/functions.inc");


if( $user->getType() == "parent"){    
    include("app/parent/messages.php");
}elseif ($user->getType() == "teacher") {
	include("app/teacher/messages.php");
	
}elseif ($user->getType() == "admin") {
	include("app/admin/messages.php");
	
}




?>