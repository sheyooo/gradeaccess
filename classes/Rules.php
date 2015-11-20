<?php

class Rules{
	private $id;
	private $content;


	public function __construct($id){

		$this->getById($id);
	}

	public function getById($id){

		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM school WHERE school_id = {$id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			$this->id = $row['news_id'];
			$this->title = $row['title'];
			$this->content = $row['content'];
			$this->date = $row['date'];
		}else{
			return false;
		}
	}











}

?>