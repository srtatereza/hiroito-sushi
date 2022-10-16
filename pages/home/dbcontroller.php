<?php
// clase que al instanciarse genera la conexion
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "hiroito_sushi";

	// constructor genera la conexion a la bbdd
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	// conecta a la bbdd
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

	// ejecuta la query
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
	
	// ejecuta la query y devuelve resultados como un array asociativo
	function runQuery($query) {
		$result = $this->query($query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	// ejecuta la query y devuelve si hay resultados (devuelve el numero de filas)
	function numRows($query) {
		$result = $this -> query($query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	// ejecuta la query pero sin el fetch
	function runQueryNoFetch($query) {
		$result = $this -> query($query);
		return $result;
	}
}
?>