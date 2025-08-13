<?php


$pdo=new PDO('mysql:host=localhost;dbname=inventario;charset-utf8','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$like="'"."%".$_GET["query"]."%"."'";
$sql= "SELECT * FROM productos WHERE codigo LIKE $like";

$stm=$pdo->prepare($sql);
$stm->execute();
$res=$stm->fetchAll(PDO::FETCH_OBJ);

echo json_encode($res);





?>







