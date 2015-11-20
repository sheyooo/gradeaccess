<?php
    require_once("../../includes/functions.inc");

    if($school->addTeacher(Tools::valuePost("title"),
                        Tools::valuePost("first_name"), 
                        Tools::valuePost("last_name"), 
                        Tools::valuePost("email"), 
                        Tools::valuePost("phone"),
                        Tools::valuePost("subject"),
                        Tools::valuePost("class")))
    {
        Tools::redirect("../../add_teacher.php?status=1");
    }else{
        Tools::redirect("../../add_teacher.php?status=2");
    }

?>