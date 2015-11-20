<?php 

include("includes/functions.inc");


$chat = false;
if($get_chat_id = Tools::valueGet("chat_id")){
	
   	$chat = new Chat($get_chat_id);
   	if(!$chat->checkUser($user->getID())){
   		Tools::redirect("index.php");
   	}
   //$messages = $chat->getMessages();
}
elseif($u_id = Tools::valueGet("user")){
	$ch_user = new User($u_id);
	$insert_id = null;
	if($u_id != $user->getID()){
		if($user->getChatsID() AND $ch_user->getChatsID()){
			if($chat_id = array_intersect($user->getChatsID(), $ch_user->getChatsID())){
				$chat_id = current($chat_id);
				$chat = new Chat($chat_id);
			}else{
				$insert_id = App::startChat($user->getID(), $ch_user->getID());
				$chat = new Chat($insert_id);
			}
		}else{
			$insert_id = App::startChat($user->getID(), $ch_user->getID());
			$chat = new Chat($insert_id);
		}
	}else{
		Tools::redirect("messages.php");
	}

}else{
	Tools::redirect("messages.php");
}


if( $user->getType() == "parent"){    
    include("app/parent/message.php");
}elseif( $user->getType() == "teacher"){
    include("app/teacher/message.php");
}elseif($user->getType() == "admin"){
	include("app/admin/message.php");
}







?>