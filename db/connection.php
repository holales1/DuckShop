<?php
class DBController {
	private $host = "localhost";
	private $user = "alex";
	private $password = "1234";
	private $database = "duckshop";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$results[] = $row;
		}		
		if(!empty($results))
			return $results;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function escapeSql($stringEscape){
		$escapedString=trim(mysqli_real_escape_string($this->conn, $stringEscape));
		return $escapedString;
	}

	function selectLogin($query){
		$result  = mysqli_query($this->conn,$query);
		return $result;
	}

	function insertRow($query){
		$result = mysqli_query($this->conn, $query);
		return $result;
	}

}
?>