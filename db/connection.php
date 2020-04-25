<?php
class DBController {
	private $host = "ec2-54-217-204-34.eu-west-1.compute.amazonaws.com";
	private $user = "oyijacadevrbil";
	private $password = "30314420914279ba0cbc537c5a2f51049eb424ff19572feb28eff4e893c19209";
	private $database = "df44e8a8hptq90";
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