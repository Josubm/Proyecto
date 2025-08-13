<?php
session_start();
header("location:../vista/index.php");
// Destruye la sesion actual
session_destroy();
?>