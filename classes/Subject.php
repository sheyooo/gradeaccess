<?php 


class Subject{

	private $id;
	private $name;
	private $short_name;

	public function __construct($id){
		$this->id = $id;

		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM subjects
					WHERE subject_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){

			$row = mysqli_fetch_assoc($result);

			$this->name = $row['name'];
			$this->short_name = $row['short_name'];

			return true;
		}else{
			return false;
		}
	}

	public function getFields(){

		return false;
	}

	public function getName(){

		if($this->name){
			return $this->name;
		}else{
			return false;
		}
	}

	public function getShortName(){

		if ($this->short_name){
			return $this->short_name;
		}else{
			return false;
		}
	}




}



?>