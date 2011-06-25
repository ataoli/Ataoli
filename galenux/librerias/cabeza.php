<?php 
session_start();
// Comprobamos si existe la variable
include_once("includes/config.php"); 
if (
$_SESSION[$usuarios_sesion] != $usuarios_sesion
//!isset ( $_SESSION['grupo'] )
 ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 
include_once("librerias/conex.php"); 
$link=Conectarse(); 
$usuario=$_SESSION['usuario'];
$id_funcionario=$_SESSION['id_usuario'];
$horas=date('H');
$hora=date('g');
$ap=date('A');
$minutos=date('i');
$minutos_dia=(($horas*60));
$total_minutos_dia=(($horas*60)+$minutos);
$ahora=date('Y-m-d H:i:s');
$hoy=date('Y-m-d');
list( $ano, $mes, $dia ) = explode( '[-]', $hoy );
$fecha_comas = $ano.",".$mes.",".$dia;
$hoy_timestamp=mktime(0,0,0, $mes, $dia, $ano);


include_once("includes/datos.php");


?>
<?
//incluímos la clase ajax
require ('../xajax/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();

require ('includes/funciones_XAJAX.php');

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequests();
?>
<html xmlns="http://www.w3.org/1999/xhtml"xml:lang="es" lang="es" dir="ltr">
<head>
 <? $xajax->printJavascript("../xajax/");  ?>
<script language="JavaScript" src="librerias/scripts.js" type="text/javascript"></script>
 <title><? echo " // $_SESSION[$usuarios_sesion] // $usuarios_sesion //$empresa $aplicacion $page $usuario";  ?> </title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="estilos/estilo.css" rel="stylesheet" type="text/css">
  <link href="estilos/galenux.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="favicon.ico">
<script>
function pulsar(e) {
	tecla=(document.all) ? e.keyCode : e.which;
  if(tecla==13) return false;
}
</script>
 </head>
<body document.onkeydown = stopRKey; style='height: 100%;'  onkeypress="return pulsar(event)" >
<div style="position: absolute; visibility: visible; " id="capa_ping"></div>
<table style="text-align: left; margin-left: auto; margin-right: auto; width: 100%; height: 48px;" border="0" cellpadding="0" cellspacing="0">
 <tr>
 	<td></td>
 	<td colspan='3' style='background:#ffffff; '  valign='top'>
     
  <?php include("includes/menu_horizontal.php"); 
  include("includes/inicio.php");
$control_version = '0aa0b6b3207f0b3839381db1962574a2'; 
/*  ATENCION: Puede existir una versión mas reciente de este archivo en http://GaleNUx.com
    por favor compruebelo antes de modificarlo. control de versión [0aa0b6b3207f0b3839381db1962574a2]
    
    Copyright ©  13-22-2/ 17-Dic-2008 Dirección nacional de derechos de autor Colombia 
    http://GaleNUx.com Es un sistema para de información para la salud adaptado al sistema
    de salud Colombiano.
    
    Si necesita consultoría o capacitación en el manejo, instalación y/o soporte o 
    ampliación de prestaciones de GaleNUx por favor comuniquese con nosotros 
    al email praxis@galenux.com.

    Este programa es software libre: usted puede redistribuirlo y/o modificarlo 
    bajo los términos de la Licencia Pública General GNU publicada 
    por la Fundación para el Software Libre, ya sea la versión 3 
    de la Licencia, o cualquier versión posterior.

    Este programa se distribuye con la esperanza de que sea útil, pero 
    SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita 
    MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO. 
    Consulte los detalles de la Licencia Pública General GNU para obtener 
    una información más detallada. 

    Debería haber recibido una copia de la Licencia Pública General GNU 
    junto a este programa. 
    En caso contrario, consulte <http://www.gnu.org/licenses/>.
    
    POR FAVOR CONSERVE ESTA NOTA SI EDITA ESTE ARCHIVO

 */ 
?>