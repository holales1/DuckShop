<?php
class DBController {
	private $host = "localhost";
<<<<<<< HEAD
	private $user = "alex";
	private $password = "1234";
=======
	private $user = "Nikos";
	private $password = "12345";
>>>>>>> e5ef2446fe73d8ad68634e8eacf8cd31659a4031
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
}
?>