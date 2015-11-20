<?php
    require_once("../../includes/functions.inc");

    $teachers = $_POST['select'];

    //print_r($teachers);

    foreach($teachers as $id => $class_id){
        $teacher = new Teacher(Tools::cleanString($id));
        if($teacher->setClass(Tools::cleanString($class_id))){
            echo 1;
        }
    };
    Tools::redirect("../../a_assign_staff.php?status=1");

?>