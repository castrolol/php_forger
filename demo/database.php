<?php
 

	class ConnectionParameters {

		public $type = "mysql";
		public $user = "root";
		public $pass = "";
		public $base 	= "sakila";
		public $host = "localhost";

		public $debug = true;



		public function prepare() {
			return "{$this->type}:host={$this->host};dbname={$this->base}";
		}

	} 
	
	$conn_params = new ConnectionParameters();

	//preparation

	$db = new PDO($conn_params->prepare(), $conn_params->user, $conn_params->pass);
	 
	if( $conn_params->debug ){
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
 
?>