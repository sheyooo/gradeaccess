<?php

class Student extends User{

	private $id;
	private $dob;	
	private $sex;
	protected $first_name;
	protected $last_name;
	private $class_id;
	private $class;
	private $reg_no;
	private $school_id;

	private $fields_from_db;

	public function __construct($id){
		$conn = Connection::getInstance("read");
		
		$command = "SELECT * FROM students
					WHERE student_id = {$id} 
					";
		$student = $conn->execObject($command);		

		if(mysqli_num_rows($student)){
			$row = mysqli_fetch_array($student);

			$this->initialized = true;
			$this->id = $row['student_id'];
			$this->dob = $row['dob'];
			$this->class_id = $row['class_id'];
			$this->reg_no = $row['reg_no'];
			$this->school_id = $row['school_id'];

			$this->fields_from_db = $row;		

			return true;
		} else{
			return false;
		};
	}

	public function getID(){

		return $this->id;
	}

	public function getFields(){
		
		if($this->fields_from_db){
			return $this->fields_from_db;
		}else{
			return false;
		}
	}

	public function getClass(){
		if (!$this->class_id)
			return false;		
		
		$conn = Connection::getInstance("read");
		$command = "SELECT * FROM class
					WHERE class_id = {$this->class_id} ";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);
			return array(
				'class_id' => $this->class_id,
				'class' => $row['level'],
				'arm' => $row['arm']
				);
		}else{
			return false;
		}
	}

	public function getClassID(){
		if(! $this->class_id)
			return false;

		return $this->class_id;
	}

	public function getLastBehaviour(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM
					behaviour beh WHERE 
					student_id = {$this->id}
                    AND time = (SELECT MAX(time) FROM behaviour WHERE student_id = {$this->id})";

        $result = $conn->execObject($command);

        if(mysqli_num_rows($result)){
        	$row = mysqli_fetch_array($result);

        	return array(
        		'behaviour' => $row['behaviour'] ,
        		'type' => $row['behaviour_stat'] , 
        		'rating' => $row['rating'],
        		'time' => $row['time']
        		);
        } else{
        	return false;
        }
	}

	public function getBehaviours(){
		$conn = Connection::getInstance("read");

		$behaviours;

		$command = "SELECT * FROM behaviour 
					WHERE student_id = {$this->id} 
					ORDER BY time DESC
					LIMIT 15";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			while($row = mysqli_fetch_array($result)){
				$behaviours[] = $row;
			}
			return $behaviours;
		}else{
			return false;
		}
	}

	public function setBehaviour($observer, $behaviour, $type){

		if (!($behaviour))
			return false;
		
		$conn = Connection::getInstance("read");
		$command = "SELECT * FROM behaviour 
					WHERE observer = '{$observer}'
					AND behaviour = '{$behaviour}' 
					AND behaviour_stat = '{$type}' ";

		$result = $conn->execObject($command);
		if(mysqli_num_rows($result) == 0){
			$conn = Connection::getInstance("write");
			$command = "INSERT INTO behaviour (student_id, behaviour, observer, behaviour_stat, school_id)
						VALUES ({$this->id}, '{$behaviour}', {$observer}, {$type}, {$this->school_id})";
			$id = $conn->execInsert($command);
			
			return $id;
		}else{
			return false;
		}		
	}	

	public function getLastAttendance(){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM attendance 
					WHERE student_id = {$this->id} 
					AND date = (SELECT MAX(date) FROM attendance WHERE student_id = {$this->id})";

		$result = $conn->execObject($command);
		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			if($row['state'] == 1){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}
	}

	public function getAttendance($day){
		$conn = Connection::getInstance("read");

		$command = "SELECT * FROM attendance 
					WHERE student_id = {$this->id} 
					AND `date` = '{$day}'";

		$result = $conn->execObject($command);
		if (mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			if($row['state'] == 1){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}
	}

	public function isAttendanceMarked(){
		$conn = Connection::getInstance("read");
		$today = Tools::getCurrentDateAttendance();
		$command = "SELECT * FROM attendance
					WHERE `date` = '{$today}'
					AND student_id = {$this->id}";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)) {
			return true;
		}else{
			return false;
		}
	}

	public function setAttendance($att){
		$today = Tools::getCurrentDateAttendance();
		$conn = Connection::getInstance("write");

		$command = "INSERT INTO attendance (school_id, student_id, `date`, state)
						VALUES({$this->school_id}, {$this->id}, '{$today}', {$att}) 
						ON DUPLICATE KEY
						UPDATE state = {$att} ";
		$result = $conn->execInsert($command);		
	}

	public function getParentsID(){
		$conn = Connection::getInstance("read");
		$command = "SELECT parents.parent_id FROM parent_to_student
					RIGHT JOIN parents 
					ON (parent_to_student.parent_id = parents.parent_id)
					WHERE student_id = {$this->id}";
		$result = $conn->execObject($command);
		if(mysqli_num_rows($result)){
			$ids = null;
			while($row = mysqli_fetch_assoc($result)){
				$ids[$row['parent_id']] = $row['parent_id'];
			}

			return $ids;
		}else{
			return false;
		}
	}

	public function getLastAssessmentId(){
		$conn = Connection::getInstance("read");

		$command = "SELECT ass_id FROM assessment 
					WHERE student_id = {$this->id} 
					AND ass_id = (
						SELECT MAX(ass_id) 
						FROM assessment 
						WHERE student_id = {$this->id}
						) ";
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['ass_id'];
		}else{
			return false;
		}
	}

	public function getAssessmentId($year, $term){
		$conn = Connection::getInstance("read");

		$command = "SELECT ass_id FROM assessment
					WHERE year = '{$year}' 
					AND term_id = {$term}
					AND student_id = {$this->id}";
					
		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return $row['ass_id'];
		}else{
			return false;
		}
	}

	public function addAssessmenth($teacher_id){
		$conn = Connection::getInstance("write");
		$school = new School($this->school_id);

		$command = "INSERT INTO assessment (student_id, class_id, teacher_id, term_id, year)
                    VALUES({$this->id}, {$this->class_id}, {$teacher_id}, {$school->getCurrentTermID()},'{$school->getCurrentSession()}')";

        return $conn->execInsert($command);
	}

	public function addAssessment($teacher_id, $year, $term_id){
		$conn = Connection::getInstance("write");
		$school = new School($this->school_id);

		$command = "INSERT INTO assessment (student_id, class_id, teacher_id, term_id, year)
                    VALUES({$this->id}, {$this->class_id}, {$teacher_id}, {$term_id},'{$year}')";

        return $conn->execInsert($command);
	}

	public function getAge(){
		$birthDate = $this->dob;
    	//explode the date to get month, day and year
        $birthDate = explode("-", $birthDate);
    	//get age from date or birthdate

        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
        return $age . " Years Old"; 
	}

	public function getSchoolId(){

		return $this->school_id;
	}





	

}

?>