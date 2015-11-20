<?php 
    
include("includes/functions.inc");



if( $user->getType() == "teacher"){
    include("app/teacher/add_student.php");
}




?>