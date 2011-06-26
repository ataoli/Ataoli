<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola 2";
} 
require("funciones/geo.php");
echo geocoder_direccion("carrera    6 No 12-70 barrio centro sur");
?>