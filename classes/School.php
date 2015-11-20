<?php

class School{

	private $id;
	private $fields_from_db;


	public function __construct($id){
		$this->id = $id;
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM school
		WHERE school_id = {$id}";
		$result = $conn->execObject($command);		

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			$this->id = $id;
			$this->fields_from_db = $row;

		} else{
			return false;
		}
	}

	public function getFields(){
		if($this->fields_from_db){
			return $this->fields_from_db;
		} else{
			return false;
		}
	}

	public function getID(){

		return $this->id;
	}

	public function getName(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM school
		WHERE school_id = {$_SESSION['school_id']}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			return $row['sch_name'];
		}else{
			return false;
		}
	}

	public function countTeachers(){
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM teachers WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function countAdmins(){
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM admin WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function countParents(){
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM parents
		LEFT JOIN users ON (parents.parent_id = users.user_id)						
		WHERE school_id = {$this->id}
		AND type = 'parent'";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function countStudents(){
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM students WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function countGoodBehaviours(){
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM behaviour 
		WHERE school_id = {$this->id} AND behaviour_stat = 1";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function countBadBehaviours(){
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM behaviour 
		WHERE school_id = {$this->id} AND behaviour_stat = 0";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function countPresent(){
		$today = Tools::getCurrentDateAttendance();
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM attendance
		WHERE school_id = {$this->id} 
		AND state = 1
		AND `date` = '{$today}'";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function countAbsent(){
		$today = Tools::getCurrentDateAttendance();
		$conn = Connection::getInstance("read");

		$command = "SELECT COUNT(*) AS count FROM attendance
		WHERE school_id = {$this->id} 
		AND state = 0
		AND `date` = '{$today}'";
		$result = $conn->execObject($command);

		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['count'];
		}else{
			return false;
		}
	}

	public function getOverallPerformance($y, $t){
		$conn = Connection::getInstance("read");
		$command = "SELECT scores.subject_id, short_name, AVG(score) AS avg
		FROM scores
		LEFT JOIN subjects 
		ON (subjects.subject_id = scores.subject_id)						
		WHERE year = '{$y}'
		AND term_id = {$t}
		GROUP BY subject_id ";
		$result = $conn->execObject($command);
		if(mysqli_num_rows($result)){
			$fields = null;
			while($row = mysqli_fetch_assoc($result)){
				$fields[] = $row;
			}

			return $fields;				
		}else{
			return false;
		}
	}

	public function getLastNewsId(){
		$conn  = Connection::getInstance("read");

		$command = "SELECT * FROM newsletter WHERE school_id = {$this->id} ORDER BY news_id DESC LIMIT 1";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['news_id'];
		}else{
			return false;
		}
	}

	public function getGrade($s){

		$grade_arr;

		switch ($s) {
			case (0):
			$grade_arr = array("F9", "Fail");
			return $grade_arr;
			break;

			case $s >= 80 AND $s <= 100:
			$grade_arr = array("A1", "Excellent");
			return $grade_arr;
			break;

			case $s >= 70 AND $s <= 79:
			$grade_arr = array("B2", "Very Good");
			return $grade_arr;
			break;

			case $s >= 65 AND $s <= 69:
			$grade_arr = array("B3", "Good");
			return $grade_arr;
			break;

			case $s >= 60 AND $s <= 64:
			$grade_arr = array("C4", "Credit");
			return $grade_arr;
			break;

			case $s >= 55 AND $s <= 59:
			$grade_arr = array("C5", "Credit");
			return $grade_arr;
			break;

			case $s >= 50 AND $s <= 54:
			$grade_arr = array("C6", "Credit");
			return $grade_arr;
			break;

			case $s >= 45 AND $s <= 49:
			$grade_arr = array("D7", "Pass");
			return $grade_arr;
			break;

			case $s >= 40 AND $s <= 44:
			$grade_arr = array("E8", "Pass");
			return $grade_arr;
			break;

			case $s >= 0 AND $s <= 39:
			$grade_arr = array("F9", "Fail");
			return $grade_arr;
			break;

			default:
			$grade_arr = array("F9", "Fail");
			return $grade_arr;
			break;
		};
	}

	public function getRules(){
		$conn = Connection::getInstance("read");

		$command = "SELECT rules FROM school WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['rules'];
		}else{
			return false;
		}
	}

	public function setRules($rules){
		$conn = Connection::getInstance("write");

		$command = "UPDATE school
					SET rules = '{$rules}'
					WHERE school_id = {$this->id} ";

		if($conn->execUpdate($command)){
			return true;
		}else{
			return false;
		}


	}

	public function admin(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM school
		WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			return array(
				'name' => $row['owner'],
				'rank' => $row['owner_rank']	);	
		}else {
			return false;
		}
	}

	public function assistant(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM school
		WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			return array(
				'name' => $row['assistant'],
				'rank' => $row['assistant_rank']	);	
		}else {
			return false;
		}
	}

	public function getLocation(){
		$conn = Connection::getInstance("read");

		$command = "SELECT location FROM school 
					WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);
		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			return $row['location'];
		}else{
			return false;
		}
	}

	public function getTelephone(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM school WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){

			$row = mysqli_fetch_array($result);

			return array ( $row['sch_phone'] );
		}
	}

	public function addNews($title, $content){
		$conn = Connection::getInstance("write");

		$command = "INSERT INTO newsletter (school_id, title, content)
                    VALUES ({$this->id}, '{$title}', '{$content}')";

        if($insert_id = $conn->execInsert($command)){
        	return $insert_id;
        }else{
        	return false;
        }
	}

	public function getClassesID(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM class
		WHERE school_id = {$this->id}
		ORDER BY sort";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$ids = null;
			while($row = mysqli_fetch_assoc($result)){
				$ids[$row['class_id']] = $row['class_id'];
			}
			return $ids;
		}else{
			return false;
		}
	}

	public function getAllSessions(){
		$conn = Connection::getInstance("read");

		$command = "SELECT DISTINCT year FROM assessment WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);
		if(mysqli_num_rows($result)){
			$sessions = null;

			while ($row_sessions = mysqli_fetch_assoc($result)) {
				$sessions[] = $row_sessions['year'];				    
			}

			return $sessions;

		} else{
			return false;
		}
	}

	public function getAllTerms(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM terms";
		$result = $conn->execObject($command);
		if(mysqli_num_rows($result)){
			$terms = null;

			while ($row = mysqli_fetch_array($result)) {
				$terms[$row['term_id']] = $row;
			};
			return $terms;

		}else{
			return false;
		}	
	}

	public function getCurrentSession(){

		$conn = Connection::getInstance("read");

		$command = "SELECT current_session FROM school WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['current_session'];
		}else{
			return false;
		}
	}

	public function getCurrentTermID(){

		$conn = Connection::getInstance("read");

		$command = "SELECT current_term FROM school WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['current_term'];
		}else{
			return false;
		}
	}

	public function setSchoolInfo($sch_name, $sch_phone, $current_session, $current_term, $owner, $owner_rank, $assistant, $assistant_rank, $location){
		$conn = Connection::getInstance("write");
		$command = "UPDATE school 
					SET 
					sch_name = '{$sch_name}',
					sch_phone = '{$sch_phone}',
					current_session = '{$current_session}',
					current_term = '{$current_term}',
					owner = '{$owner}',
					owner_rank = '{$owner_rank}',
					assistant = '{$assistant}',
					assistant_rank = '{$assistant_rank}',
					location = '{$location}'
					WHERE school_id = {$this->id}";
		$conn->execUpdate($command);
	}

	public function getAllTeachersID(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM teachers 
		WHERE school_id = {$this->id}";
		$result = $conn->execObject($command);
		if(mysqli_num_rows($result)){
			$ids = null;
			while($row = mysqli_fetch_assoc($result)){
				$ids[$row['teacher_id']] = $row['teacher_id'];
			}
			return $ids;
		}else{
			return false;
		}
	}

	public function getAllStudentsID(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM students WHERE school_id = {$this->id} ORDER BY class_id";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$ids = null;
			while ($row = mysqli_fetch_assoc($result)) {
				$ids[$row['student_id']] = $row['student_id'];
			}
			return $ids;
		}else{
			return false;
		}
	}

	public function getUnnauthorizedTeachersID(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM teachers 
		WHERE authorized = 0";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$ids = null;

			while($row = mysqli_fetch_assoc($result)){
				$ids[$row['teacher_id']] = $row['teacher_id'];
			}

			return $ids;
		}else{
			return false;
		}
	}

	public function addTeacher($title, $fname, $lname, $email, $phone, $subject_id, $class_id){
		$conn = Connection::getInstance("write");

		$command = "INSERT INTO users (school_id, title, first_name, last_name, email, phone, type)
					VALUES ({$this->id}, '{$title}', '{$fname}', '{$lname}', '{$email}', '{$phone}', 'teacher')";

		if($insert_id  = $conn->execInsert($command)){

			$command = "INSERT INTO teachers (teacher_id, school_id, subject_id)
						VALUES ({$insert_id}, {$this->id}, '{$subject_id}')";
			if($insert_id  = $conn->execInsert($command)){
				if($class_id){
					$command = "INSERT INTO class_to_teacher (teacher_id, class_id, rel_type)
								VALUES ({$insert_id}, '{$class_id}', 1)";
					if($insert_id  = $conn->execInsert($command)){
						return true; 
					}else{
						return false;       	
					}
				}
				return true; 
			}else{
				return false;       	
			} 

		}else{
			return false;       	
		}
	}

	public function addClass($level, $arm){
		$conn = Connection::getInstance("write");
		$command = "INSERT INTO class (level, arm, sort, school_id)
								VALUES('{$level}', '{$arm}', 0, {$this->id})";
		if($conn->execInsert($command)){
			return true;
		}else{
			return false;
		}
	}

	public function addUser($title, $fname, $lname, $email, $phone, $type, $hashed_password){

		$conn = Connection::getInstance("write");

		$command = "INSERT INTO users (school_id, title, first_name, last_name, password, email, phone, type)
		VALUES ({$this->id}, '{$title}', '{$fname}', '{$lname}', '{$hashed_password}', '{$email}', '{$phone}', '{$type}')";
		if($insert_id  = $conn->execInsert($command)){
			return $insert_id; 
		}else{
			return false;       	
		}
	}





	public function findStudentByRegNo($reg){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM students
		WHERE reg_no = {$reg}
		AND school_id = {$this->id}
		";
		$result = $conn->execObject($command);		

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_assoc($result);

			return $row['student_id'];
		} else{
			return false;
		};

			//$this->getClassName($conn);
	}




}












?>