<?php 

/**
 * Session
 */
class Session {

  /**
   * Db Object
   */
  private $db;
  private $db_write;



  public function __construct(){

  // Instantiate new Database object
  	$this->db = Connection::getInstance("read");

  // Set handler to overide SESSION
  	session_set_save_handler(
  		array($this, "_open"),
  		array($this, "_close"),
  		array($this, "_read"),
  		array($this, "_write"),
  		array($this, "_destroy"),
  		array($this, "_gc")
  		);

  // Start the session
  	session_start();
  }


/**
 * Open
 */
public function _open(){
  // If successful
	if($conn = Connection::getInstance("read")){
    // Return True
		return true;
	}
  // Return False
	return false;
}

/**
 * Close
 */
public function _close(){
  // Close the database connection
  // If successful
	if($this->db){
    // Return True
		return true;
	}
  // Return False
	return false;
}

/**
 * Read
 */
public function _read($id){
	$conn = Connection::getInstance("read");
  // Set query
	$result = $conn->execObject("SELECT data FROM sessions WHERE id = '{$id}' ");

	if(mysqli_num_rows($result)){
    // Save returned row
		$row = mysqli_fetch_assoc($result);
    // Return the data
		return $row['data'];
	}else{
    // Return an empty string
		return '';
	}
}

/**
 * Write
 */
public function _write($id, $data){

	$conn = Connection::getInstance("write");
  	// Create time stamp
	$access = time();

  // Set query  
	$success = $conn->execUpdate("REPLACE INTO sessions VALUES ('{$id}', '{$access}', '{$data}') ");

	if($success){
    // Return True
		return true;
	}

  // Return False
	return false;
}

/**
 * Destroy
 */
public function _destroy($id){
	$conn = Connection::getInstance("write");
  // Set query
	$success = $conn->execDelete("DELETE FROM sessions WHERE id = '{$id}' ");

	if($success){
    // Return True
		return true;
	}

  // Return False
	return false;
} 


/**
 * Garbage Collection
 */
public function _gc($max){
	$conn = Connection::getInstance("write");
  // Calculate what is to be deemed old
	$old = time() - $max;

  // Set query
	$success = $conn->execDelete("DELETE FROM sessions WHERE access < '{$old}' ");

	if($success){
    // Return True
		return true;
	}

  // Return False
	return false;
}





















}


?>