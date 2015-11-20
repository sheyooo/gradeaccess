<?php
    require_once("../../includes/functions.inc");

    print_r($_POST);



    if(Tools::valuePost("action") == "edit"){
        foreach ($_POST['id'] as $key) {
            $level = Tools::cleanString($_POST['class'][$key]);
            $arm = Tools::cleanString($_POST['arm'][$key]);
            $sort = Tools::cleanString($_POST['sort'][$key]);

            if($level AND $arm AND $sort){
                $class = new SchoolClass(Tools::cleanString($key));
                $class->update($level, $arm, $sort);
            }else{
                Tools::redirect("../../classes.php?status=1");
            }
        }
        Tools::redirect("../../classes.php");

    }elseif(Tools::valuePost("action") == "new"){
        foreach ($_POST['id'] as $key => $value) {
            print_r($_POST);
            $level = Tools::cleanString($_POST['class'][$key]);
            $arm = Tools::cleanString($_POST['arm'][$key]);

            if($level AND $arm){
                if($school->addClass($level, $arm)){
                    Tools::redirect("../../classes.php?status=2");
                }
            }else{
                Tools::redirect("../../classes.php?status=3");
            }
        }
        Tools::redirect("../../classes.php");
    }

?>