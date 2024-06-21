<?php

/**
 * Connect to Server and Database
 */
class db_connect {

	// private $db_host = "sql310.epizy.com";	
	// private $db_user = "epiz_26789215";	
	// private $db_pass = "Fm6HnXCk9N4bVz";	
	// private $db_name = "epiz_26789215_durrani";	

	private $db_host = "184.168.102.151";	
	private $db_user = "sawrevajcd";	
	private $db_pass = "Titoo#02Dhonta";	
	protected $db_name = "sawreva";	

	// private $db_host = "localhost";	
	// private $db_user = "root";	
	// private $db_pass = "";	
	// protected $db_name = "durrani";	


	protected $connOk = false;
	protected $conn = "";

	function __construct(){
		if(!$this->connOk){

			$this->conn = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
			//$this->connOk = true;

			// Checks if whether connection is established ot not 
			if($this->conn->connect_error){
				echo "Connection couldn't be established";
				
				// Don't want to run any further statement
				return false;
			}else{
				return true;
			}
		}
	}
}

//$obj = new db_connect();
?>