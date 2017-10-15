<?php

class Connection{

	private static $conn;
	private static $_instance;
	private static $db_host = "127.0.0.1";
	private static $db_user = "root";
	private static $db_pass = "";
	private static $database = "gaccess";



	public function __construct($host, $user, $pass, $db){
		//echo date_default_timezone_set('Africa/Lagos');
		$conn = mysqli_connect($host, $user, $pass, $db) or die("error");
		mysqli_query($conn , "SET time_zone = '+01:00' ")or die("SET TIMEZONE FAILED");
		self::$conn = $conn;
		return $conn;

	}

	public static function getInstance($type) {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self(self::$db_host, self::$db_user, self::$db_pass, self::$database);
		}
		return self::$_instance;
	}

	public function connObject() {
		return self::$conn;

	}

	public function exec($sql_command){

		//__construct();
		$result  = mysqli_query(self::$conn, $sql_command) or die("SQL ERROR:<br>" . $sql_command . self::$conn->error);
		
		if(mysqli_num_rows($result) > 0){
			$rows;// = mysqli_fetch_all($result, MYSQLI_BOTH);
			while($row = mysqli_fetch_array($result)){
				$rows[] = $row;
			};
			return $rows;
		}else{
			return false;
		}
	}

	public function execObject($sql_command){
		//__construct();
		/*echo "<pre>";
		debug_print_backtrace();
		echo "</pre>";*/
		$result  = mysqli_query(self::$conn, $sql_command) or die("SQL ERROR:<br>" . $sql_command . "<br />" . self::$conn->error );
		return $result;
	}


	public function execInsert($sql_command){

		//__construct();
		$result  = mysqli_query(self::$conn, $sql_command) or die("SQL ERROR:<br>" . $sql_command . "<br>" . self::$conn->error);		
		if($result){
			return self::$conn->insert_id;
		}else{
			return false;
		}
	}

	public function execUpdate($sql_command){

		//__construct();
		$result  = mysqli_query(self::$conn, $sql_command) or die("SQL ERROR:<br>" . $sql_command . "<br>"  . self::$conn->error);		
		if($result){
			return self::$conn->affected_rows;
		}else{
			return false;
		}
	}

	public function execDelete($sql_command){

		//__construct();
		$result  = mysqli_query(self::$conn, $sql_command) or die("SQL ERROR:<br>" . $sql_command . "<br>" . self::$conn->error );		
		if($result){
			return self::$conn->affected_rows;
		}else{
			return false;
		}
	}


	















	
}










?>