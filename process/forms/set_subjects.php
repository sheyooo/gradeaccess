<?php
include("../../includes/functions.inc");

$current_subjects = $class->getSubjectsID();
$subs = null;
foreach($_POST['subjects'] as $id => $value){
    $subs[] = $id;
};

$class->setSubjects($subs);

Tools::redirect("../../t_set_subjects.php");

?>