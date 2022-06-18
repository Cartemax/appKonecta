<?php
require('../../modelo/ProductoModel.php');
$buscarProducto = new stdClass();
$buscarProducto->id  = "";
$buscarProducto->nombre_producto  = "";
$buscarProducto->referencia  = "";
$buscarProducto->precio  = "";
$buscarProducto->peso  = "";
$buscarProducto->categoria  = "";
$buscarProducto->stock  = "";
$buscarProducto->fecha_creacion = "";

$disabled = "";
if (isset($_GET['id'])) {
    $accion = 'Vender';
    $producto = new ProductoModel();
    $buscarProducto = $producto->buscar($_GET['id']);
    $disabled = "readonly";
} else {
    $accion = 'Nuevo';
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Formulario</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;">Producto <?php echo $accion ?></h1>

        <a href="listar.php" class="btn btn-info">Regresar</a><br><br>
        <hr>
        <form method="POST" action="../../controlador/ProductoControler.php">
            <div class="row">
                <input type="hidden" name="accion" id="accion" value="<?php echo $accion ?>">
                <input type="hidden" name="id" id="id" value="<?php echo $buscarProducto->id ?>">
                <div class="col-md-4 form-group">
                    <label>Nombre producto</label>
                    <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" value="<?php echo $buscarProducto->nombre_producto ?>" <?php echo $disabled  ?>>
                </div>
                <div class="col-md-4 form-group">
                    <label>Referencia</label>
                    <input type="text" name="referencia" id="referencia" class="form-control" value="<?php echo $buscarProducto->referencia ?>" <?php echo $disabled  ?>>
                </div>
                <div class="col-md-4 form-group">
                    <label>Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control" value="<?php echo $buscarProducto->precio ?>" <?php echo $disabled  ?>>
                </div>
                <div class="col-md-4 form-group">
                    <label>Peso</label>
                    <input type="number" name="peso" id="peso" class="form-control" value="<?php echo $buscarProducto->peso ?>" <?php echo $disabled  ?>>
                </div>
                <div class="col-md-4 form-group">
                    <label>Categoria</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" value="<?php echo $buscarProducto->categoria ?>" <?php echo $disabled  ?>>
                </div>
                <?php if ($accion == "Vender") { ?>
                    <div class="col-md-4 form-group">
                        <label>Disponible</label>
                        <input type="number" name="disponible" id="disponible" class="form-control" value="<?php echo $buscarProducto->stock ?>" <?php echo $disabled  ?>>
                    </div>
                <?php } ?>
                <div class="col-md-4 form-group">
                    <label>Cantidad</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="">
                </div>
            </div>
            <div class="col-md-12 form-group" style="margin-top: 20px;">
                <button class="btn btn-success form-control"><?php echo $accion ?></button>
            </div>
            <?php if (isset($_GET['state']) && $_GET['state'] == "actualizado") { ?>
                <div class="alert alert-success" role="alert">
                    Vendido correctamente
                </div>
            <?php } elseif (isset($_GET['state']) && $_GET['state'] == "error") { ?>
                <div class="alert alert-danger" role="alert">
                    La cantidad solicitada supera a la disponible
                </div>
            <?php } ?>
    </div>
    </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>