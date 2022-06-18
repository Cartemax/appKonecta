<?php
require('../../modelo/ProductoModel.php');
$producto = new ProductoModel();
$productos = $producto->listar();
$masVendido = $producto->masVendido();
$masStock = $producto->masStock();
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<title>Listar</title>
</head>

<body>
	<div class="container">
		<h1 style="text-align: center;">Listar</h1>
		<hr>
		<div class="row">
			<div class="col-md-2">
				<a href="../../index.php" class="btn btn-info">Inicio</a>
			</div>
			<div class="col-md-2">
				<a href="productoform.php" class="btn btn-primary">Nuevo</a>
			</div>
		</div>

		<hr><br>
		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nombre producto</th>
					<th>Referencia</th>
					<th>Precio</th>
					<th>Peso</th>
					<th>Categoria</th>
					<th>Cantidad disponible</th>
					<th>Fecha creación</th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($productos as $key => $value) { ?>
					<tr>
						<td><?php echo $key; ?></td>
						<td><?php echo $value->nombre_producto; ?></td>
						<td><?php echo $value->referencia; ?></td>
						<td><?php echo $value->precio; ?></td>
						<td><?php echo $value->peso; ?></td>
						<td><?php echo $value->categoria; ?></td>
						<td><?php echo $value->stock; ?></td>
						<td><?php echo $value->fecha_creacion; ?></td>
						<td><a href="productoform.php?id=<?php echo $value->id; ?>" class="btn btn-warning">Vender</a></td>
						<td><a href="productoform.php?id=<?php echo $value->id; ?>&editar=true" class="btn btn-info">Editar</a></td>
						<td><a href="../../controlador/ProductoControler.php?id=<?php echo $value->id; ?>&accion=eliminar" class="btn btn-danger">Eliminar</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

		<?php if (isset($masVendido)) { ?>
			<div class="col-md-12">
				<div class="alert alert-primary" role="alert">
					<span>Las mayores ventas: <?php echo $masVendido->nombre_producto ?> - Cantidad de veces: <?php echo $masVendido->veces ?></span>
				</div>
			</div>
		<?php } ?>
		<?php if (isset($masStock)) { ?>
			<div class="col-md-12">
				<div class="alert alert-primary" role="alert">
					<span>Mayo stock: <?php echo $masStock->nombre_producto ?> - Cantidad: <?php echo $masStock->stock ?></span>
				</div>
			</div>
		<?php } ?>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>