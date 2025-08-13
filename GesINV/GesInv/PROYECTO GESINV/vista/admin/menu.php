<?php

include_once '../../modelo/daoproducto.php';




?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<title>GesINV</title>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<link href="../../vista/assets/sticky-footer-navbar.css" rel="stylesheet">
<script type="text/javascript" src="../../vista/js/jquery-3.2.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            $(".content").fadeOut(1500);
        },3000);
    });

    </script>
</head>
<body>
<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> 
  <a class="navbar-brand" href="#">GesINV </a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"> <a class="nav-link" href="menu.php">Inicio <span class="sr-only"></span></a> </li>
        
      </ul>  
    </div>
  </nav>
</header>
<div class="container">
<?php
    if(isset($_POST['eliminar'])){
        $codigo=$_POST['codigo'];
        

    $daoProducto =  new DaoArticulo();
    $reg = $daoProducto->deleteArticulo($codigo);



    if($reg > 0 ) {
        echo "<div class='content alert alert-primary'> Gracias : $reg registro ha sido eliminado </div>";
    }

        else{
            echo "<div class='content alert alert-danger'> No se pudo eliminar el registro </div>";
        }
    }
?>













<ul class="nav nav-pills">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Inicio</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="../../controlador/cerrar_seccion.php">Cerrar Seccion</a>

    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Productos</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="../../controlador/producto/buscarProducto.php">Buscar Productos</a>
      <a class="dropdown-item" href="../../controlador/producto/registroProducto.php">Registrar Productos</a>
      

    </div>

  
</ul>


<?php

    if(isset($_POST['actualizar'])){
        $codigo= $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $proveedor= $_POST['proveedor'];
      

        $daoProducto =  new DaoArticulo();
        $reg = $daoProducto->updateArticulo($codigo,$nombre,$precio,$cantidad,$proveedor);

            if ($reg >0)
            {
                echo "<div class=´ content alert alert-primary´>
                Gracias : $reg registro ha sido actualizado </div>";
            }
            else{
                echo "<div class=´ content alert alert-danger' > $reg No se pudo Actualizar el registro </div>";
            }

    }
?>

<?php 

    if(isset($_POST['editar'])){
        $codigo = $_POST['codigo'];
        $sql = "SELECT * FROM productos WHERE codigo = :codigo";

        $conectar = new  bdconnect;
        $conn = $conectar->connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR,10);
        $stmt->execute();
  
      $obj = $stmt->fetchObject();
?>



<div class="col-12 col col-md-12"> 

<form role = "form" method = "POST" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
<input value = "<?php echo $obj->codigo ;?>" name = "codigo" type="hidden">
    <div class="form-row"> 

    <div class="form-group col-md-6">  
    <label for="nombre"> Nombre </label>
    <input value = "<?php echo $obj->nombre?>" name = "nombre" type = "text" class="form-control" id="nombre" placeholder="nombre">
    </div>
   </div>
 <div class="form-row"> 
   <div class="form-group col-md-6">  
    <label for="precio"> Precio </label>
    <input value = "<?php echo $obj->precio; ?>" name = "precio" type = "text" class="form-control" id="precio" placeholder="precio">
    </div>
    <div class="form-row"> 
   <div class="form-group col-md-6">  
    <label for="cantidad"> Cantidad </label>
    <input value = "<?php echo $obj->cantidad; ?>" name = "cantidad" type = "text" class="form-control" id="cantidad" placeholder="cantidad">
    </div>

    <div class="form-group col-md-6">  
    <label for="proveedor"> Proveedor </label>
    <input value = "<?php echo $obj->proveedor; ?>" name = "proveedor" type = "text" class="form-control" id="proveedor" placeholder="proveedor">
    </div>
    

 <div class="form-group"> 
    <button name="actualizar" type= "submit" class="btn btn-primary btn-block">Actualizar Registro</button>
    
 </div>
 <div class="form-group col-md-4">
 <button name="cancelar" type= "submit" class="btn btn-primary btn-block">Cancelar</button>
 </div>
 </form>
</div>

<?php 
} 
?>
 











<div class="table table-hover">  
    <table class="table table-bordered table-striped"> 
        <thead class="thead-dark">
                <th width="28%">Codigo</th>
                <th width="20%">Nombre</th>
                <th width="20%">Precio</th>
                <th width="20%">Cantidad</th>
                <th width="20%">Proveedor</th>    
        </thead>
        <tbody>

<?php 

    $conectar = new bdconnect;
    $conn = $conectar->connect();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM productos";
    $query = $conn->query($sql);
    $query -> execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);


    if($query -> rowCount() > 0){
        foreach($results as $result){
            echo "<tr>
                <td>".$result -> codigo."</td>
                <td>".$result -> nombre."</td>
                <td>".$result -> precio."</td>
                <td>".$result -> cantidad."</td>
                <td>".$result -> proveedor."</td>
                
                

                </td>
                <td> 
                <form onsubmit=\"return confirm('Realmente desea eliminar el registro?';\"method='POST' action='".$_SERVER['PHP_SELF']."'>   
                    <input type='hidden' name='codigo' value = '".$result->codigo."'>
                    <button   name='eliminar'class='btn btn-danger' > <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                    <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                  </svg></button>
                    
                    
                    </form>
                  <td> 
                    <form method='POST' action='".$_SERVER['PHP_SELF']."'>
                    <input type='hidden' name='codigo' value = '".$result->codigo."'>
                    <button name='editar'class='btn btn-primary' ><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                  </svg></button>
                    </form>
                </td>

                </td>   
                </td>   
            </tr>";    
        }
    }
?> 

            </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>



<script src="../../vista/js/bootstrap.min.js"></script>    
</body>
</html>