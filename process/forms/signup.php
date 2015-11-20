<?php
include("../../includes/functions_no_session.inc");

if ($subdomain = Tools::valuePost("subdomain")){

    if($school_id = App::findSubdomain($subdomain)){

        $title = Tools::valuePost('title');
        $type = "parent";
        $name = Tools::valuePost('name');
        $email = Tools::valuePost('email');
        $phone = Tools::valuePost('phone');
        $password = Tools::valuePost('pass');

        $name = explode(" ", $name);

        $pass = password_hash($password, PASSWORD_DEFAULT);
        
        if(!App::findEmail($email)){
            if(!App::findPhone($phone)){
                $school = new School($school_id);
                if($id = $school->addUser($title, $name[0], $name[1], $email, $phone, $type, $pass)){

                    ParentClass::register($id);
                    if(Tools::signin($email, $password)){
                        Tools::redirect("../../index.php?subpage=tour");
                    }
                    
                }else{
                    Tools::redirect("../../signup.php?status=4");
                }
            }else{
                Tools::redirect("../../signup.php?status=3");
            }

        }else{
            Tools::redirect("../../signup.php?status=2");
        }

    }else{
        Tools::redirect("../../signup.php?status=1");
    }


}

?>