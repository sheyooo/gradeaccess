<?php 


class Message{

	private $id;
	private $sender;
	private $chat_id;
	private $message;
	private $type;
	private $time;



	public function __construct($id){

		$this->id = $id;

		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM messages 
					WHERE message_id = {$this->id}";

		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_assoc($result);

			$this->sender = $row['from_user_id'];
			$this->chat_id = $row['chat_id'];
			$this->message = $row['message'];
			$this->type = $row['type'];
			$this->time = $row['time'];

			return true;
		}else{
			return false;
		}
	}

	public function getSenderID(){

		return $this->sender;
	}

	public function getType(){


		/*whether picture or ordinary message*/
	}

	public function getMessage(){

		return $this->message;
	}

	public function getTime(){

		return $this->time;
	}






}


?>