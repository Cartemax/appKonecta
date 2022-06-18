<?php
require('../modelo/ProductoModel.php');
$producto = new ProductoModel();

$accion = isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion'];

switch ($accion) {
	case 'Nuevo':
		$nombreProducto = $_POST['nombre_producto'];
		$referencia = $_POST['referencia'];
		$precio = $_POST['precio'];
		$peso = $_POST['peso'];
		$categoria = $_POST['categoria'];
		$stock = $_POST['stock'];
		$fechaCreacion = date('Y-m-d');
		$id = $producto->crear($nombreProducto, $referencia, $precio, $peso, $categoria, $stock, $fechaCreacion);

		header('Location: ../vista/producto/productoform.php?id=' . $id);

		break;

	case 'Vender':
		$id = $_POST['id'];
		$nombreProducto = $_POST['nombre_producto'];
		$referencia = $_POST['referencia'];
		$precio = $_POST['precio'];
		$peso = $_POST['peso'];
		$categoria = $_POST['categoria'];
		$stock = $_POST['stock'];
		$disponible = $_POST['disponible'];

		if ($stock > $disponible) {
			header('Location: ../vista/producto/productoform.php?id=' . $id . '&state=error');
			die;
		}

		$disponibleTotal =  $disponible - $stock;

		$vendido = $producto->vendido($id, $stock);
		$idActualizado = $producto->actualizar($nombreProducto, $referencia, $precio, $peso, $categoria, $disponibleTotal, $id);
		header('Location: ../vista/producto/productoform.php?id=' . $idActualizado . '&state=actualizado');
		break;

	case 'eliminar':
		$producto->eliminar($_GET['id'], 0);
		header('Location: ../vista/producto/listar.php');
		break;

	default:
		die('No permitido');
		break;
}
