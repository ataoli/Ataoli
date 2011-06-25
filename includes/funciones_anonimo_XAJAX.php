<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
// header("Location: includes/error.php");
// echo "hola 2";
} 

//registramos la función creada anteriormente al objeto xajax
/// funcion para aceptar la licencia
/// funciones autorizaciones
//include_once("funciones/i.php");

//$xajax->registerFunction("dummy");
//$xajax->registerFunction("autorizacion_en_linea");

//$xajax->processRequests();



///NOMBRE DE LA FUNCION: dummy
// para llamar la funcion utilizar 
// onChange="xajax_dummy(xajax.getFormValues('nombre_formulario'))"
function dummy($valor,$capa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$Valor = $variable_array["id_evento"];


//include_once("librerias/conex.php"); 
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");

//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);

$nuevo_select = "<h1>$Valor , $variable_array</h1>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$nuevo_select .= "" . $row['id'] . "" . $row['nombre_completo'] . "<br>";
//															}
//										}
$nuevo_select .= "<h1>Los dummys</h1>";
$respuesta->addAssign($capa,"innerHTML",$nuevo_select);
return $respuesta;
} 
//$xajax->registerFunction("odontologia_cotizacion_ver");
/// fin dummy


function usuario_datos_consultar($id,$tipo,$campo){
$link=Conectarse(); 
if($tipo == 'usuario'){$tabla= 'd9_users'; $clave ='id'; $w = "LIMIT 1"; }
elseif($tipo == 'cliente'){$tabla= 'clientes'; $clave ='id_cliente'; $w = "LIMIT 1";}
elseif($tipo == 'cie_10'){$tabla= 'cie_10'; $clave ='codigo'; $w = "LIMIT 1";}
elseif($tipo == 'turnos_usuario'){$tabla= 'turnos'; $clave ='id_turno'; $w = "LIMIT 1";}
elseif($tipo == 'atencion_inicial'){$tabla= 'atencion_inicial'; $clave ='id_atencion_inicial'; $w = "LIMIT 1";}
elseif($tipo == 'inconsistencias'){$tabla= 'inconsistencias'; $clave ='id_inconsistencia'; $w = "LIMIT 1";}
elseif($tipo == 'consultas_referencia'){$tabla= 'atencion_inicial'; $clave ='id_usuario'; $w ='ORDER BY `timestamp_atencion` DESC'; $lista ='1'; $campo ='*'; $nombre_select="control";}
else{}
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT $campo FROM $tabla WHERE $clave = '$id' $w ";
$sql=mysql_query($consulta,$link);

if (mysql_num_rows($sql)!='0'){
if($lista =='1'){$resultado .= "<select name='$nombre_select'>";}
while( $row = mysql_fetch_array( $sql ) ) {
if($lista !='1'){
$resultado .= $row[$campo] ;
					 }else{/// si se pide una lista se dan los valores del select
					 	$resultado .= "<option value='$row[control]'>".date('Y-m-d G:i',$row[timestamp_atencion])."</option>";
					 			}
														}
									}else {
												if($lista !='1'){$resultado= "[$id]";}
												else{/// si se pide una lista se dan los valores del select
					 	$resultado .= "<img src='images/atencion.gif' alt='[!]' title='Opss! No hay información sobre $tabla'> Opss! No hay información sobre $tabla ";
					 									} return $resultado;
if($lista =='1'){$resultado .="</select>";}
					 						}

return $resultado;

																 }


