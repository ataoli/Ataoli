<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 
function clientes_listado($grupo,$titulo){
$grupo=$grupo;

$id_empresa = $_SESSION['id_empresa'];
$clientes_listado .= "
						<form name='tercero_buscar_$grupo' id='tercero_buscar_$grupo' title='Se refiere a Médicos o especialistas que prestan servicios'>
						<input name='grupo' id='grupo' type='hidden' value='$grupo'><h2>$titulo</h2>
						<select name='id' size='0' onChange=\"xajax_terceros(xajax.getFormValues('tercero_buscar_$grupo'))\" >
						<option value='nuevo'>Agregar $titulo </option>
						";
$link=Conectarse(); 
mysql_query ("SET NAMES 'utf8'");
if ($grupo == "6"){ if($id_empresa != ''){
										$Clientes=mysql_query("SELECT * FROM clientes WHERE id_empresa= $id_empresa",$link);  
										if (mysql_num_rows($Clientes)!='0'){
										while( $row = mysql_fetch_array( $Clientes ) ) {
									$clientes_listado .= "<option value='".$row['id_cliente']."'>".$row['alias']." ".$row['codigo']."</option>";
																																		}
									$clientes_listado .= "<option value='nuevo'> CREAR NUEVA </option>";
																												}
																				}
									}
if ($grupo == "3"){
										$Productos=mysql_query("SELECT * FROM d9_users WHERE id_grupo ='$grupo'",$link);  
										while( $row = mysql_fetch_array( $Productos ) ) {
										$clientes_listado .= "<option value='".$row['id']."'>".$row['nombre_completo']." ".$row['documento_numero']."</option>";
																																		}
											 }
			$clientes_listado .=  "</select><input type='button' onClick=\"xajax_terceros(xajax.getFormValues('tercero_buscar_$grupo'))\" value='Agregar o Buscar'>
							</form>"; 
							
							return $clientes_listado;
																	} /// fin  de la funcion
?><?php
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