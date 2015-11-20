<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Africa/Lagos');
$base_url = "http://localhost/gradeaccessOOP/";


require_once __DIR__ . '/../vendor/autoload.php';

function my_autoloader($class) {
    include __DIR__ . '../../classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');
new Session();

if(! Tools::isUserLogged()){
    session_destroy();
    Tools::redirect($base_url . "signin.php");
}


$user = new User($_SESSION['id']);
$user->sendPing(time());

\Cloudinary::config(array( 
  "cloud_name" => "sheyooo", 
  "api_key" => "587226176283655", 
  "api_secret" => "ArHjHgBf1eLhT6XXxj8h_Ynb0I4" 
));

$school = new School($user->getSchoolID());

if(! $school)
    Tools::redirect("/signout.php");

if( $user->getType() == "parent"){
    $parent = new ParentClass($_SESSION['id']);
    if($psu_check = $parent->getLastChild()){
        $user_student = new User($psu_check);
        $student = new Student($psu_check);
    }
}elseif( $user->getType() == "teacher"){
    $teacher = new Teacher($_SESSION['id']);
    if($class_check = $teacher->getClassID()){
        $class = new SchoolClass($class_check);
    }
    if(!$teacher->isAuthorized() AND basename($_SERVER["SCRIPT_FILENAME"]) != "unauthorized.php"){
        Tools::redirect("unauthorized.php");
    }elseif($teacher->isAuthorized() AND basename($_SERVER["SCRIPT_FILENAME"]) == "unauthorized.php"){
        Tools::redirect("index.php");
    }

}elseif( $user->getType() == "admin"){
    $admin = new Admin($_SESSION['id']);
    

}





?>