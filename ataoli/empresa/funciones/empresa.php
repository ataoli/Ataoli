<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location:  includes/error.php");
// echo "hola mundo2";
} 
function empresa_formulario($origen){
//// se añade control en triage para que solo el administrador pueda crear o modificar la empresa
if ($_SESSION['prioridad'] >= "5"){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$id_usuario = $_SESSION['id_usuario'];
$sql=mysql_query("SELECT * 
									FROM empresa
									WHERE empresa_responsable = '$id_usuario' 
									
									LIMIT 1",$link);
$datos=mysql_query("SELECT * 
									FROM d9_users
									WHERE id = '$id_usuario' 
									
									LIMIT 1",$link);

									
if (mysql_num_rows($datos)!='0'){
$documento_numero=mysql_result($datos,0,"documento_numero");
$direccion_usuario=mysql_result($datos,0,"direccion");
$telefono_fijo=mysql_result($datos,0,"telefono_fijo");
$email_usuario=mysql_result($datos,0,"email");
$p_apellido=mysql_result($datos,0,"p_apellido");
$genero=mysql_result($datos,0,"genero");
$departamento_usuario=mysql_result($datos,0,"departamento");
$pais_usuario=mysql_result($datos,0,"pais");
$ciudad_usuario=mysql_result($datos,0,"ciudad");
if($genero=='M'){$tratamiento="DEL DÓCTOR";}
if($genero=='F'){$tratamiento="DE LA DÓCTORA";}
																}
$empresa_formulario .="

<form name='empresa' id='empresa'>
<input type='hidden' value='empresa' id='formulario' name='formulario'>
<input type='hidden' value='$origen' id='origen' name='origen'>

<div id='capa_empresa'>

	<table cellpadding='0' cellspacing='0' border='0' align='center'>
		<tr>
			<td>
			<table>
					";


if (mysql_num_rows($sql)!='0'){
$razon_social=mysql_result($sql,0,"razon_social");
$codigo_empresa=mysql_result($sql,0,"codigo_empresa");
$sigla=mysql_result($sql,0,"sigla");
$slogan=mysql_result($sql,0,"slogan");
$nit=mysql_result($sql,0,"nit");
$direccion=mysql_result($sql,0,"direccion");
$telefono_1=mysql_result($sql,0,"telefono_1");
$telefono_2=mysql_result($sql,0,"telefono_2");
$telefono_3=mysql_result($sql,0,"telefono_3");
$fax=mysql_result($sql,0,"fax");
$email=mysql_result($sql,0,"email");
$web=mysql_result($sql,0,"web");
$persona_contacto=mysql_result($sql,0,"persona_contacto");
$regimen_tributario=mysql_result($sql,0,"regimen_tributario");
$resolucion_facturacion=mysql_result($sql,0,"resolucion_facturacion");
$facturacion_prefijo=mysql_result($sql,0,"facturacion_prefijo");
							if ($facturacion_fecha != ''){	$facturacion_fecha = date('Y-m-d',$facturacion_fecha);}
							if ($facturacion_vencimiento != ''){$facturacion_vencimiento = date('Y-m-d',$facturacion_vencimiento);}
$facturacion_desde=mysql_result($sql,0,"facturacion_desde");
$facturacion_hasta=mysql_result($sql,0,"facturacion_hasta");
$facturacion_primera=mysql_result($sql,0,"facturacion_primera");
$pais=mysql_result($sql,0,"pais");
$departamento=mysql_result($sql,0,"departamento");
$ciudad=mysql_result($sql,0,"ciudad");
	$empresa_formulario .= "<tr tittle='Debe incluir algunos datos necesarios para facturación y RIPS'><td colspan='2'><div align='center'><h2 >Asistente para la edición de la empresa</h2></div></td></tr>";
	
	}else{
			$empresa_formulario .= "<tr tittle='Debe incluir algunos datos necesarios para facturación y RIPS'><td colspan='2'><div align='center'><h2 >Asistente para la creación de la empresa</h2></div></td></tr>";
				}
				 
$empresa_formulario .= "	<tr><td align='right'></td><td><b>Información general</b></td></tr>";
if($razon_social ==''){$razon_social= "CONSULTORIO $tratamiento $p_apellido ";}
$empresa_formulario .= "	<tr><td align='right'>Razón social: </td><td><input type='text' size='60' name='razon_social' id='razon_social'  value='$razon_social'></td></tr>";

if($persona_contacto ==''){$persona_contacto= $_SESSION['nombre_completo'];}
$empresa_formulario .= "	<tr><td align='right'>Representante Legal: </td><td><input type='text' size='60' name='persona_contacto' id='persona_contacto'  value='$persona_contacto'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Código habilitación: </td><td><input type='text' size='60' name='codigo_empresa' id='codigo_empresa'  value='$codigo_empresa'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Sigla: </td><td><input type='text' size='60' name='sigla' id='sigla'  value='$sigla'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Slogan o lema: </td><td><input type='text' size='60' name='slogan' id='slogan'  value='$slogan'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Ubicación: </td><td>";
if($pais ==''){$pais= $pais_usuario;}
if($departamento ==''){$departamento= $departamento_usuario;}
if($ciudad ==''){$ciudad= $ciudad_usuario;}
$empresa_formulario .= mundo("empresa","$pais","$departamento","$ciudad"); 
$empresa_formulario .= "	</td></tr>";
//$empresa_formulario .= "	<tr><td align='right'>Departamento: </td><td><input type='text' size='60' name='departamento' id='departamento'  value='$departamento'></td></tr>";
//$empresa_formulario .= "	<tr><td align='right'>Ciudad: </td><td><input type='text' size='60' name='ciudad' id='ciudad'  value='$ciudad'></td></tr>";
if($direccion ==''){$direccion= $direccion_usuario;}
$empresa_formulario .= "	<tr><td align='right'>Dirección: </td><td><input type='text' size='60' name='direccion' id='direccion'  value='$direccion'></td></tr>";
if($telefono_1 ==''){$telefono_1= $telefono_fijo;}
$empresa_formulario .= "	<tr><td align='right'>Teléfono: </td><td><input type='text' size='60' name='telefono_1' id='telefono_1'  value='$telefono_1'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Teléfono: </td><td><input type='text' size='60' name='telefono_2' id='telefono_2'  value='$telefono_2'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Teléfono: </td><td><input type='text' size='60' name='telefono_3' id='telefono_3'  value='$telefono_3'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Fax: </td><td><input type='text' size='60' name='fax' id='fax'  value='$fax'></td></tr>";
if($email ==''){$email= $email_usuario;}
$empresa_formulario .= "	<tr><td align='right'>Email: </td><td><input type='text' size='60' name='email' id='email'  value='$email'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Página web: </td><td><input type='text' size='60' name='web' id='web'  value='$web'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'></td><td><b>Información tributaria</b></td></tr>";
if($nid ==''){$nit= $documento_numero;}
$empresa_formulario .= "	<tr><td align='right'>Nit: </td><td><input type='text' size='20' name='nit' id='nit'  value='$nit'></td></tr>";
$empresa_formulario .= "	<tr><td align='right'>Régimen tributario: </td><td><input type='text' size='20' name='regimen_tributario' id='regimen_tributario'  value='$regimen_tributario'></td></tr>";

$empresa_formulario .= "	<tr><td align='right'>Resolución de facturación: </td><td><input type='text' size='12' name='resolucion_facturacion' id='resolucion_facturacion'  value='$resolucion_facturacion'> 
																	Fecha: <input READONLY size='10' id='fc_fecha_resolucion'  title='YYYY-MM-DD' onClick=\"displayCalendar(this);\"  type='text'  name='facturacion_fecha'  value='$facturacion_fecha'>
																	Vencimiento: <input type='text' size='10' name='facturacion_vencimiento' READONLY size='10' id='fc_fecha_vencimiento'  title='YYYY-MM-DD' onClick=\"displayCalendar(this);\"  value='$facturacion_vencimiento'></td></tr>";

$empresa_formulario .= "	<tr><td align='right'>Numeración de facturas: Prefijo: <input type='text' size='3' name='facturacion_prefijo' id='facturacion_prefijo'  value='$facturacion_prefijo'></td><td>
																																	
																																	Inicio: <input type='text' size='10' name='facturacion_desde' id='facturacion_desde'  value='$facturacion_desde'> 
																																	Fin: <input type='text' size='10' name='facturacion_hasta' id='facturacion_hasta'  value='$facturacion_hasta'> 
																																	Primera: <input type='text' size='10' name='facturacion_primera' id='facturacion_primera'  value='$facturacion_primera'></td></tr>";


														
															
			
			
 $empresa_formulario .= "
				
						
						
						
					</tr>
				</table>
				<hr>
				<div align='center'>
				<input type='button' value='Grabar los datos' onClick=\"xajax_modificar_empresa(xajax.getFormValues('empresa'))\">
				</div>
				</div>
			</td>
		</tr>
	</table>
	</form>
										";
										
										}///fin del control por prioridad
										return $empresa_formulario;
	}/// fin de la funciona empresa

/// Funcion modificar_empresa
function modificar_empresa($empresa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_empresa = $_SESSION['id_empresa'];
/// variables del formulario

$codigo_empresa = $empresa["codigo_empresa"];
$razon_social = $empresa["razon_social"];
$sigla = $empresa["sigla"];
$slogan = $empresa["slogan"];
$nit = $empresa["nit"];
$direccion = $empresa["direccion"];
$telefono_1 = $empresa["telefono_1"];
$web = $empresa["web"];
$email = $empresa["email"];
$persona_contacto = $empresa["persona_contacto"];
$regimen_tributario = $empresa["regimen_tributario"];
$resolucion_facturacion = $empresa["resolucion_facturacion"];
$facturacion_desde = $empresa["facturacion_desde"];
$facturacion_hasta = $empresa["facturacion_hasta"];
$facturacion_primera = $empresa["facturacion_primera"];
$facturacion_prefijo = $empresa["facturacion_prefijo"];
$facturacion_fecha = $empresa["facturacion_fecha"];
$origen = $empresa["origen"];
if($facturacion_fecha !=''){
list( $ano, $mes, $dia ) = split( '[-]', $facturacion_fecha );
$facturacion_fecha=mktime(0,0,0, $mes, $dia, $ano);
														}
$facturacion_vencimiento = $empresa["facturacion_vencimiento"];
if($facturacion_vencimiento !=''){
list( $ano, $mes, $dia ) = split( '[-]', $facturacion_vencimiento );
$facturacion_vencimiento=mktime(0,0,0, $mes, $dia, $ano);
																	}
$telefono_2 = $empresa["telefono_2"];
$telefono_3 = $empresa["telefono_3"];
$fax = $empresa["fax"];
$pais = $empresa["cod_pais"];
$departamento = $empresa["cod_departamento"];
$ciudad = $empresa["cod_ciudad"];
$logo_color = $empresa["logo_color"];
$logo_bn = $empresa["logo_bn"];
$logo_alta = $empresa["logo_alta"];
$logo_baja = $empresa["logo_baja"];
$css = $empresa["css"];
$css_impresion = $empresa["css_impresion"];
$empresa_responsable = $_SESSION['id_usuario'];

/// fin variables del formulario

//// se añade control en triage para que solo el administrador pueda crear o modificar la empresa
if ($_SESSION['prioridad'] >= "5"){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
// se consulta la empresa del usuario actualizado
$sql=mysql_query("SELECT * FROM empresa WHERE empresa_responsable = '$empresa_responsable' LIMIT 1",$link);
/// si la empresa no existe se crea
if (mysql_num_rows($sql)=='0'){

						mysql_query("INSERT INTO `empresa` (
`empresa_responsable`, 
`codigo_empresa`, 
`razon_social`, 
`sigla`, 
`slogan`, 
`nit`, 
`direccion`, 
`telefono_1`, 
`web`, 
`email`, 
`persona_contacto`, 
`regimen_tributario`, 
`resolucion_facturacion`, 
`facturacion_desde`, 
`facturacion_hasta`, 
`facturacion_primera`, 
`facturacion_prefijo`, 
`facturacion_fecha`, 
`facturacion_vencimiento`, 
`telefono_2`, 
`telefono_3`, 
`fax`, 
`pais`, 
`departamento`, 
`ciudad`, 
`logo_color`, 
`logo_bn`, 
`logo_alta`, 
`logo_baja`, 
`css`, 
`css_impresion`) 
VALUES (
'$empresa_responsable', 
'$codigo_empresa', 
'$razon_social', 
'$sigla', 
'$slogan', 
'$nit', 
'$direccion ', 
'$telefono_1', 
'$web', 
'$email', 
'$persona_contacto', 
'$regimen_tributario', 
'$resolucion_facturacion', 
'$facturacion_desde', 
'$facturacion_hasta', 
'$facturacion_primera', 
'$facturacion_prefijo', 
'$facturacion_fecha', 
'$facturacion_vencimiento', 
'$telefono_2 ', 
'$telefono_3', 
'$fax', 
'$pais', 
'$departamento', 
'$ciudad', 
'$logo_color', 
'$logo_bn', 
'$logo_alta', 
'$logo_baja', 
'$css',
'$css_impresion')",$link);     

$resultado= "Creada";

$id_usuario = $_SESSION['id_usuario'];
$empresa=mysql_query("SELECT * FROM empresa WHERE empresa_responsable = '$id_usuario' LIMIT 1",$link);
if (mysql_num_rows($empresa)!='0'){
$id_empresa=mysql_result($empresa,0,"id_empresa");

//    session_register("autentificado"); 
	$_SESSION['id_empresa'] = "$id_empresa";
																	}
																		}else
			/// si ya existe la empresa se edita
																		{
mysql_query("
UPDATE `empresa` SET 
`codigo_empresa` = '$codigo_empresa', 
`razon_social` = '$razon_social', 
`sigla` = '$sigla', 
`slogan` = '$slogan', 
`nit` = '$nit', 
`direccion` = '$direccion', 
`telefono_1` = '$telefono_1', 
`web` = '$web', 
`email` = '$email', 
`persona_contacto` = '$persona_contacto', 
`regimen_tributario` = '$regimen_tributario', 
`resolucion_facturacion` = '$resolucion_facturacion', 
`facturacion_desde` = '$facturacion_desde', 
`facturacion_hasta` = '$facturacion_hasta', 
`facturacion_primera` = '$facturacion_primera', 
`facturacion_prefijo` = '$facturacion_prefijo', 
`facturacion_fecha` = '$facturacion_fecha', 
`facturacion_vencimiento` = '$facturacion_vencimiento', 
`telefono_2` = '$telefono_2  	 ', 
`telefono_3` = '$telefono_3', 
`fax` = '$fax', 
`pais` = '$pais', 
`departamento` = '$departamento', 
`ciudad` = '$ciudad', 
`logo_color` = '$logo_color', 
`logo_bn` = '$logo_bn', 
`logo_alta` = '$logo_alta', 
`logo_baja` = '$logo_baja', 
`css` = '$css', 
`css_impresion` = '$css_impresion' 
WHERE 
`empresa_responsable` = '$empresa_responsable' LIMIT 1
 ;",$link); 
$resultado= "Modificada";
																		}
					}//// fin del control para la creacion o modificacion de la empesa 	
$nuevo_select .= "<center><h1>[ $resultado ]</h1></center>";
if($origen=="inicio"){$respuesta->addRedirect("adentro.php");}
else{
$respuesta->addAssign("capa_empresa","innerHTML",$nuevo_select);
		}
									

return $respuesta;
} 



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