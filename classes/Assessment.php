<?php 

class Assessment {

	private $id;
	private $student_id;
	private $class_id;
	private $year;
	private $term_id;

	private $field_from_db;



	public function __construct($id){
		$this->id = $id;

		$conn = Connection::getInstance("read");

		$command ="SELECT * FROM assessment 
					WHERE ass_id = {$this->id}";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_assoc($result);

			$this->class_id = $row['class_id'];
			$this->student_id = $row['student_id'];
			$this->year = $row['year'];
			$this->term_id = $row['term_id'];
			$this->field_from_db = $row;

			return true;
		}else{
			return false;
		}
	}

	public function getAssessment(){

		if($this->field_from_db){
			return $this->field_from_db;
		}else{
			return false;
		}
	}

	public function getScores(){
		$conn = Connection::getInstance("read");

		$command ="SELECT * FROM scores
					RIGHT JOIN assessment
					ON(scores.ass_id = assessment.ass_id)
					RIGHT JOIN subjects
					ON (subjects.subject_id = scores.subject_id)
					WHERE assessment.ass_id = {$this->id}";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$scores = null;

			while($row = mysqli_fetch_array($result)){
				$scores[$row['subject_id']] = $row;
			}

			return $scores;
		}else{
			return false;
		}
	}

	public function getAverage(){
    	
    	$conn = Connection::getInstance("read");

		$command ="SELECT AVG(score) AS average FROM scores
					RIGHT JOIN assessment
					ON(scores.ass_id = assessment.ass_id)
					RIGHT JOIN subjects
					ON (subjects.subject_id = scores.subject_id)
					WHERE assessment.ass_id = {$this->id}
					AND score != -3";

		$result = $conn->execObject($command);

		if(mysqli_num_rows($result)){
			$row = mysqli_fetch_array($result);

			return round($row['average'], 2);
		}else{
			return false;
		}
	}

	public function getClassID(){
		if($this->class_id){
			return $this->class_id;
		}else{
			return false;
		}
	}

	public function getYear(){
		return $this->year;
	}

	public function getTermID(){
		return $this->term_id;
	}

	public function setScores($score_arr){
		$conn = Connection::getInstance("write");

		$class = new SchoolClass($this->class_id);
		$subjects = $class->getSubjectsID();

		$i = 0;
		$sub_command = null;

		foreach ($subjects as $id) {
			$score = $score_arr[$i];

			$sub_command .= "({$this->id}, {$id}, {$score}, {$this->student_id}, '{$this->year}', {$this->term_id})";
			
			if($i < count($subjects) - 1){
				$sub_command .= ",";
			}

			$i++;
		}

		$command = "REPLACE INTO scores (ass_id, subject_id, score, student_id, year, term_id)
					VALUES {$sub_command}";

		return $conn->execInsert($command);
	}

	public function updateScore($subject_id, $score, $t_class){
		if($this->class_id == $t_class){
			$conn = Connection::getInstance("write");

			$command = "UPDATE scores 
						SET score = {$score}
						WHERE ass_id = {$this->id}
						AND subject_id = {$subject_id}";
						echo $score;
			if($u_id = $conn->execUpdate($command)){
				return $u_id;
			}else{
				return "dintwork";
			}
		}
		
	}



	public function delete(){
		$conn = Connection::getInstance("write");
		$command = "DELETE FROM assessment WHERE ass_id = {$this->id}";
		$conn->execDelete($command);
		$command = "DELETE FROM scores WHERE ass_id = {$this->id} ";
		$conn->execDelete($command);

	}



}

?>