<?php

class ParentClass extends User{

	private $id;
	protected $first_name;
	protected $middle_name;
	protected $last_name;
	private $email;	
	private $conn;

	public function __construct($id){		
		$this->getById($id);
	}

	public function getById($id){
		$conn = Connection::getInstance("read");
		
		$command = "SELECT * FROM users
					LEFT JOIN parents
					ON (users.user_id = parents.parent_id)
					WHERE user_id = {$id} 
					";
		$student = $conn->execObject($command);		

		if(mysqli_num_rows($student)){
			$row = mysqli_fetch_array($student);

			$this->initialized = true;
			$this->id = $row['user_id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
			$this->school_id = $row['school_id'];		

			return $row;
		} else{
			return false;
		};

		//$this->getClassName($conn);
	}

	public function isStudentLinked(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM parents
					LEFT JOIN parent_to_student
					ON (parents.parent_id = parent_to_student.parent_id)
					WHERE parents.parent_id = {$_SESSION['id']}";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			return $row['student_id'];
		}
		else{
			return false;
		}
	}

	public function linkChild($student_id){
		$conn = Connection::getInstance("read");

		$command = "INSERT INTO parent_to_student (parent_id, student_id)
                    VALUES ({$this->id}, {$student_id})";

		$result = $conn->execObject($command);

		if(mysqli_insert_id($conn)){
			return $student_id;
		}
		else{
			return false;
		}
	}

	public function getLastChild(){
		if(trim(isset($_SESSION['last_child'])) != "") {
			return $_SESSION['last_child'];
		}elseif($stu = $this->getStudentID()){
			$_SESSION['last_child'] = $stu;
			
			return $stu;
		}else{
			return false;
		}
	}

	public function getStudentID(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM parent_to_student
					LEFT JOIN parents
					ON (parents.parent_id = parent_to_student.parent_id)
					WHERE parents.parent_id = {$_SESSION['id']}";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			return $row['student_id'];
		}
		else{
			return false;
		}
	}

	public function getStudentsID(){
		$conn = Connection::getInstance("read");

		$command = "SELECT student_id FROM parents
					LEFT JOIN parent_to_student
					ON (parents.parent_id = parent_to_student.parent_id)
					WHERE parents.parent_id = {$this->id}";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$ids = null;
			while($row = mysqli_fetch_array($result)){
				$ids[$row['student_id']] = $row['student_id'];
			}
			return $ids;
		}
		else{
			return false;
		}
	}

	public static function register($id){
		$conn = Connection::getInstance("write");
		$command = "INSERT INTO parents (parent_id) VALUES({$id})";
		$student = $conn->execInsert($command);
	}





	

}

?>