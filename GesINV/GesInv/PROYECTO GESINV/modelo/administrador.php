<?php
include_once 'conexion.php';


class ADMINISTRADOR extends bdconnect{

     private $id;
     private $usuario;
     private $contraseña;
     private $correo;
     

     public function __construct($id,$usuario,$contraseña,$correo)
     {
      $this->id=$id;
      $this->usuario=$usuario;
      $this->contraseña=$contraseña;
      $this->correo=$correo;
      


     }
     public function setId($id){
         $this->id=$id;}
     public function getId(){
         return $this->id;
     }

     public function setUsuario($usuario){
            $this->usuario=$usuario;}
     public function getUsuario(){
         return $this->usuario;}

     public function setContraseña($contraseña){
        $this->contraseña=$contraseña;}
     public function getContraseña(){
        return $this->contraseña;}

     public function setCorreo($correo){
         $this->correo=$correo;}
     public function getCorreo(){
         return $this->correo;}

     


     
     




}