<?php
/*
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../includes/error.php");
// echo "hola 2";
} 
//define('FPDF_FONTPATH','../font/');
//require('../includes/fpdf.php');
*/
$control =$_REQUEST[doc];
include_once("../librerias/conex_anonimo.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query("SELECT * FROM publicacion_contenido WHERE control = '$control' ",$link);

$titulo=mysql_result($sql,0,"titulo");
$encabezado=mysql_result($sql,0,"encabezado");
$contenido=utf8_decode(mysql_result($sql,0,"contenido"));
$pie=mysql_result($sql,0,"pie");
$id_usuario=mysql_result($sql,0,"id_usuario");
echo $titulo;
echo $encabezado;
echo $contenido;
echo $pie;

?>