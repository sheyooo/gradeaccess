<?php 
	
class Teacher extends User{

	private $id;
	private $class_id;
	private $name;

	public function __construct($id){
		$this->id = $id;

		$conn = Connection::getInstance("read");

		$command = "SELECT class_id FROM teachers
					LEFT JOIN class_to_teacher
					ON(teachers.teacher_id = class_to_teacher.teacher_id)
					WHERE teachers.teacher_id = {$this->id}
					AND rel_type = 1";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_assoc($result);

			$this->class_id = $row['class_id'];
			
			return true;
		}else{
			$this->class_id = 0;
			return false;
		}
	}

	public function getClassID(){

		if($this->class_id){
			return $this->class_id;
		}
	}

	public function setClass($class_id){
		if( $this->class_id != $class_id){
			$command = null;

			$conn = Connection::getInstance("write");

			$command = "DELETE FROM class_to_teacher 
							WHERE teacher_id = {$this->id} 
							AND rel_type = 1";

			$result = $conn->execDelete($command);

			if($class_id){
				$command = "INSERT INTO class_to_teacher(rel_type, teacher_id, class_id)
										VALUES(1, {$this->id}, {$class_id})";
				$result = $conn->execInsert($command);
			}

			if($result){
				return true;
			}else{
				return false;
			}


		}
	}

	public function getSubjectID(){
		$conn = Connection::getInstance("read");

		$command = "SELECT subject_id FROM teachers
					WHERE teacher_id = {$this->id}";
		$result  = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_assoc($result);
			
			return $row['subject_id'];
		}else{
			return false;
		}
	}

	public function isAuthorized(){
		$conn = Connection::getInstance("read");

		$command = "SELECT authorized FROM teachers
					WHERE teacher_id = {$this->id}";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_assoc($result);

			if($row['authorized']){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function authorize(){
		$conn = Connection::getInstance("write");

		$command = "UPDATE teachers
					SET authorized = 1
					WHERE teacher_id = {$this->id}";

		$result = $conn->execUpdate($command);

		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function unauthorize(){
		$conn = Connection::getInstance("write");

		$command = "UPDATE teachers
					SET authorized = 0
					WHERE teacher_id = {$this->id}";

		$result = $conn->execUpdate($command);

		if($result){
			return true;
		}else{
			return false;
		}
	}


	
}

?>