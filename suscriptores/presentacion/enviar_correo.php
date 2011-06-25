<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../includes/error.php");
// echo "hola mundo2";
} 

header('Content-Type: text/html; charset=UTF-8');
$id=$_REQUEST['id'];
$referencia=$_REQUEST['referencia'];
$mensaje=$_REQUEST['mensaje'];
$funcionario = $_SESSION["id_usuario"]; 
$responder = $_REQUEST["responder"];  
?>
<html>
<head>
<title>Envio de correos a usuario</title>
<script>
function cerrarse(){
window.close()
}

function validar(){
 if (document.forms[0].asunto_correo.value == ""){
    alert("No se puede enviar un correo sin asunto")
    document.forms[0].asunto_correo.focus();
    return false;
  }
    else if (document.forms[0].cuerpo_correo.value == ""){
    alert("No se puede enviar un correo sin cuerpo")
    document.forms[0].cuerpo_correo.focus();
    return false;
  }
}
</script>
</head>
<?
include("../../librerias/conex.php");
include("../../includes/datos.php");
$link=Conectarse();
$encabezado=$mail_asunto;
$correo_destino = mysql_query("select email from users where id = $id ",$link);
$correo_destino = mysql_fetch_array($correo_destino);
$correo_funcionario = mysql_query("select email from users where id = $funcionario ",$link);
$correo_funcionario = mysql_fetch_array($correo_funcionario);
if ( !isset ( $_REQUEST['responder'] ) ) {}else{
$referido = mysql_query("select asunto, descripcion from servicio_cliente where id_servicio_cliente = $responder ",$link);
if (mysql_num_rows($referido)!=0){
$referido = mysql_fetch_array($referido);
$asunto=$referido[asunto]; $descripcion=$referido[descripcion]; 
$encabezado="";
								}              }
?>
<table border='0' widht=100% align='center' >
<tr><td>
<fieldset>
      <legend align='right'><font color='green' size='+1'><b>Enviar correo a <?echo $correo_destino[0]?></b></font></legend>
      <table align=center border=0>
	<form name='correo' method=POST action='../proceso/funcion_enviar_correo.php' ENCTYPE='multipart/form-data' onsubmit="return validar(this.form)">
	<tr><td><input type='hidden' name='mail_destino' value='<?echo $correo_destino[0]?>'>
				<input type='hidden' name='id' value='<?echo $id?>'>
				<input type='hidden' name='funcionario' value='<?echo $funcionario ?>'>
	<tr><td><input type='hidden' name='mail_funcionario' value='<?echo $correo_funcionario[0]?>'>
	<tr><td>Asunto:</td><td><input type='text' name='asunto_correo' id='asunto' size="60" maxlength="255" value="<? echo $encabezado ?><? echo $referencia ?><? echo $asunto ?>"></td></tr>
	<tr><td>Cuerpo:</td><td><textarea name="cuerpo_correo" cols="80" rows="15" id="cuerpo"><? echo $descripcion ?> <? echo $referencia ?><? echo $mensaje ?>












	
<? echo $mail_firma ." ".$empresa ?> 
______________________________________________________________
<? echo $aplicacion ?>
</textarea></td></tr>
	<tr><td colspan='2' align='center'>

				<input type='hidden' name='referencia' value='<?echo $responder ?>'>	
	<button name='button' type='submit' TITLE='Pulse para enviar'   value='Cargar'>Pulse para enviar el correo</button></td></tr>
	</form>
	</table>
 </fieldset>
</table>



<?php
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