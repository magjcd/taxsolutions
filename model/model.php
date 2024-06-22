<?php
include("db_connect.php");
//include(realpath(__DIR__.'/..')."/model/db_connect.php");
/**
 * 
 */
class Model extends db_connect {

// Login
	//public $sql = "";

	public function loginRole(){
		$sql = "SELECT role FROM `user`";
		$sqlres = $this->conn->query($sql);
		return $sqlres;
	}	

	protected function login($un,$upwd,$role){
		$sql = "SELECT * FROM `user` WHERE userName = '$un' AND userPass = '$upwd' AND role = '$role'";
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	protected function fetchAll($table,$order = null){
		$sql = "SELECT * FROM `$table`";
		if($order != null){
			$sql .= " $order";
		}
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	protected function fetchSingle($table,$where){
		$sql = "SELECT * FROM $table WHERE $where";
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	protected function fetchSingleJoin($table,$join,$where = null){
		$sql = "SELECT * FROM $table LEFT JOIN $join";
		if($where != null){
			$sql .= " WHERE $where";
		}
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	// This will take full command from controller
	protected function emptyCmd($cmd){
		$sql = "$cmd";
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	// protected function insert($table,$varArr=array(),$where = null){
	// 	$columKeys = implode(",", array_keys($varArr));
	// 	$columVals = implode("','", array_values($varArr));

	// 	$sql = "INSERT INTO $table($columKeys) VALUES('$columVals')";
	// 	if($where != null){
	// 		$sql .= " WHERE $where";
	// 	}
	// 	$sqlRes = $this->conn->query($sql);
	// 	return $sqlRes;
	// }


	protected function insert($table,$varArr=array()){
		$columKeys = implode(",", array_keys($varArr));
		$columVals = implode("','", array_values($varArr));

		$sql = "INSERT INTO $table($columKeys) VALUES(N'$columVals');";
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
		// $sql = $this->conn->prepare("INSERT INTO $table($columKeys) VALUES('$columVals')");
		// $sqlRes = $sql->execute();
		// return $sqlRes;

	}

	protected function update($table,$varArr=array(),$where){
		//if($this->tableExist($table)){
			foreach ($varArr as $key => $value) {
				$args[] = "$key='$value'";
			}
			$sql = ("UPDATE `$table` SET ".implode(",", $args)." WHERE $where");
			// $sql = $this->conn->prepare("UPDATE `$table` SET ".implode(",", $args)." WHERE $where");
			// $sqlRes = $sql->execute();
			$sqlRes = $this->conn->query($sql);
			return $sqlRes;
		//}
	}

	protected function delete($table,$where){
		$sql = "DELETE FROM $table WHERE $where";
		echo $sql;
	}

	protected function distinct($distVar,$table){
		$sql = "SELECT DISTINCT $distVar FROM $table";
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	protected function totDrCr($table,$where = null){
		$sql = "SELECT sum(drAmt) as drAmt, sum(crAmt) as crAmt, sum(drAmt - crAmt) as Tbal FROM $table";
		if($where != null){
			$sql .= " WHERE $where";
		}
		//echo $sql;
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	// Calculate Previous Balance for Single Accont
	public function prevBal($table,$where = null){
		$sql = "SELECT sum(drAmt - crAmt) as bal FROM $table";
		if($where != null){
			$sql .= " WHERE $where";
		}
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;

	}

	// For Director's Financial Position
	protected function finRev($sum,$fldNm,$table,$where = null){
		$sql = "SELECT $sum as $fldNm FROM $table";
		if($where != null){
			$sql .= " WHERE $where";
		}
		$sqlRes = $this->conn->query($sql);
		return $sqlRes;
	}

	protected function tableExist($table){
		$sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
		$tableInDb = $this->conn->query($sql);
		if($tableInDb->num_rows == 1){
			return true;
		}else{
			echo $this->conn->error."'$table' TABLE does not exist in Database.";
			return false;
		}
	}
}
?>
















