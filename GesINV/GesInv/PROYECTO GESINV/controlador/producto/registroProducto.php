<?php
include_once '../../modelo/daoProducto.php';
include_once "../../modelo/conexion.php"
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<title>GesINV</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="../../vista/assets/sticky-footer-navbar.css" rel="stylesheet">
<script type="text/javascript" src="../../vista/js/jquery-3.2.1.min.js"></script>
</head>
<body>

    
<h3 class="container "> Insertar Producto </h3>


<div class="row"> 

<div class="col-12 col col-md-12"> 
<div class="container">
<form role = "form" method = "POST" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
        
        <div class="form-row"> 
        <div class="form-group col-md-6"><br> 
        <label for="nombre">  Nombre </label>
        <input name = "nombre" type = "text" class="form-control" id="nombre" placeholder="nombre">
        </div>
    </div>
    <div class="form-row"> 
    <div class="form-group col-md-6"> <br> 
        <label for="precio"> Precio </label>
        <input name = "precio" type = "number" class="form-control" id="precio" placeholder="precio">
        </div>
    
        <div class="form-group col-md-6"> <br> 
        <label for="cantidad"> Cantidad </label>
        <input name = "cantidad" type = "number" class="form-control" id="cantidad" placeholder="cantidad">
        
        <div class="form-group col-md-12"><br>  
        <label for="proveedor"> Proveedor </label>
        <input name = "proveedor" type = "text" class="form-control" id="proveedor" placeholder="proveedor">
        </div>
    </div>

    
    <div class="form-group"><br>
        <button name="insertar" type= "submit" class="btn btn-primary btn-block"> Guardar</button>
        <a href="../../vista/admin/menu.php">
            <button type="button" class="btn btn-primary">Salir</button>
    </div>
    
    </form>

</div>
</body>
</html>
<?php
    if(isset($_POST['insertar'])){

        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $proveedor=$_POST['proveedor'];
        

    $daoProducto =  new DaoArticulo();
    $reg = $daoProducto->insertArticulo($nombre,$precio,$cantidad,$proveedor);


}
?>