<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "hiroito_sushi";
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		try {
			return mysqli_connect($this->host,$this->user,$this->password,$this->database);
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo conectar a la base de datos.</p>
			<?php
			var_dump($e);
			die();
		}
	}

	function query($query) {
		try {
			return mysqli_query($this -> conn, $query);
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo ejecutar la consulta.</p>
			<?php
			var_dump($e);
			die();
		}
	}
	
	function runQuery($query) {
		$result = $this->query($query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result = $this -> query($query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function runQueryNoFetch($query) {
		$result = $this -> query($query);
		return $result;
	}
}
?>