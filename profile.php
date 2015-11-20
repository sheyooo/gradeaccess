<?php 

include("includes/functions.inc");

if($p = Tools::valueGet("guid")){
	if(! $profile = new User($p)){
		$profile = $user;
		$me = true;
	}else{
		$me = false;
	}
	if($p == $user->getID()){
		$me = true;
	}
}else{
	$profile = $user;
	$me = true;
}

if($user->getType() == "parent"){
	include("app/parent/profile.php");
}elseif($user->getType() == "teacher"){
	include("app/teacher/profile.php");
}elseif( $user->getType() == "admin"){
	include("app/admin/profile.php");
}




?>