<?php
include_once 'conexion.php';


class DaoAdministraodor extends bdconnect{

    function showResults(){
        return $this->connect()->query('SELECT * FROM usuarios');
    }


function insertUsuario($id,$usuario,$correo,$contraseña){
    try {
    //Crear la conexión
    $conn = $this->connect();
    // Configurando la información de errores PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //haciendo la consulta 
    //usando Sentencias Preparadas 'Prepared Statement'
    $sql = $conn->prepare ("INSERT INTO usuario (id,usuario,correo,contraseña) VALUES (:id, :usuario, :correo,:contraseña)");
    //bindamos' ó enlazamos los registros con bindParam
    
    $sql -> bindParam(':id', $id);
    $sql -> bindParam(':usuario', $usuario);
    $sql -> bindParam(':correo', $correo);
    $sql -> bindParam(':contraseña', $contraseña);


    $sql->execute();

    
    }
    //para un try tiene que existir un catch que atrapa las exceptions
    catch(PDOException )
    {
    
    }
    //Cerramos la conexion
    $conn = null;

    }


  function updateUsuario($id,$usuario,$correo,$contraseña){
        try{
            $conn = $this->connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("UPDATE usuarios SET usuario = :usuario,
                                                        correo = :precio,
                                                        contraseña = :contraseña,
                                                        
                                                   WHERE id = :id"); 
            $sql -> bindParam(':id', $id);
            $sql -> bindParam(':usuario', $usuario);
            $sql -> bindParam(':correo', $correo);
            $sql -> bindParam(':contraseña', $contraseña);
            


            $sql->execute();
            $sql->rowCount() . " registros Actualizados Satisfactoriamente";
        return  $sql->rowCount();
        }catch(PDOException $error)
            {
              echo "El error sería: <br>" . $error->getMessage();
            }
     $conn = null;
    }

function deleteArticulo($id){
    try {
        $conn = $this->connect();    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = "DELETE FROM usuarios WHERE id = :id";
       
        $sql = $conn->prepare($consulta);
        $sql->bindParam(':id', $id);
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
        $sql = $conn->prepare("SELECT * FROM usuarios"); 
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