<?php

	class SchoolClass{

		private $id;
		private $level;
		private $arm;
		private $school_id;
		private $sort;
		private $fields_from_db;


		public function __construct($id){
			$this->id = $id;
			$conn = Connection::getInstance("read");

			$command = "SELECT * FROM class
					WHERE class_id = {$id}";
			$result = $conn->execObject($command);		

			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);

				$this->id = $row['class_id'];
				$this->arm = $row['arm'];
				$this->level = $row['level'];
				$this->school_id = $row['school_id'];
				$this->sort = $row['sort'];
				$this->fields_from_db = $row;

				return true;				
			} else{
				return false;
			}
		}

		public function getID(){

			return $this->id;
		}

		public function getSchoolID(){

			return $this->school_id;
		}

		public function getFields(){
			if($this->fields_from_db){
				return $this->fields_from_db;				
			} else{
				return false;
			}
		}

		public function getClassName(){

			return $this->level . " " . $this->arm;
		}

		public function getLevel(){

			return $this->level;
		}

		public function getArm(){

			return $this->arm;
		}

		public function getSorting(){

			return $this->sort;
		}

		public function update($level, $arm, $sort){
			$conn = Connection::getInstance("write");
			$command = "UPDATE class SET level = '{$level}',
										arm = '{$arm}',
										sort = {$sort}
						WHERE class_id = {$this->id}";

			$conn->execUpdate($command);

		}

		public function getStudentsID(){
			$conn = Connection::getInstance("read");

			$command = "SELECT student_id FROM students
						WHERE class_id = {$this->id}";
			$result = $conn->execObject($command);

			if (mysqli_num_rows($result)) {
				$ids = null;

				while($row = mysqli_fetch_assoc($result)){
					$ids[$row['student_id']] = $row['student_id'];
				}

				return $ids;
			}else{
				return false;
			}
		}

		public function getTeachersID(){
			$conn = Connection::getInstance("read");
			$command = "SELECT teacher_id FROM class_to_teacher
						WHERE class_id = {$this->id}";

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

		public function getStudentsIDof($year, $term_id){
			$conn = Connection::getInstance("read");
			$school = new School($this->school_id);
			if($year == $school->getCurrentSession() /*AND $term_id == $school->getCurrentTermID()*/){
				return $this->getStudentsID();
			}else{

				$command = "SELECT DISTINCT student_id FROM assessment
							WHERE year = '{$year}'
							AND term_id = {$term_id}
							AND class_id = {$this->id}";
				$result = $conn->execObject($command);

				if (mysqli_num_rows($result)) {
					$ids = null;

					while($row = mysqli_fetch_assoc($result)){
						$ids[] = $row['student_id'];
					}

					return $ids;
				}else{
					return false;
				}
			}
		}

		public function getSubjectsID(){
			$conn = Connection::getInstance("read");

			$command = "SELECT subject_id FROM class
						RIGHT JOIN class_subjects
						ON (class.class_id = class_subjects.class_id)
						WHERE class.class_id = {$this->id}";
			$result = $conn->execObject($command);

			if(mysqli_num_rows($result)){

				$ids = null;

				while($row = mysqli_fetch_assoc($result)){
					$ids[$row['subject_id']] = $row['subject_id'];
				}

				return $ids;
			}else{
				return false;
			}
		}

		public function setSubjects($sub_id_array){
			$conn = Connection::getInstance("write");

			if($sub_id_array){
				$sub_query = null;
				$i = 0;

				$command = "DELETE FROM class_subjects
							WHERE class_id = {$this->id}";
				$conn->execDelete($command);
				
				foreach ($sub_id_array as $value) {
					$sub_query .= "({$this->school_id}, {$this->id}, {$value})";

					if ($i < count($sub_id_array) - 1) {
						$sub_query .= ",";
					}

					$i++;
				}

				$command = "INSERT INTO class_subjects (school_id, class_id, subject_id)
							VALUES {$sub_query}";

				$conn->execInsert($command);
			}
		}

		public function addStudent($reg, $class_id, $fname, $lname, $dob, $sex){
			$conn = Connection::getInstance("write");

			$date = strtotime($_POST['dob']);
			$date = date("Y-m-d", $date);

			$command = "INSERT INTO users (type, first_name, last_name, sex, school_id)
							VALUES('student', '{$fname}', '{$lname}', '{$sex}', {$this->school_id})";
		    $new_id = $conn->execInsert($command);

		    $command = "INSERT INTO students (student_id, reg_no, class_id, dob, school_id)
							VALUES({$new_id}, '{$reg}', {$class_id}, '{$dob}', {$this->school_id})";
		    $conn->execInsert($command);		    
		}

		public function updateStudent($student_id, $reg, $class_id, $fname, $lname, $dob, $sex){
			$conn = Connection::getInstance("write");

			$date = strtotime($_POST['dob']);
			$date = date("Y-m-d", $date);

		    $command = "UPDATE students
	    				SET reg_no = {$reg},	    				
	    					dob = '{$dob}'
	    				WHERE student_id = {$student_id}
	    				AND class_id = {$this->id}";
		    if( $conn->execUpdate($command)){
		    	$command = "UPDATE users
	    				SET first_name = '{$fname}',
		    				last_name = '{$lname}',	    				
		    				sex = '{$sex}'
	    				WHERE user_id = {$student_id}";

		    	if($conn->execUpdate($command)){
		    		return true;
		    	}else{
		    		return false;
		    	}
		    }else{
		    	return false;
		    }		    
		}

		public function deleteStudent($id){
			$conn = Connection::getInstance("write");

			$command = "DELETE FROM students WHERE student_id = {$id} AND class_id = {$this->id}";

			if($conn->execDelete($command)){
				
				$command = "DELETE FROM parent_to_student WHERE student_id = {$id}";
				$conn->execDelete($command);

				$command = "DELETE FROM users WHERE user_id = {$id}";
				if($conn->execDelete($command)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}







	}












?>