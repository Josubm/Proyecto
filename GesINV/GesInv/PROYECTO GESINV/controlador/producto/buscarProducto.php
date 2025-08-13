<?php
include_once '../../modelo/daoProducto.php';

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
<link  rel="stylesheet" href="../../vista/css/autocompletar.css">

</head>
<body>
<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> 
  <a class="navbar-brand" href="#">GesINV</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"> <a class="nav-link" href="../../vista/admin/menu.php">Inicio <span class="sr-only"></span></a> </li>
        
      </ul>  
    </div>
  </nav>
</header>
<div class="container">
        <div class="col-md-6">
          <form action="" method="POST">
						<h2><b>Ingresa Codigo</b></h2>
						<div id="">

							<input  class="typeahead form-control" type="text"  name="codigoproducto" id="codigo" class="btn btn-primary"   placeholder="Ingrese Codigo">
              
              <input type="submit" name="Buscar producto" value="Buscar producto" class="btn btn-primary" id = "buscar">
              <a href="../../vista/admin/menu.php">
              <button type="button" class="btn btn-primary">Salir</button>
              </a>
						</div>
            
						
					</form>
        </div>
			<div class="col-md-6">
					<br><br>
				<h2><b>El Producto es</b></h2>
        <div class="table table-hover">          
        <table class="table table-bordered table-striped">	
            <thead class="thead-dark">
							    <tr>		
								<th width="20%">Nombre</th>
                <th width="20%">Precio</th>
                <th width="20%">Cantidad</th>
                <th width="20%">Proveedor</th>
								
							  </tr>
						</thead>
            <!--autocompletar-->
          <script src="../../vista/js/jquery-3.2.1.min.js"></script>
          <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
          <script>
              $('.typeahead').typeahead({
                  hint:true,
                  highlight:true

              },{
                    name:'datos',
                    limit:10,
                    source: function(query,sync,async){
                        $.getJSON("accion.php",{query},
                            function(data){
                            async(data);
                            }
                        );
                    },
                    display: function(item){
                        return item.codigo;
                    }
                });
                $('.typeahead').on('typeahead:selected',function(e,dato){
                    $('#codigo').val(dato.codigo);
                })
          </script>
          <!--autocompletar-->
					
          
          <?php

					error_reporting(0);
					$codigo = $_POST['codigoproducto'];
          $conectar = new bdconnect;
          $conn = $conectar->connect();
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT * from  productos where codigo = $codigo";
          $query = $conn->query($sql);
          $query -> execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
					
           if($query -> rowCount() > 0){
              foreach($results as $result){
                
                echo "
                <tr>
                <td>".$result -> nombre."</td>
                <td>".$result -> precio."</td>
                <td>".$result -> cantidad."</td>
                <td>".$result -> proveedor."</td>
                </tr>
                </table>";    
        }
    } 
   
?> 
</div>

</body>
</html>
