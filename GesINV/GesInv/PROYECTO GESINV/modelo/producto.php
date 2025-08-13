<?php
include_once 'conexion.php';


class ARTICULO extends bdconnect{

     private $codigo;
     private $nombre;
     private $precio;
     private $cantidad;
     private $proveedor;


     public function __construct($codigo,$nombre,$precio,$cantidad,$proveedor)
     {
      $this->codigo=$codigo;
      $this->nombre=$nombre;
      $this->precio=$precio;
      $this->cantidad=$cantidad;
      $this->proveedor=$proveedor;


     }
     public function setCodigo($codigo){
         $this->codigo=$codigo;}
     public function getCodigo(){
         return $this->codigo;
     }

     public function setNombre($nombre){
            $this->nombre=$nombre;}
     public function getNombre(){
         return $this->nombre;}

     public function setPrecio($precio){
        $this->precio=$precio;}
     public function getPrecio(){
        return $this->precio;}

     public function setCantidad($cantidad){
         $this->cantidad=$cantidad;}
     public function getCantidad(){
         return $this->cantidad;}

     public function setProveedor($proveedor){
         $this->proveedor=$proveedor;}
     public function getProveedor(){
     return $this->proveedor;}


     
     




}