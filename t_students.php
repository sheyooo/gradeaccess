<?php 

include("includes/functions.inc");

if(! Tools::isUserLogged())
    Tools::redirect("signin.php");


$school = new School($_SESSION['school_id']);
$user = new User($_SESSION['id']);
//echo $user->getType();
if( $user->getType() == "teacher"){
    $teacher = new Teacher($_SESSION['id']);
    if($class_check = $teacher->getClassID()){
        $class = new SchoolClass($class_check);
    }

    include("app/teacher/t_students.php");
}




?>