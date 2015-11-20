<?php

require_once("../../includes/functions.inc");

$student = new Student(Tools::valuePost("studId"));

$check;

if (Tools::valuePost("type")) {
    $check = "1";
} else {
    $check = "0";
};

if(Tools::valuePost("behaviour")){
	echo $student->setBehaviour($user->getID(), Tools::valuePost("behaviour"), $check);
}

if(Tools::valuePost("referer") == "modal_profile"){
	Tools::redirect("../../profile.php?guid=" . $student->getID());
}


?>