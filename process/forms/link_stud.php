<?php

require_once("../../includes/functions.inc");

if ($reg = Tools::valueGet("reg_no") AND Tools::valueGet("last_name") AND Tools::valueGet("birth_day")) {
    $date = strtotime(Tools::valueGet("birth_day"));
    $school = new School($user->getSchoolID()); 
    echo $user->getSchoolID();


     //die($id = $school->findStudentByRegNo($reg));   

    if ($id = $school->findStudentByRegNo($reg)) {
        
            $stu = new Student($id);
            $fields = $stu->getFields();
            $dbdate = $fields['dob'];
            $id = $fields['student_id'];

            $dbdate = strtotime($dbdate);

            if ($date == $dbdate) {
                $parent->linkChild($id);
                Tools::redirect("../../link.php?success=1");

            } else {
                echo "Birthday different";
                echo $date;
                echo $dbdate;
                Tools::redirect("../../link.php?success=3");
            }
        

    } else {
        echo "No id match found";
        Tools::redirect("../../link.php?success=2");
    }
}

?>