<?php


class Tools {

	public static function signin($username, $password){
		$conn = Connection::getInstance("read");

        $command = "SELECT user_id, first_name, last_name, username, password, school_id
                        FROM users
                        WHERE username = '{$username}'
                        OR email = '{$username}' ";

        $result = $conn->execObject($command);

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_array($result);

            if( password_verify($password, $row['password'] )){
            	$_SESSION['signed_in'] = 1;
                $_SESSION['subdomain'] = $subdomain;
                $_SESSION['school_id'] = $row['school_id'];
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['type'] = $row['type'];
                
                return true;
            }else{
            	return false;
            }
        }
	    
	}

	public static function getSubdomain($url){
		
	    //$url = 'http://www.mysite.com/';
	    $url = parse_url($url,PHP_URL_HOST);
	    $url = strstr(str_replace("www.","",$url), ".",true);
	    var_dump($url);
	    if($url == "gradeaccess"){
	    	return false;
	    }elseif($url == ""){
	    	return false;
	    }else{
	    	return($url);
	    }
	    
		
	}

	public static function getCurrentDateAttendance(){
		//echo date("Y-m-d");
		return date("Y-m-d");
	}


	public static function cleanString($string){
	
		return mysqli_real_escape_string( Connection::getInstance("read")->connObject(), $string);
	}

	public static function valueGetAllowTags($param){
		if (isset($_GET[$param])){
			return trim(Tools::cleanString($_GET[$param]));
		}else{
			return false;
		}
	}

	public static function valuePostAllowTags($param){
		if (isset($_POST[$param])){
			return trim(Tools::cleanString($_POST[$param]));
		}else{
			return false;
		}
	}

	public static function valueGet($param){
		if (isset($_GET[$param])){
			$param = strip_tags($_GET[$param]);
			return trim(Tools::cleanString($param));
		}else{
			return false;
		}
	}

	public static function valuePost($param){
		if (isset($_POST[$param])){
			$param = strip_tags($_POST[$param]);
			return trim(Tools::cleanString($param));
		}else{
			return false;
		}
	}

	public static function isUserLogged(){

		if (isset($_SESSION['signed_in'])) {
			if ($_SESSION['signed_in']){
				return Tools::cleanString($_SESSION['id']);
			}else{
				return false;
			}
			
			//return true;
		}else{
			return false;
		};
	}

	public static function redirect($url){

		header("Location: {$url}");
	}



	




};

?>