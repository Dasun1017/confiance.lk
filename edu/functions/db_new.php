<?php
class DBController {
	private $host = '$site_host';
	private $user = '$site_user';
	private $password = '$site_pass';
	private $database = '$site_db';
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = new mysqli($this->host,$this->user,$this->password);
		return $conn;
	}
	
	function selectDB($conn) {
		$conn->select_db($this->database);
	}
	
	function runQuery($query) {
		$result = $conn->query($query);
		while($row=$result->fetch_assoc()) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = $conn->query($query);
		$rowcount = $result->num_rows;
		return $rowcount;	
	}
}
?>