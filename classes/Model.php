<?php
class Model{
    
	function __construct(){
		//echo "this is model";
	}
	public function connect(){

		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "db_test";
		
		$conn = @mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
		return $conn;
	}
}
?>