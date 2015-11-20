<?php

require_once("../../includes/functions.inc");

$att = null;
echo Tools::valuePost("attendance");

if (Tools::valuePost("attendance") == "true") {
    $att = 1;
    echo "present";
} elseif(Tools::valuePost("attendance") == "false") {
    $att = 0;
    echo "absent";
};

if ($id = Tools::valuePost("studId")) {
	$student = new Student($id);
    $student->setAttendance($att);
};




?>