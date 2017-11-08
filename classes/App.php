<?php 
	class App{

		public function __construct(){
		}

		public function registerImage($p, $u, $r){
			$r = Tools::cleanString($r);
			$conn = Connection::getInstance("write");
			$command = "INSERT INTO images (public_id, url, raw_return)
								VALUES('{$p}', '{$u}', '{$r}')";
			$insert_id = $conn->execInsert($command);

			return $insert_id;
		}

		public static function findSubdomain($subdomain){
			$conn = Connection::getInstance("read");

			// Let school name stand for token for now
			// $command = "SELECT * FROM school 
			// 			WHERE subdomain = '{$subdomain}'";

			$command = "SELECT * FROM school 
						WHERE sch_name = '{$subdomain}'";

			$result = $conn->execObject($command);

			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);

				return $row['school_id'];
			}else{
				return false;
			}
		}

		public static function findEmail($email){
			$conn = Connection::getInstance("read");

			$command = "SELECT * FROM users 
						WHERE email = '{$email}'";

			$result = $conn->execObject($command);

			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				return $row['user_id'];
			}else{
				return false;
			}
		}

		public static function findPhone($phone){
			$conn = Connection::getInstance("read");

			$command = "SELECT * FROM users 
						WHERE phone = '{$phone}'";

			$result = $conn->execObject($command);

			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				return $row['user_id'];
			}else{
				return false;
			}
		}

		public static function findPasswordReset($v_code){
			$conn = Connection::getInstance("read");
			$v_code = strtoupper($v_code);

			$command = "SELECT * FROM password_reset 
						WHERE verification_code = '{$v_code}'";

			$result = $conn->execObject($command);

			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				return $row['user_id'];
			}else{
				return false;
			}
		}

		public static function getSubjectName($subject_id){
			$conn = Connection::getInstance("read");

			$command = "SELECT * FROM subjects
						WHERE subject_id = {$subject_id}";

			$result = $conn->execObject($command);

			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);

				return $row['name'];
			}else{
				return false;
			}
		}

		public static function getSubjects(){
			$conn = Connection::getInstance("read");

			$command = "SELECT * FROM subjects";
			$result = $conn->execObject($command);

			// if(mysqli_num_rows($result)){
				$subjects = [];

				while($row = mysqli_fetch_assoc($result)){
					$subjects[$row['subject_id']] = $row;
				}
				return $subjects;
			// }else{
			// 	return false;
			// }
		}

		public static function generateConfirmationCode(){
			$hash = substr(md5(uniqid(rand(), true)), 8, 8);
			return strtoupper($hash);
		}

		public static function startChat($user1, $user2){
			$conn = Connection::getInstance("write");

			$command = "INSERT INTO chat(chat_type) VALUES(0)";
			$insert_id = $conn->execInsert($command);

			$command = "INSERT INTO chat_subscribers (chat_id, user_id)
						VALUES({$insert_id}, {$user1}),
								({$insert_id}, {$user2})";

			$conn->execInsert($command);

			return $insert_id;
		}
	}
?>