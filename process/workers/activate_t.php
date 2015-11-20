<?php
require_once("../../includes/functions.inc");

$teacher = new Teacher(Tools::valueGet("guid"));


if (Tools::valueGet("method") == "activate") {
    $teacher->authorize();
}
if (Tools::valueGet("method") == "deactivate") {
    $teacher->unauthorize();
}
if (Tools::valueGet("method") == "delete") {
    $teacher = new User(Tools::valueGet("guid"));
    $teacher->delete();
}

Tools::redirect("../../a_activate_staff.php?success=1");

?>