<?php
require('conexion/conexion.php');

class ProductoModel
{
	public function listar()
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		$query = $con->prepare("SELECT * FROM producto");
		$query->execute();
		$resultado = $query->fetchAll(PDO::FETCH_OBJ);

		return $resultado;
	}

	public function buscar($id)
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		$query = $con->prepare("SELECT * FROM producto WHERE id = :id");
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$resultado = $query->fetch(PDO::FETCH_OBJ);

		return $resultado;
	}

	public function crear($nombreProducto, $referencia, $precio, $peso, $categoria, $stock, $fechaCreacion)
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		$query = $con->prepare("INSERT INTO producto (nombre_producto, referencia, precio, peso, categoria, stock, fecha_creacion) VALUES (:nombre_producto, :referencia, :precio, :peso, :categoria, :stock, :fecha_creacion)");
		$query->bindValue(':nombre_producto', $nombreProducto, PDO::PARAM_STR);
		$query->bindValue(':referencia', $referencia, PDO::PARAM_STR);
		$query->bindValue(':precio', $precio, PDO::PARAM_INT);
		$query->bindValue(':peso', $peso, PDO::PARAM_INT);
		$query->bindValue(':categoria', $categoria, PDO::PARAM_STR);
		$query->bindValue(':stock', $stock, PDO::PARAM_INT);
		$query->bindValue(':fecha_creacion', $fechaCreacion, PDO::PARAM_STR);

		$query->execute();

		$ultimoId = $con->lastInsertId();

		return $ultimoId;
	}

	public function actualizar($nombreProducto, $referencia, $precio, $peso, $categoria, $stock, $id)
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		$query = $con->prepare("UPDATE producto SET nombre_producto = :nombre_producto, referencia = :referencia, precio = :precio, peso = :peso, categoria = :categoria, stock = :stock WHERE id = :id");
		$query->bindValue(':nombre_producto', $nombreProducto, PDO::PARAM_STR);
		$query->bindValue(':referencia', $referencia, PDO::PARAM_STR);
		$query->bindValue(':precio', $precio, PDO::PARAM_INT);
		$query->bindValue(':peso', $peso, PDO::PARAM_INT);
		$query->bindValue(':categoria', $categoria, PDO::PARAM_STR);
		$query->bindValue(':stock', $stock, PDO::PARAM_INT);
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		return $id;
	}

	public function vendido($id, $cantidad)
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		$query = $con->prepare("INSERT INTO producto_vendido (id_producto, cantidad) VALUES (:id_producto, :cantidad)");
		$query->bindValue(':id_producto', $id, PDO::PARAM_STR);
		$query->bindValue(':cantidad', $cantidad, PDO::PARAM_STR);
		$query->execute();

		return $id;
	}

	public function masVendido()
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		$query = $con->prepare("SELECT p.nombre_producto, COUNT(*) as veces FROM producto_vendido pv INNER JOIN producto p ON p.id = pv.id_producto GROUP BY id_producto ORDER BY COUNT(*) DESC LIMIT 1");
		$query->execute();
		$resultado = $query->fetch(PDO::FETCH_OBJ);

		return $resultado;
	}

	public function masStock()
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		$query = $con->prepare("SELECT * FROM `producto` order by stock DESC LIMIT 1");
		$query->execute();
		$resultado = $query->fetch(PDO::FETCH_OBJ);

		return $resultado;
	}

	public function eliminar($id, $enable)
	{
		$conexion = new conexion();
		$con = $conexion->conexion();

		try {
			$query = $con->prepare("DELETE FROM producto WHERE id = :id");
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			$query->execute();

			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}
}
