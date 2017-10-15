<?php

include("includes/functions_no_session.inc");
$view = null;

function confirmation(){
    if($v = Tools::valuePost("verification_code")){
        /*THIS WILL WORK IN FORGOT_CHANGE*/
        echo App::findPasswordReset($v);
        if($id = App::findPasswordReset($v) AND $_SESSION['changer_id'] == App::findPasswordReset($v)){
            $user = new User($id);
            //echo "good pass";
            if(Tools::valuePost("password") == Tools::valuePost("password1") AND strlen(Tools::valuePost("password1")) >= 6){
                
                $user->setPassword(Tools::valuePost("password1"));
                Tools::redirect("signin.php?status=4");            
            }else{
                Tools::redirect("forgot.php?stage=change&verification_code={$v}&error=1");
            }
        }else{
            Tools::redirect("forgot.php?stage=confirmation&error=1");
        }

        

    }else{
        /*THIS WILL WORK IN FORGOT_CONFIRMATION*/
        if($p = Tools::valueGet("phone")){
            if($id = App::findPhone($p)){
                $user = new User($id);
                $_SESSION['changer_id'] = $id;
                
                if($code = $user->initiatePasswordReset()){
                    /*then send sms with code in it*/
                }

            }else{
                Tools::redirect("forgot.php?stage=sms&error=1");
            }

        }elseif($e = Tools::valueGet("email")){
            if($id = App::findEmail($e)){
                $user = new User($id);
                $_SESSION['changer_id'] = $id;
                
                if($code = $user->initiatePasswordReset()){
                    /*then send sms with code in it*/
                }

            }else{
                Tools::redirect("forgot.php?stage=email&error=1");
            }
        }
    }
}


confirmation();

if($stage = Tools::valueGet("stage")){
    if($stage == "ask"){
        $view = "app/modules/user/forgot_ask";
    }elseif($stage == "email"){
        $view = "app/modules/user/forgot_email";
    }elseif($stage == "sms"){
        $view = "app/modules/user/forgot_sms";
    }elseif($stage == "confirmation"){
        $view = "app/modules/user/forgot_confirmation";
        
        //confirmation();     


    }elseif($stage == "change"){
        $view = "app/modules/user/forgot_change";
    }elseif($stage !== ""){
        $view = "app/modules/user/forgot_ask";
    }
    
}else{
    $view = "app/modules/user/forgot_ask";
}



include("app/forgot.php");







?>
