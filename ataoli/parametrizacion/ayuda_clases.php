<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: error.php");
// echo "hola mundo2";
} 
?>
<table border=1>
<h2>AYUDA CLASES</h2>
<tr><td>
Ayuda clases:<select name="editar_ayuda_clases" id="editar_ayuda_clases" onchange="xajax_select_editar_ayuda_clases(this.value)" size="1" style="width:250"> 
	   <option value="">Seleccionar</option> 
	   <option value="0">Crear Nuevo</option> 
<?
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
	$consulta = "SELECT id_ayuda_clase, ayuda_clase FROM ayuda_clases";
	$result=mysql_query($consulta,$link);
		while ($row = mysql_fetch_array($result)){
   			echo '<option value="'.$row['id_ayuda_clase'].'">'.$row['ayuda_clase'].'</option>';
		}
?>
</select>
<div id="capaayudaclase" name="capaayudaclase"></div>
</td></tr>
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