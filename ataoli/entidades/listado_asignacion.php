<?php
function listado($estado,$id){
$id_empresa=$_SESSION['id_empresa'];
$link=Conectarse(); 
mysql_query ("SET NAMES 'utf8'");
if(func_num_args() > 2 ){
if(func_get_arg(2)=='empresa'){$grupo_empresa ='GROUP BY nit';}
}
echo "<select name='id_cliente' size='0' >"; 
if ($id!='0'){

$tipo_definido=mysql_query("SELECT * FROM clientes WHERE id_empresa=$id_empresa AND estado ='$estado' $w AND id_cliente = '$id'",$link);
if(mysql_num_rows($tipo_definido) >0) {


while( $row = mysql_fetch_array( $tipo_definido ) ) {
echo "<option value='".$row['id_cliente']."' selected> > ".$row['alias']." [ $row[numero_contrato] ]< </option>";

																}

													}

					}
else {echo "<option value='' selected>EPS o aseguradora</option>"; }
$Productos=mysql_query("SELECT * FROM clientes WHERE id_empresa=$id_empresa AND  estado ='$estado' $w $grupo_empresa ORDER BY alias  ASC",$link);

if(mysql_num_rows($Productos) >0) {


while( $row = mysql_fetch_array( $Productos ) ) {
if(func_num_args() > 2 ){
if(func_get_arg(2)!='empresa'){$contrato ="[$row[numero_contrato]]";}
}
echo "<option value='".$row['id_cliente']."'> ".$row['alias']."  $contrato </option>";

}
echo "</select>"; 
												}
												else {echo "<img src='images/atencion.gif' alt='!' title='No hay informacion sobre la EPS o aseguradora '>No hay informaci&oacute;n de EPS";}
} 
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