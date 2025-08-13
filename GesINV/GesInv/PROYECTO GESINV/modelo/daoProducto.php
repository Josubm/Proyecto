<?php
include_once 'conexion.php';


class DaoArticulo extends bdconnect{

    function showResults(){
        return $this->connect()->query('SELECT * FROM productos');
    }


function insertArticulo($nombre,$precio,$cantidad,$proveedor){
    try {
    //Crear la conexión
    $conn = $this->connect();
    // Configurando la información de errores PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //haciendo la consulta 
    //usando Sentencias Preparadas 'Prepared Statement'
    $sql = $conn->prepare ("INSERT INTO productos (nombre,precio,cantidad,proveedor) VALUES (:nombre, :precio, :cantidad,:proveedor)");
    //bindamos' ó enlazamos los registros con bindParam
    
    $sql -> bindParam(':nombre', $nombre);
    $sql -> bindParam(':precio', $precio);
    $sql -> bindParam(':cantidad', $cantidad);
    $sql -> bindParam(':proveedor', $proveedor);


    $sql->execute();

    
    }
    //para un try tiene que existir un catch que atrapa las exceptions
    catch(PDOException )
    {
    
    }
    //Cerramos la conexion
    $conn = null;

    }


  function updateArticulo($codigo,$nombre,$precio,$cantidad,$proveedor){
        try{
            $conn = $this->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("UPDATE productos SET nombre = :nombre,
                                                        precio = :precio,
                                                        cantidad = :cantidad,
                                                        proveedor= :proveedor
                                                   WHERE codigo = :codigo"); 
            $sql -> bindParam(':codigo', $codigo);
            $sql -> bindParam(':nombre', $nombre);
            $sql -> bindParam(':precio', $precio);
            $sql -> bindParam(':cantidad', $cantidad);
            $sql -> bindParam(':proveedor', $proveedor);


            $sql->execute();
            $sql->rowCount() . " registros Actualizados Satisfactoriamente";
        return  $sql->rowCount();
        }catch(PDOException $error)
            {
              echo "El error sería: <br>" . $error->getMessage();
            }
     $conn = null;
    }

function deleteArticulo($codigo){
    try {
        $conn = $this->connect();    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = "DELETE FROM productos WHERE codigo = :codigo";
       
        $sql = $conn->prepare($consulta);
        $sql->bindParam(':codigo', $codigo);
        $sql->execute();
        return $sql->rowCount();
        }
    catch(PDOException $error)
        {
        echo $consulta . "<br>" . $error->getMessage();
        }
    $conn = null;
    }

 
function listar(){
  

    try {
        $conn = $this->connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $conn->prepare("SELECT * FROM productos"); 
        $sql->execute();
        $resultado = $sql->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new listarTabla(new RecursiveArrayIterator($sql->fetchAll())) as $key=>$valor) { 
            echo $valor;
        }
    }
    catch(PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
    $conexion = null;
    echo "</table>";
    }
    
    }
        
    class listarTabla extends RecursiveIteratorIterator { 
       function __construct($esto) { 
            parent::__construct($esto, self::LEAVES_ONLY); 
         }
        
        function current() {
             return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }
        
        function beginChildren() { 
            echo "<tr>"; 
        } 
        
        function endChildren() { 
            echo "</tr>" . "\n";
        } 
    }
   


?>