function autorizacion_en_linea($ai,$capa){

$ahora_dia =date("Y-m-d");
$ahora_hora =date("H:i");
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$revisar_autorizacion ="SELECT * FROM autorizaciones_recibidas WHERE  control ='$ai'";
//$formato = $revisar_autorizacion;
$consulta_autorizacion = mysql_query($revisar_autorizacion,$link);
if(mysql_num_rows($consulta_autorizacion)=='0'){///si NO hay una autorizacion
////cups
$linea =0;
$consulta_cups=mysql_query("SELECT *, cups.descripcion FROM autorizaciones_procedimientos, cups WHERE control = '$ai' AND autorizaciones_procedimientos.CUPS = cups.codigo",$link);
if (mysql_num_rows($consulta_cups)!='0'){

while( $row = mysql_fetch_array( $consulta_cups ) ) {
++$linea;
$cups .= "<table align='center'>
							
							<tr >
								<td><sup>$linea</sup><input name='fila[$linea]' id='fila[$linea]' type='hidden'  value='$linea'  >
								<input name='cups[$linea]' id='cups[$linea]'  onChange=\"xajax_revisar_cups(this.value,$linea); \" type='text'  value='$row[CUPS]' size='7' maxlength='7' title='CUPS' >
								</td>
								<td><input name='cantidad[$linea]' id='cantidad[$linea]'  onClick=\"xajax_revisar_cups(document.getElementById('cups[$linea]').value,$linea); \"  type='text'  value='$row[cantidad]' size='3' maxlength='3'title='CANTIDAD' >
								</td>
								<td><input name='descripcion[$linea]' id='descripcion[$linea]' type='text'  value='$row[descripcion]' size='100' maxlength='50' title='DESCRIPCION' READONLY>
								</td>
							</tr>
							
						</table>";
															}
++$linea;
									}
////fin cups
$formato .="
<!-- <input type='button' class='cursor' onClick=\"xajax_autorizacion_en_linea('$ai','autorizacion_en_linea');\" title='Autorizacion en linea' value='Autorización en linea'>
 -->
<input type='button' class='cursor' value='Grabar autorización' onClick=\"xajax_autorizacion_solicitud('$id','$capa',xajax.getFormValues('solicitud_autorizacion'),'autorizar'); \">
";
$formato .= "<form name='solicitud_autorizacion' id='solicitud_autorizacion'>
<div align='center' ><h2>Por favor use este formato para realizar la autorización en línea</h2>
<br><font size='-1'>(Después de llenarlo se generará el <b>formulario de autorización</b> compatible con el anexo 4 de la resolucion 3047/2008 que podrá guardar o imprimir)</font>
				<table cellpadding='10' cellspacing='0' border='1' align='center' width='100%'  style='background-color: #E6F6FA; border-color: #1E90FF; border-width: 1px; width: 80%; '>
					<tr>
						<td colspan='3' align='center'>
						<input name='control' id='control' type='hidden'  value='$ai' size='32' readonly > 
						<b>Número de autorización: <input title='Corresponde al número consecutivo que asigna cada entidad responsable del pago y que se reinicia ada 1 de enero' name='numero_autorizacion' id='numero_autorizacion' type='text'  value='' size='10'> 
						Fecha:<input name='fecha_autorizacion' id='fecha_autorizacion' type='text'  value='$ahora_dia' size='10'  title='AAAA-MM-DD' maxlength='10' > 
						Hora:<input name='hora_autorizacion' id='hora_autorizacion' type='text'  value='$ahora_hora' size='5'  title='HH:MM' maxlength='5' ></b> 
						</td>
					</tr>
					<tr>
						<td colspan='3' align='center'>
						<b><font size='-1'>Porcentaje del valor de esta autorización a pagar por la entidad responsable del pago:</font>
						 <input title='100' name='porcentaje' id='porcentaje' type='text'  value='' size='3' maxlength='3'>%</b> 
						</td>
					</tr>
					<tr>
						<td colspan='2' align='center'>
						<b><font size='-1'>Semanas de afiliaciónd el paciente  a la solicitud de la autorización:</font>
						 <input title='10' name='semanas' id='semanas' type='text'  value='' size='2' maxlength='2'> semanas</b> 
						</td>
						<td  align='center' colspan='1'>
						<b><font size='-1'>Reclamo de tiquete , bono o vale de pago 
						 <input title='SI' name='bono' id='bono' type='radio' value='1' > SI <input title='NO' name='bono' id='bono' type='radio' value='2' >NO</font></b> 
						</td>
						
					</tr>
					<tr valign='top' align='center' >
						<td colspan='3'>
						<table align='center'  width='80%' border ='0'>
						<tr valign='top' align='center'>
						<td><font size='-2'><b>Concepto</b></font>
						</td>
						<td><font size='-2'><b>Valor en pesos</b></font>
						</td>
						<td><font size='-2'><b>Porcentaje</b></font>
						</td>
						<td ><font size='-2'><b>Valor máximo (tope) en pesos</b></font>
						</td>
					</tr>
					<tr valign='top' align='center'>
						<td align='left'><font size='-2'><input type='checkbox' value='1' id='cuota_moderadora' name='cuota_moderadora' title='Cuota moderadora'><b>Cuota moderadora</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input onchange=\"document.getElementById('cuota_moderadora').checked = true\" type='text' size='7' value='' id='valor_cuota_moderadora' name='valor_cuota_moderadora' title='Valor cuota moderadora'></font>
						</td>
						<td><font size='-2'><input onchange=\"document.getElementById('cuota_moderadora').checked = true\" type='text' size='3' value='' id='porcentaje_cuota_moderadora' name='porcentaje_cuota_moderadora' title='Porcentaje cuota moderadora'><b>%</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input onchange=\"document.getElementById('cuota_moderadora').checked = true\" type='text' size='7' value='' id='tope_cuota_moderadora' name='tope_cuota_moderadora' title='Tope cuota moderadora'><b></b></font>
						</td>
						
					</tr>
					
					<tr valign='top' align='center'>
						<td align='left'><font size='-2'><input type='checkbox' value='1' id='copago' name='copago' title='Copago'><b>Copago</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input type='text' size='7' onchange=\"document.getElementById('copago').checked = true\" value='' id='valor_copago' name='valor_copago' title='Valor copago'></font>
						</td>
						<td><font size='-2'><input onchange=\"document.getElementById('copago').checked = true\"  type='text' size='3' value='' id='porcentaje_copago' name='porcentaje_copago' title='Porcentaje copago'><b>%</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input  onchange=\"document.getElementById('copago').checked = true\" type='text' size='7' value='' id='tope_copago' name='tope_copago' title='Tope copago'><b></b></font>
						</td>
						
					</tr>
					
					<tr valign='top' align='center'>
						<td align='left'><font size='-2'><input type='checkbox' value='1' id='cuota_de_recuperacion' name='cuota_de_recuperacion' title='Cuota de recuperación'><b>Cuota de recuperacion</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input onchange=\"document.getElementById('cuota_de_recuperacion').checked = true\"  type='text' size='7' value='' id='valor_cuota_de_recuperacion' name='valor_cuota_de_recuperacion' title='Valor cuota de recuperacion'></font>
						</td>
						<td><font size='-2'><input onchange=\"document.getElementById('cuota_de_recuperacion').checked = true\"  type='text' size='3' value='' id='porcentaje_cuota_de_recuperacion' name='porcentaje_cuota_de_recuperacion' title='Porcentaje cuota de recuperación'><b>%</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input onchange=\"document.getElementById('cuota_de_recuperacion').checked = true\"  type='text' size='7' value='' id='tope_cuota_de_recuperacion' name='tope_cuota_de_recuperacion' title='Tope cuota de recuperación'><b></b></font>
						</td>
						
					</tr>
					
					<tr valign='top' align='center'>
						<td align='left'><font size='-2'><input type='checkbox' value='1' id='otro' name='otro' title='Otro'><b>Otro</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input onchange=\"document.getElementById('otro').checked = true\"  type='text' size='7' value='' id='valor_otro' name='valor_otro' title='Valor otro'></font>
						</td>
						<td><font size='-2'><input onchange=\"document.getElementById('otro').checked = true\"   type='text' size='3' value='' id='porcentaje_otro' name='porcentaje_otro' title='Porcentaje otro'><b>%</b></font>
						</td>
						<td><font size='-2'><b>$</b> <input onchange=\"document.getElementById('otro').checked = true\"   type='text' size='7' value='' id='tope_otro' name='tope_otro' title='Tope otro'><b></b></font>
						</td>
						
					</tr>
					
						</table>
						<hr><b>INFORMACION DE LA PERSONA QUE AUTORIZA</b>
					</td>
					</tr>
					<tr>
						<td >
							<font size='-1'>Nombre de quien autoriza:</font><br>
						 <input title='Nombre de quien autoriza:' name='nombre_autoriza' id='nombre_autoriza' type='text'  value='' size='60' maxlength='60'></b> 

							<br><font size='-1'><b>Cargo o actividad:</b></font>
						 <input title='Cargo o actividad' name='cargo_autoriza' id='cargo_autoriza' type='text'  value='' size='30' maxlength='30'></b> 
						 </td>
						<td align='right' colspan='2'><font size='-1'><b>Teléfono fijo autorizador</b></font>
						<br>
							<font size='-1'>Indicativo:</font>
						 <input title='Indicativo teléfono' name='telefono_indicativo_autoriza' id='telefono_indicativo_autoriza' type='text'  value='' size='5' maxlength='5'></b>
							<br><font size='-1'>Número:</font>
						 <input title='Número teléfono' name='telefono_numero_autoriza' id='telefono_numero_autoriza' type='text'  value='' size='7' maxlength='7'></b>
							<br><font size='-1'>Extención:</font>
						 <input title='Extención teléfono' name='telefono_extencion_autoriza' id='telefono_extencion_autoriza' type='text'  value='' size='6' maxlength='6'></b>
						 <br>
						 <font size='-1'>Teléfono celular:</font>
						 <input title='Número teléfono celular' name='telefono_celular_autoriza' id='telefono_celular_autoriza' type='text'  value='' size='10' maxlength='10'></b> 
						 </td>
					</tr>
						
					<tr>
						<td colspan='3' align='center'><a class='cursor' onclick=abrir('CUPS.php','crear',500,200,100,0,'1','yes','$row[id_consulta_campo]'); title='Para buscar el CUPS 10 haga clic aqui'> Buscar CUPS <img src='../images/buscar.gif' border='0' alt='[B]'></a>
							<table >
							
							<tr >
								<td>&nbsp;&nbsp;&nbsp;<input  type='text'  value='  CUPS' size='7' maxlength='7' readonly class='invisible' TITLE='Codigo del procedimiento' >
								</td>
								<td><input  type='text'  value='CAN' size='3' maxlength='3'  readonly class='invisible' title='Cantidad '>
								</td>
								<td><input  type='text'  value='                   DESCRIPCIÓN' size='100' maxlength='50'  readonly class='invisible' title='Descripción del procedimiento'>
								</td>
							</tr>
							
						</table>
						$cups
						<table align='center'>
							
							<tr >
								<td><sup>$linea</sup><input name='fila[$linea]' id='fila[$linea]' type='hidden'  value='$linea'  >
								<input name='cups[$linea]' id='cups[$linea]'  onChange=\"xajax_revisar_cups(this.value,$linea); \" type='text'  value='' size='7' maxlength='7' title='CUPS' >
								</td>
								<td><input name='cantidad[$linea]' onClick=\"xajax_revisar_cups(document.getElementById('cups[$linea]').value,$linea); \"  id='cantidad[$linea]' type='text'  value='' size='3' maxlength='3'title='CANTIDAD' >
								</td>
								<td><input name='descripcion[$linea]' id='descripcion[$linea]' type='text'  value='' size='100' maxlength='50' title='DESCRIPCION' READONLY>
								</td>
							</tr>
							
						</table>
						
						<div align='center'><div id='cups_linea_$linea'><a class='cusor' onClick=\"xajax_cups_formato('agregar','$linea'); \">NUEVA LINEA</a></div></div>
						</td>
					</tr>
				</table>
				</td>
					</tr>
				</table>
				</form>
				</div>
				";
				} ////FIN NO HAY AUTORIZACION
				else{$formato = "<div align='center'><h1><a href='aa.php?r=$ai' title='Ver formato de Autorización (Anexo 4 resolución 3047)'>Ver formato de Autorización (Anexo 4 resolución 3047)</a></h1></div>";}
$respuesta->addAssign($capa,"innerHTML",$formato);
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