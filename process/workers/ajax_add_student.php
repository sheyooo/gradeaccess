<?php

include("../../includes/functions.inc");


if ($_POST['action'] == "insert") {

    $stu_id = Tools::valuePost("studId");
    $reg = Tools::valuePost("regNo");
    $class_id = $teacher->getClassID();
    $fname = Tools::valuePost("firstName");
    $lname = Tools::valuePost("lastName");
    $dob = Tools::valuePost("dob");
    $sex = Tools::valuePost("sex");


    if(Tools::valuePost("studId")){
        echo $class->updateStudent($stu_id, $reg, $class_id, $fname, $lname, $dob, $sex);
    }else{
        echo $class->addStudent($reg, $class_id, $fname, $lname, $dob, $sex);
    };


	
    echo(mysqli_insert_id($conn));
} elseif ($_POST['action'] == "delete") {

    $class->deleteStudent(Tools::valuePost("studId"));

} elseif ($_POST['action'] == "check_reg") {
    if($school->findStudentByRegNo(Tools::valuePost("regId"))){
        echo 1;
    }else{
        echo 0;
    }
    

}












?>