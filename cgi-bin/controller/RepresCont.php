<?php
include("model/model.php");

/**
 * Class relates with Representative operations
 */

class RepresCont extends Model {

	protected $messages = array();
	protected $model;
	function __construct(){
		$this->model = new Model();
	}


	// Inserting New Client
	public function nClient(){
		echo "Ok";
		// Check if any Error exists
		if(count($this->messages) > 0){
			foreach ($this->messages as $msg) {
				echo "<div class='message'>".$msg."</div>";
			}
		}
	}

	// View Total RTOs

	// public function viewClients(){
	// 	$vRtos = $this->model->fetchAll('rto');
	// 	if($vRtos->num_rows > 0){
	// 		while($row=$vRtos->fetch_assoc()){
	// 			$data[] = $row;
	// 		}
	// 		return $data;
	// 	}
	// }

}
?>