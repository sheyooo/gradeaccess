<?php

class Newsletter{
	private $id;
	private $title;
	private $content;
	private $date;
	private $field_from_db;



	public function __construct($id){
		$this->id = $id;	

		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM newsletter WHERE news_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			$this->id = $row['news_id'];
			$this->title = $row['title'];
			$this->content = $row['content'];
			$this->date = $row['date'];
			$this->field_from_db = $row;

			return true;
		}else{
			return false;
		}
	}

	public function getID(){
		if($this->id){
			return $this->id;
		}else{
			return false;
		}
	}

	public function getFields(){
		if($this->field_from_db){
			return $this->field_from_db;
		}else{
			return false;
		}
	}

	public function getTitle(){
		if($this->title){
			return $this->title;
		}else{
			return false;
		}
	}

	public function getNextId($school_id){
		$conn = Connection::getInstance("read");

		$command = "SELECT news_id FROM newsletter WHERE school_id = {$school_id} AND date > '{$this->date}' ORDER BY date LIMIT 1";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['news_id'];
		}else{
			return false;
		}
	}

	public function getPreviousId($school_id){

		$conn = Connection::getInstance("read");

		$command = "SELECT news_id FROM newsletter WHERE school_id = {$school_id} AND date < '{$this->date}' ORDER BY date DESC LIMIT 1";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['news_id'];
		}else{
			return false;
		}
	}

	public function update($title, $content){
		$conn = Connection::getInstance("write");

		$command = "UPDATE newsletter
	                SET title = '{$title}', 
	                	content = '{$content}'
	                WHERE news_id = {$this->id}";
        if($aff_row = $conn->execUpdate($command))
        	return true;
	}

	public function delete($school_id){
		$conn = Connection::getInstance("write");
		$command = "DELETE FROM newsletter
					WHERE news_id = {$this->id}
					AND school_id = {$school_id}";
		if($conn->execDelete($command)){
			return true;
		}else{
			return false;
		}
	}












}

?>