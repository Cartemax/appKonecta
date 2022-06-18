<?php
class conexion{

	public function conexion(){
		try {
			$con = new PDO('mysql:host=localhost;dbname=konecta', 'root', '');
		} catch (PDOException $e) {
			print "¡Error!: " . $e->getMessage() . "<br/>";
			die();
		}

		return $con;
	}
}
?>