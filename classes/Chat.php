<?php

class Chat {

	private $id;
	private $current_pointer;

	public function __construct($id){
		$this->id = $id;
	}

	public function getID(){
		if($this->id){
			return $this->id;
		}else{
			return false;
		}
	}

	public function checkUser($id){
		if($ids = $this->getParticipantsID()){
			if(isset($ids[$id])){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}

	public function getParticipantsID(){
		$conn = Connection::getInstance("read");
		$command = "SELECT user_id FROM chat_subscribers
					WHERE chat_id = {$this->id}";
		$result = $conn->execObject($command);
		if(mysqli_num_rows($result)){
			$ids = null;

			while($row = mysqli_fetch_assoc($result)){
				$ids[$row['user_id']] = $row['user_id'];
			}

			return $ids;
		}else{
			return false;
		}
	}

	public function getLastMessage(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM messages WHERE chat_id = {$this->id} ORDER BY time DESC LIMIT 1";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_assoc($result);

			return $row;
		}else{
			return false;
		}
	}

	public function getMessages(){
		$messages;
		$conn = Connection::getInstance("read");
		$command = "SELECT * FROM messages WHERE chat_id = {$this->id} ORDER BY time DESC LIMIT 20";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			while($row = mysqli_fetch_array($result)){
				$messages[] = $row;
			}

			$messages = array_reverse($messages);
			return $messages;

		}else{
			return false;
		}
	}

	public function getMessagesFrom($pointer, $me){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM messages
                    WHERE chat_id = {$this->id} 
                    AND message_id > {$pointer} 
                    AND from_user_id != {$me}";
        $result = $conn->execObject($command);

        if (mysqli_num_rows($result)){
        	$ids = null;

        	while($row = mysqli_fetch_assoc($result)){
        		$ids[] = $row['message_id'];
        	}

        	return $ids;

        }else{
        	return false;
        }
	}

	public function getMessagesFromPast(){
	}

	public function sendMessage($sender, $message){

		$conn = Connection::getInstance("write");

		$command  = "INSERT INTO messages (chat_id, from_user_id, message)
						VALUES({$this->id}, {$sender}, '{$message}')";

		if($id = $conn->execInsert($command)){
			//return $id;
			$command = "UPDATE chat SET last_message_id = {$id}
						WHERE chat_id = {$this->id}";
			$conn->execInsert($command);
			$command = "UPDATE chat_subscribers SET last_message_id = {$id}
						WHERE chat_id = {$this->id}
						AND user_id = {$sender}";
			$conn->execInsert($command);
			return $id;
		}else{
			return false;
		}
	}





}








?>