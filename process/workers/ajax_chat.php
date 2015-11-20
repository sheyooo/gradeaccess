<?php

require_once("../../includes/functions.inc");


$notifications = null;
$new_message = null;
$notif_alert = null;
$end_product = null;


if(Tools::isUserLogged()) {
    $user = new User($_SESSION['id']);
    if(Tools::valuePost("chat_id")){
        $chat = new Chat(Tools::valuePost("chat_id"));
    
        if (Tools::valuePost("action") == "check_chat") {
            /*GET NEW CHAT MESSAGES FROM THE SERVER*/

            $lastChat = Tools::valuePost("lastChat");
            //echo ($_POST['lastChat']);
            if (Tools::valuePost("lastChat") == 'undefined') {
                $lastChat = 0;
            };

            if ($messages = $chat->getMessagesFrom($lastChat, $user->getID())) {
                $user->clearChatNotification($chat->getID());

                foreach ($messages as $id) {

                    $message = new Message($id);
                    $sender = new User($message->getSenderID());
                    $time = strtotime($message->getTime());

                    $new_message .= "
                        <div id=\"{$id}\" class=\"animated fadeIn chatbox-user right\">
                            <a href=\"javascript:;\" class=\"chat-avatar pull-right\"> 
                                <img src=\"img/faceless.jpg\" class=\"img-circle\" title=\"user name\" alt=\"\">
                            </a>

                            <div class=\"message\">
                                <div class=\"panel\">
                                    <div class=\"panel-heading\">
                                        {$sender->getFullName()}
                                    </div>

                                    <div class=\"panel-body\">
                                        <p>{$message->getMessage()}</p>
                                    </div>
                                </div>

                                <small class=\"chat-time\">
                                <i class=\"ti-time mr5\"></i>
                                <span data-livestamp=\"{$time}\"></span>
                                <i class=\"ti-check text-success\"></i>
                                </small>

                            </div>
                        </div>";
                };

                echo $new_message;
            }
        }elseif (Tools::valuePost("action") == "send_chat") {
            /*SEND NEW CHAT MESSAGE TO THE SERVER*/

            if (!empty(Tools::valuePost("message"))) {
                echo($chat->sendMessage($user->getID(), Tools::valuePost("message") ));
            };
        };
    }elseif (Tools::valuePost("action") == "notification") {
            /*CHECK NEW CHAT MESSAGES FROM THE SERVER*/

            $chats = $user->checkMessages();
            if($chats){
                $count = count($chats);

                foreach ($chats as $id) {                    
                    $chat = new Chat($id);
                    $message_row = $chat->getLastMessage();
                    $sender = new User($message_row['from_user_id']);
                    $time = strtotime($message_row['time']);                  

                    

                    $end_product[] = array("count" => $count, 
                                            "id" => $id,
                                            "notifications" => "New message", 
                                            "name" => $sender->getFullname(), 
                                            "img" => $sender->getProfilePictureURL(),
                                            "timestamp" => $time,
                                            "message" => $message_row['message'], 
                                            "url" => "message.php?chat_id={$id}");
                };

                $end_product = json_encode($end_product);
                echo($end_product);
            }            
        }
}



?>