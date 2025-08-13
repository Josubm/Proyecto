<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link  rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/img/GesINV.png" type="image/x-icon"/>
    <title>GesInv</title>
</head>
<body>
    <div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

    <div class="fadeIn first">
    <img src="img/GesINV.png" id="icon" alt="User Icon" />
    </div>

    <form method="post" action="" name="login">
    
    <input type="text" name="correo" class="fadeIn second"placeholder="Correo" autocomplete="off" required/>

    
    <input type="password" name="contraseña"class="fadeIn second"placeholder="Contraseña" autocomplete="off" required/>

    <div class="form-group">
    
    <div class="col-sm-12">
    
    </div>
    </div>
    <br>
    <input type="submit"  name="btn_login" class="btn btn-success btn-block" value="Login">

    



    

</div>
</div>
    </form>
    </div>
</body>
</html>

<?php

session_start();

$conexion = new mysqli('localhost', 'root', '', 'inventario');
if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
if(isset($_POST['btn_login'])){

    //  Variables $_POST[]
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    
    if($correo == "" ){ // Validamos que ningún campo quede vacío
        echo "<script>alert('Error: correo vacio !');</script>"; // Se utiliza Javascript dentro de PHP
    }else{
        //  Cadena de SQL
        $sql = "SELECT correo,contraseña FROM usuarios WHERE correo = '$correo'and contraseña='$contraseña'";

        //  Ejecuto cadena query()
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{

            //  Cuento registros obtenidos del select. 
            
            $filas = mysqli_num_rows($consulta);

            //  Comparo cantidad de registros encontrados
            if($filas == 0){
                echo "<script>alert('Error: Correo o Contraseña Incorrecto!!');</script>";
            }else{
                header('location:../vista/admin/menu.php');
                  // Si está todo correcto redirigimos a otra página
            }

        }
    }
}



?>