<?php 
session_start();
// Comprobamos si existe la variable
/*if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../../includes/error.php");
// echo "hola mundo2";
} 
*/
function dummy_i($variable_array,$capa){

$respuesta = new xajaxResponse('utf-8');
$Valor = $variable_array["id_evento"];
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");

//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);
/* foreach ($variable_array as $campo => $contenido)
	{
if($contenido != ''){	
	
	if(is_array($contenido)){
										foreach ($contenido as $campo => $contenido)
												{
												if($contenido != ''){
												$campos_consulta .= "$campo ,";
												$valores_consulta .= "$contenido ,";
																			}
									   		}
									}else {$campos_consulta .= "$campo ,";
											$valores_consulta .= "$contenido ,";
											}
							}
	}

$consulta ="INSERT INTO  autorizaciones_solicitud ($campos_consulta) 
					         VALUES ($valores_consulta)";

			*/
$nuevo_select .= $consulta;
$nuevo_select .= "<h1>Hola mundo! $Valor , $variable_array</h1>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "$row[id_atencion_inicial] $row[control]<br>";
//															}
//										}
$nuevo_select .= "<h1>Los dummys</h1>";
$respuesta->addAssign($capa,"innerHTML",$nuevo_select);
return $respuesta;
} 
$xajax->registerFunction("dummy_i");

/////revisar cups
function revisar_cups($cups,$capa){

$respuesta = new xajaxResponse('utf-8');
$valido=0;
$link=Conectarse(); 
if($cups == ""){
		$respuesta->addAssign("cups[$capa]","value","");	
		$respuesta->addAssign("descripcion[$capa]","value","");
		$respuesta->addAssign("cantidad[$capa]","value","");
		return $respuesta;}
mysql_query("SET NAMES 'utf8'");
$consulta ="SELECT * FROM cups WHERE codigo = '$cups' LIMIT 1";
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$cups_codigo=mysql_result($sql,0,"codigo");
$cups_descripcion=mysql_result($sql,0,"descripcion");
$valido=1;
   									}
   									else{$valido=0;}
if($valido==0){
		$respuesta->addAlert("[$cups] en la linea $capa, No es un código CUPS válido!");	
		$respuesta->addAssign("cups[$capa]","value","");		
		$respuesta->addAssign("descripcion[$capa]","value","");
					}else{
							$div='capa_descripcion_$capa';
					$respuesta->addAssign("descripcion[$capa]","value",$cups_descripcion);
						
					}


return $respuesta;
} 
$xajax->registerFunction("revisar_cups");

////fin revisar cups


function cups_formato($accion,$linea){

$respuesta = new xajaxResponse('utf-8');
$Valor = $variable_array["id_evento"];
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");

//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);
$proxima = $linea +1;
$nueva_linea .= "	<table align='center'>
							<tr >
								<td><sup>$proxima</sup>
								<input name='fila[$proxima]' id='fila[$proxima]' type='hidden'  value='$proxima'  >
								<input onChange=\"xajax_revisar_cups(this.value,$proxima); \" name='cups[$proxima]' id='cups[$proxima]' type='text'  value='' size='7' maxlength='7' title='CUPS' >
								</td>
								<td><input name='cantidad[$proxima]' onClick=\"xajax_revisar_cups(document.getElementById('cups[$proxima]').value,$proxima); \" id='cantidad[$proxima]' type='text'  value='' size='3' maxlength='3' title='CANTIDAD'>
								</td>
								<td><div id='capa_descripcion_$proxima'></div><input name='descripcion[$proxima]' id='descripcion[$proxima]' type='text'  value='' size='100' maxlength='50' title='DESCRIPCION' READONLY>
								</td>
							</tr>
						</table>
							<div id='cups_linea_$proxima'><a onClick=\"xajax_cups_formato('agregar','$proxima'); \">NUEVA LINEA</a></div>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$resultado .= "$row[id_atencion_inicial] $row[control]<br>";
//															}
//										}
$capa ="cups_linea_".$linea;
$respuesta->addAssign($capa,"innerHTML",$nueva_linea);
return $respuesta;
} 
$xajax->registerFunction("cups_formato");


function autorizacion_solicitud($id,$capa,$titulo,$tipo){
$titulo[id_empresa]= $_SESSION[id_empresa];
$titulo[id_funcionario]= $_SESSION[id_usuario];
$ai=$titulo["control"]; 
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($tipo=='autorizar'){
$pin = rand(1000,9999);
$titulo[pin]= $pin;
///campo obligatorios
$campos_obligatorios = array( 'id_funcionario',
 'control',
 'numero_autorizacion',
 'fecha_autorizacion',
 'hora_autorizacion',
 'nombre_autoriza',
 'cargo_autoriza',
 'telefono_indicativo_autoriza',
 'telefono_numero_autoriza');

foreach ($campos_obligatorios as $campo => $contenido)
	{
	if ($titulo[$contenido] == ""){
		$obligatorio = "El campo \"".ereg_replace("_"," ","$contenido")."\" no puede estar vacio";
		$respuesta->addAlert("$obligatorio");
return $respuesta;
								}else {$obligatorio = "<font color='green' size='+2'>*</font>";
								//$respuesta->addAssign("capa_$contenido","innerHTML",$obligatorio);
										}
	}
//// fin obligatorios

foreach ($titulo as $campo => $contenido)

	{

	if(is_array($contenido)){}else {	$campos_consulta .= "$campo ,";
												$valores_consulta .= "'$contenido' ,";
												}
	}
/////GRABAR AUTORIZACION
foreach ($titulo[fila] as $fila => $item){ ///para cada fila
				if($titulo[cups][$item] !=''){
					
					$valor_campo[$item] .= "INSERT INTO `autorizaciones_procedimientos_recibidos` (
																	`id_empresa` ,
																	`CUPS` ,
																	`cantidad` ,
																	
																	`control` ,
																	`id_funcionario`
																	)VALUES ( ";
					$valor_campo[$item] .= "'$_SESSION[id_empresa]";
					$valor_campo[$item] .= "','".$titulo["cups"]["$item"];
					$valor_campo[$item] .= "','".$titulo["cantidad"]["$item"];
					$valor_campo[$item] .= "','".$titulo["control"];
					$valor_campo[$item] .= "','$_SESSION[id_usuario]";
					$valor_campo[$item] .= "')";	
														}	
														}
														
														if($valor_campo){
												foreach ($valor_campo as $fila => $consuta){ /// ejecucion de sql
																		//$formato .= "<li>$valor_campo[$fila]</li>";
										$grabar = mysql_query($valor_campo["$fila"],$link);
																											}/// fin de la ejecucion de sql
																				}
///////
///$listado= $valor

// $listado = $campos_consulta_procedimiento." x ".$valores_consulta_procedimiento ;
$valores_consulta =  substr ($valores_consulta, 0, -1);
$campos_consulta =  substr ($campos_consulta, 0, -1);
$consulta ="INSERT INTO  autorizaciones_recibidas ( $campos_consulta ) 
					         VALUES ($valores_consulta)";

						$grabar = mysql_query($consulta,$link);
						
/// FIN DE LA AUTORIZACION	
	
//$formato .="$valor_campo";
$formato .="<div align='center'><h1><a href='aa.php?r=$ai' title='Ver formato de Autorización (Anexo 4 resolución 3047)'>Ver formato de Autorización (Anexo 4 resolución 3047)</a></h1></div>" ;						
$respuesta->addAssign($capa,"innerHTML",$formato);
return $respuesta;
								}///fin autorizar
if($tipo =='grabar'){
$titulo[id_usuario]= $id;
$titulo[id_empresa]= $_SESSION[id_empresa];
$titulo[id_funcionario]= $_SESSION[id_usuario];
$titulo[timestamp_autorizacion]= time();
$titulo[id_cliente] = usuario_datos_consultar($id,'usuario','id_cliente');
$timestamp = time();
$hora=date('H:i:s');
$hoy=date('Y-m-d');
list( $ano, $mes, $dia ) = split( '[-]', $hoy );
$hoy_timestamp=mktime(0,0,0, $mes, $dia, $ano);
$consulta_ultima_atencion ="SELECT timestamp_fecha, consecutivo FROM autorizaciones_solicitud WHERE timestamp_fecha = '$hoy_timestamp' 	ORDER BY consecutivo DESC LIMIT  1";
$ultimo= mysql_query($consulta_ultima_atencion,$link);
if (mysql_num_rows($ultimo)!='0'){
$ultimo_consecutivo=mysql_result($ultimo,0,"consecutivo");
$consecutivo= ++$ultimo_consecutivo;
																			}else{$consecutivo='1';}
$pin = rand(1000,9999);
$titulo[consecutivo]= $consecutivo;
$titulo[pin]= $pin;
$titulo[timestamp_fecha]= $hoy_timestamp;


/* `` ,
`id_usuario` ,
`id_funcionario` ,
`id_cliente` ,
`control` ,
`secuencial` ,
`timestamp_autorizacion` ,
`tipo_servicio` ,
`prioridad_atencion` ,
`origen_de_la_atencion` ,
`accidente_de_transito` ,
`ubicacion_lugar` ,
`ubicacion_servicio` ,
`ubicacion_cama` ,
`guia` ,
`justificacion_clinica` 
*/

$campos_obligatorios = array('control','tipo_servicio','prioridad_atencion','ubicacion_lugar');

foreach ($campos_obligatorios as $campo => $contenido)
	{
	if ($titulo[$contenido] == ""){
		$obligatorio = "El campo \"".ereg_replace("_"," ","$contenido")."\" no puede estar vacio";
		$respuesta->addAlert("$obligatorio");
return $respuesta;
								}else {$obligatorio = "<font color='green' size='+2'>*</font>";
								//$respuesta->addAssign("capa_$contenido","innerHTML",$obligatorio);
										}
	}
	

foreach ($titulo as $campo => $contenido)
//$listado .= "$campo : $contenido <br>";
	{
//if($contenido != ''){	
	
	if(is_array($contenido)){}else {	
												
												$campos_consulta .= "$campo ,";
												$valores_consulta .= "'$contenido' ,";
											}
							}
//	}

//////

foreach ($titulo[fila] as $fila => $item){ ///para cada fila
				if($titulo[cups][$item] !=''){
					
					$valor_campo[$item] .= "INSERT INTO `autorizaciones_procedimientos` (
																	`id_empresa` ,
																	`CUPS` ,
																	`cantidad` ,
																	
																	`control` ,
																	`id_funcionario`
																	)VALUES ( ";
					$valor_campo[$item] .= "'$_SESSION[id_empresa]";
					$valor_campo[$item] .= "','".$titulo["cups"]["$item"];
					$valor_campo[$item] .= "','".$titulo["cantidad"]["$item"];
					$valor_campo[$item] .= "','".$titulo["control"];
					$valor_campo[$item] .= "','$_SESSION[id_usuario]";
					$valor_campo[$item] .= "')";	
														}	
														}
														
														if($valor_campo){
												foreach ($valor_campo as $fila => $consuta){ /// ejecucion de sql
																				
											$grabar = mysql_query($valor_campo["$fila"],$link);
																											}/// fin de la ejecucion de sql
																				}
///////
///$listado= $valor

// $listado = $campos_consulta_procedimiento." x ".$valores_consulta_procedimiento ;
$valores_consulta =  substr ($valores_consulta, 0, -1);
$campos_consulta =  substr ($campos_consulta, 0, -1);
$consulta ="INSERT INTO  autorizaciones_solicitud ( $campos_consulta ) 
					         VALUES ($valores_consulta)";

						$grabar = mysql_query($consulta,$link);
						
$formato ="<div align='center'><h1>Guardado</h1></div>" ;						
$respuesta->addAssign($capa,"innerHTML",$formato);
return $respuesta;
							}//// fin de grabar

//$formato .=" $id_cliente <div align='center'><input type='button' class='cursor' value='DE BUG ($id,$capa,$titulo,$tipo)  ' onClick=\"xajax_autorizacion_solicitud('$id','$capa','titulo de la funcion','formulario'); \"></div>";

$formato .="<div align='center'><input type='button' class='cursor' value='Grabar' onClick=\"xajax_autorizacion_solicitud('$id','$capa',xajax.getFormValues('solicitud_autorizacion'),'grabar'); \"></div>";
$formato .= "<form name='solicitud_autorizacion' id='solicitud_autorizacion'>
<div align='center' ><h2>$titulo</h2>".usuario_datos_consultar($id,'usuario','nombre_completo')."
				<table cellpadding='10' cellspacing='0' border='1' align='center' width='100%'  style='background-color: #E6F6FA; border-color: #1E90FF; border-width: 1px; width: 80%; '>
					<tr>
						<td colspan='2'><b>Consulta de referencia:</b> ".usuario_datos_consultar($id,'consultas_referencia','id_atencion_inicial')."
						</td>
					</tr>
					<tr valign='top'>
						
						<td><strong>Tipo de servicio solicitados</strong><br> <input type='radio' value='1'  name ='tipo_servicio' id='tipo_servicio' > Posterior a la atención inicial de urgencias
																					<br><input type='radio' value='2' name ='tipo_servicio' id='tipo_servicio' >Servicios electivos
						</td>
						<td><strong>Prioridad de la atención </strong><br><input type='radio' value='1' name ='prioridad_atencion' id='prioridad_atencion' > Prioritaria
						<br><input type='radio' value='2' name ='prioridad_atencion' id='prioridad_atencion' > No prioritaria
						</td>
					</tr>
					<tr>
						<td colspan='2'><div align='center'>
						<strong>Ubicación del paciente al momento de la solicitud</strong>
						<br>
						<input name='ubicacion_lugar' id='ubicacion_lugar' type='radio'  value='1' $evento > Consulta externa 
						<input name='ubicacion_lugar' id='ubicacion_lugar' type='radio'  value='2' $evento > Urgencias
						<input name='ubicacion_lugar' id='ubicacion_lugar' type='radio'  value='3' $evento > Hospitalización
						<br>Servicio: <input name='ubicacion_servicio' id='ubicacion_servicio' type='text'  value='' size='30' $evento > 
						Cama: <input name='ubicacion_cama' id='ubicacion_cama' type='text'  value='' size='6' $evento ></div>
						</td>
					</tr>
					<tr>
						<td colspan='3'><div align='center'><b>Manejo integral según  guía:</b> <input name='guia' id='guia' type='text'  value='' size='30' $evento >
						
						
						<hr><a class='cursor' onclick=abrir('i/CUPS.php','crear',500,200,100,0,'1','yes','$row[id_consulta_campo]'); title='Para buscar el CUPS 10 haga clic aqui'> Buscar CUPS <img src='images/buscar.gif' border='0' alt='[B]'></a>
						
				<table align='center'>
							
							<tr >
								<td>&nbsp;&nbsp;&nbsp;<input  type='text'  value='  CUPS' size='7' maxlength='7' readonly class='invisible' TITLE='Codigo del procedimiento' >
								</td>
								<td><input  type='text'  value='CAN' size='3' maxlength='3'  readonly class='invisible' title='Cantidad '>
								</td>
								<td><input  type='text'  value='                   DESCRIPCIÓN' size='100' maxlength='50'  readonly class='invisible' title='Descripción del procedimiento'>
								</td>
							</tr>
							
						</table>
						<table align='center'>
							
							<tr >
								<td><sup>0</sup><input name='fila[0]' id='fila[0]' type='hidden'  value='0'  >
								<input name='cups[0]' onChange=\"xajax_revisar_cups(this.value,0); \" id='cups[0]' type='text'  value='' size='7' maxlength='7' title='CUPS' >
								</td>
								<td><input name='cantidad[0]' id='cantidad[0]' onClick=\"xajax_revisar_cups(document.getElementById('cups[0]').value,0); \" type='text'  value='' size='3' maxlength='3'title='CANTIDAD' >
								</td>
								<td><input name='descripcion[0]' id='descripcion[0]' type='text'  value='' size='100' maxlength='50' title='DESCRIPCION' READONLY>
								</td>
							</tr>
							
						</table>
						<div align='center'><div id='cups_linea_0'><a onClick=\"xajax_cups_formato('agregar','0'); \">NUEVA LINEA</a></div></div>
						</td>
					</tr>
				</table>
				</form>
				</div>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$resultado .= "$row[id_atencion_inicial] $row[control]<br>";
//															}
//										}

$respuesta->addAssign($capa,"innerHTML",$formato);
return $respuesta;
} 
$xajax->registerFunction("autorizacion_solicitud");


function i_listado($tipo,$capa,$limite,$titulo,$id){

//$respuesta = new xajaxResponse('utf-8');
include('includes/datos.php');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($id !=''){$usuario =" AND id_usuario= $id ";$titulo="<b title='Para buscar un usuario en el listado oprima [Control+f]'> <div align='center'>$titulo</div> </b><hr>";}
            else{$titulo="<b title='Para buscar un usuario en el listado oprima [Control+f]'> <div align='center'>$titulo</div></b> <hr>";}

if ($tipo =='sa'){$tabla='autorizaciones_solicitud'; $consulta ="SELECT * FROM $tabla WHERE 1 $usuario LIMIT $limite ";}
elseif ($tipo =='aa'){$tabla='autorizaciones_recibidas, autorizaciones_solicitud'; $consulta ="SELECT *,autorizaciones_recibidas.pin,autorizaciones_recibidas.control FROM $tabla WHERE autorizaciones_recibidas.control = autorizaciones_solicitud.control $usuario LIMIT $limite ";}
elseif ($tipo =='ai'){$tabla='atencion_inicial'; $consulta ="SELECT * FROM $tabla WHERE 1 $usuario ORDER BY id_atencion_inicial DESC LIMIT $limite  ";}
elseif ($tipo =='ii'){$tabla='inconsistencias'; $consulta ="SELECT *, d9_users.id , $tabla.control as control, $tabla.id_cliente as id_cliente FROM $tabla , d9_users WHERE  $tabla.id_usuario = d9_users.id $usuario ORDER BY id_inconsistencia DESC LIMIT $limite ";}
else{$consulta ="SELECT * FROM $tabla WHERE 1 $usuario LIMIT $limite ";}
$sql=mysql_query($consulta,$link);

if (@mysql_num_rows($sql)!='0'){

$resultado .= "$titulo Mostrando máximo los últimos $limite registros
<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%'  title='Para buscar un usuario en el listado oprima [Control+f]'>";
$fila ='0';
if ($tipo == 'aa'){///inicia solicitud aprobadas

$resultado .= "<tr bgcolor='#c2f0e5'>
						<td><b>Usuario</b></td>
						<td><b>Entidad</b></td>
						<td><b>Fecha Atención</b></td>
						
						<td title='Orígen de la atención'><b>O</b></td>
						<td title='Accidente de transito'><b>AT</b></td>
						<td title='Ubicacion'><b>Ubicación</b></td>
						<td title='PIN del formulario'><b>PIN</b></td>
						
						<td><strong><div align='center' title='Fecha del envío'>Estado</div></strong></td>
					</tr>";
while( $row = mysql_fetch_array( $sql ) ) {

$fila = $fila +1;
if ($fila %2 == 0){$clase = "par";$bg="#EFFBFB";}else{$clase = "impar"; $bg="#FFFFFF";}
$resultado .= "<tr onMouseOver=\"uno(this,'#c2f0e5');\" onMouseOut=\"dos(this,'$bg');\" bgcolor='$bg' valign='top'>
						<td title=''><b>".usuario_datos_consultar($row[id_usuario],'usuario','documento_numero')."</b> ".usuario_datos_consultar($row[id_usuario],'usuario','nombre_completo')."
						<a href='adentro.php?page=suscriptores&usuario=$row[id_usuario]'><img src='images/buscar.gif' border='0' Alt='[--O]' title='Buscar este usuario [--O]'></a></td>
						<td title='".usuario_datos_consultar($row[id_cliente],'cliente','nit')."'>".usuario_datos_consultar($row[id_cliente],'cliente','alias')."</td>
						<td title=''>".date('Y-m-d H:i',$row[timestamp_autorizacion])."</td>
						
						<td title='Orígen de la atención'>$row[origen_de_la_atencion]</td>
						<td title='Accidente de transito'>$row[accidente_de_transito]</td>
						<td title='Ubicación del paciente'>$row[ubicacion_lugar] $row[ubicacion_servicio] $row[ubicacion_cama]</td>
						<td title='Clave para acceder al formulario'>$row[pin]</td>
						<td >
						<div id='capa_aa_$row[control]'>
												<!-- <a onClick=\"xajax_envio_documentos('$row[id_autorizacion_solicitud]','autorizaciones_solicitud','$row[control]','$row[id_cliente]','clientes','1','cuerpo_del_mensaje','capa_aa_$row[control]')\">
												
												".envio_revisar($row[control],'','')." --><a href='$url_aplicacion/i/aa.php?r=$row[control]' target='_blank' title='Formato de Autorizaciones recibidas'>
												</div><font size='-2' title='Muestra este formato'>VER FORMATO</font></a></td>
						</tr>";
															}
						}//// fin solicitud de informacion
if ($tipo == 'sa'){///inicia solicitud de autoizacon

$resultado .= "<tr bgcolor='#c2f0e5'>
						<td><b>Usuario</b></td>
						<td><b>Entidad</b></td>
						<td><b>Fecha Atención</b></td>
						
						<td title='Orígen de la atención'><b>O</b></td>
						<td title='Accidente de transito'><b>AT</b></td>
						<td title='Ubicacion'><b>Ubicación</b></td>
						<td title='PIN del formulario'><b>PIN</b></td>
						
						<td><strong><div align='center' title='Fecha del envío'>Estado</div></strong></td>
					</tr>";
while( $row = mysql_fetch_array( $sql ) ) {
$direccion =usuario_datos_consultar($row[id_cliente],cliente,'email_autorizaciones');
if($direccion !=''){
$enviar = "<a onClick=\"xajax_envio_documentos('$row[id_autorizacion_solicitud]','autorizaciones_solicitud','$row[control]','$row[id_cliente]','clientes','1','cuerpo_del_mensaje','capa_sa_$row[control]')\">
				<font size='-2'  color='green' title='Envía este formato'>[ ENVIAR ]</font>
				</a>";
							}else{$enviar ="<font size='-2' color='blue' title='No hay mail al cual enviar el formulario'>>SIN EMAIL<</font>";}
$fila = $fila +1;
if ($fila %2 == 0){$clase = "par";$bg="#EFFBFB";}else{$clase = "impar"; $bg="#FFFFFF";}
$resultado .= "<tr onMouseOver=\"uno(this,'#c2f0e5');\" onMouseOut=\"dos(this,'$bg');\" bgcolor='$bg' valign='top'>
						<td title=''><b>".usuario_datos_consultar($row[id_usuario],'usuario','documento_numero')."</b> ".usuario_datos_consultar($row[id_usuario],'usuario','nombre_completo')."
						<a href='adentro.php?page=suscriptores&usuario=$row[id_usuario]'><img src='images/buscar.gif' border='0' Alt='[--O]' title='Buscar este usuario [--O]'></a></td>
						<td title='".usuario_datos_consultar($row[id_cliente],'cliente','nit')."'>$id_cliente".usuario_datos_consultar($row[id_cliente],'cliente','alias')."</td>
						<td title=''>".date('Y-m-d H:i',$row[timestamp_autorizacion])."</td>
						
						<td title='Orígen de la atención'>$row[origen_de_la_atencion]</td>
						<td title='Accidente de transito'>$row[accidente_de_transito]</td>
						<td title='Ubicación del paciente'>$row[ubicacion_lugar] $row[ubicacion_servicio] $row[ubicacion_cama]</td>
						<td title='Clave para acceder al formulario'>$row[pin]</td>
						<td >
						<div id='capa_sa_$row[control]'>
												
												$enviar
												".envio_revisar($row[control],'','')."<a href='$url_aplicacion/i/sa.php?r=$row[control]' target='_blank' title='Informe de la Atención inicial de urgencias'>
												</div><font size='-2' title='Muestra este formato'>VER FORMATO</font></a></td>
						</tr>";
															}
						}//// fin solicitud de informacion						
if ($tipo =='ai'){/// inicia atencion inicial :-)

$resultado .= "<tr bgcolor='#c2f0e5'>
						<td><b>Usuario</b></td>
						<td><b>Entidad</b></td>
						<td><b>Fecha Atención</b></td>
						<td title='Clasificación'><b>C</b></td>
						<td title='Orígen de la atención'><b>O</b></td>
						<td title='Accidente de transito'><b>AT</b></td>
						<td title='Destino del paciente'><b>Destino</b></td>
						<td title='PIN del formulario'><b>PIN</b></td>
						
						<td><strong><div align='center' title='Fecha del envío'>Estado</div></strong></td>
					</tr>";
while( $row = mysql_fetch_array( $sql ) ) {
$id_cliente = usuario_datos_consultar($row['id_usuario'],'usuario','id_cliente');
$direccion =usuario_datos_consultar($id_cliente,cliente,'email_autorizaciones');
if($direccion !=''){
$enviar = "<a onClick=\"xajax_envio_documentos('$row[id_atencion_inicial]','atencion_inicial','$row[control]','$row[id_cliente]','clientes','1','cuerpo del mensaje','capa_$row[control]')\">
				<font size='-2'  color='green' title='Envía este formato'>[ ENVIAR ]</font>
				</a>";
							}else{$enviar ="<font size='-2' color='blue' title='No hay mail al cual enviar el formulario'>>SIN EMAIL<</font>";}
$fila = $fila +1;
if ($fila %2 == 0){$clase = "par";$bg="#EFFBFB";}else{$clase = "impar"; $bg="#FFFFFF";}
$resultado .= "<tr onMouseOver=\"uno(this,'#c2f0e5');\" onMouseOut=\"dos(this,'$bg');\" bgcolor='$bg' valign='top'>
						<td title=''><b>".usuario_datos_consultar($row[id_usuario],'usuario','documento_numero')."</b> ".usuario_datos_consultar($row[id_usuario],'usuario','nombre_completo')."
						<a href='adentro.php?page=suscriptores&usuario=$row[id_usuario]'><img src='images/buscar.gif' border='0' Alt='[--O]' title='Buscar este usuario [--O]'></a></td>
						<td title='".usuario_datos_consultar($id_cliente,'cliente','nit')."'>".usuario_datos_consultar($id_cliente,'cliente','alias')."</td>
						<td title=''>".date('Y-m-d H:i',$row[timestamp_atencion])."</td>
						<td title='Clasificación'>$row[clasificacion]</td>
						<td title='Orígen de la atención'>$row[origen_de_la_atencion]</td>
						<td title='Accidente de transito'>$row[accidente_de_transito]</td>
						<td title='destino del paciente'>$row[destino]</td>
						<td title='Clave para acceder al formulario'>$row[pin]</td>
						<td >
						<div id='capa_$row[control]'>
												
												$enviar 
												".envio_revisar($row[control],'','')."<a href='$url_aplicacion/i/ai.php?r=$row[control]' target='_blank' title='Informe de la Atención inicial de urgencias'>
												</div><font size='-2' title='Muestra este formato'>VER FORMATO</font></a></td>
						</tr>";
															}
															
							}/// fin atención inicial
							
if ($tipo =='ii'){/// inicia inconsistencias

$resultado .= "
					
					<tr bgcolor='#c2f0e5'>
						<td><b>Usuario</b></td>
						<td><b>Entidad</b></td>
						<td><b>Fecha reporte</b></td>
						<td title='Tipo de Inconsistencia'><b>T</b></td>
						<td title='Funcionario que reportó'><b>Funcionario</b></td>
						<td title='Observaciones'><b>Observaciones</b></td>
						
						<td title='PIN del formulario'><b>PIN</b></td>
						
						<td><strong><div align='center' title='Fecha del envío'>Estado</div></strong></td>
					</tr>";
while( $row = mysql_fetch_array( $sql ) ) {

$direccion =usuario_datos_consultar($row[id_cliente],cliente,'email_autorizaciones');
if($direccion !=''){
$enviar = "<a onClick=\"xajax_envio_documentos('$row[id_inconsistencia]','inconsistencias','$row[control]','$row[id_cliente]','clientes','1','cuerpo del mensaje','capa_$row[control]')\">
				<font size='-2'  color='green' title='Envía este formato'>[ ENVIAR ]</font>
				</a>";
							}else{$enviar ="<font size='-2' color='blue' title='No hay mail al cual enviar el formulario'>>SIN EMAIL<</font>";}
$fila = $fila +1;
if ($fila %2 == 0){$clase = "par";$bg="#EFFBFB";}else{$clase = "impar"; $bg="#FFFFFF";}
$resultado .= "<tr onMouseOver=\"uno(this,'#c2f0e5');\" onMouseOut=\"dos(this,'$bg');\" bgcolor='$bg' valign='top'>
						<td title=''><b>".usuario_datos_consultar($row[id_usuario],'usuario','documento_numero')."</b> ".usuario_datos_consultar($row[id_usuario],'usuario','nombre_completo')."
						<a href='adentro.php?page=suscriptores&usuario=$row[id_usuario]'><img src='images/buscar.gif' border='0' Alt='[--O]' title='Buscar este usuario [--O]'></a></td>
						<td title='".usuario_datos_consultar($row[id_cliente],'cliente','nit')."'>".usuario_datos_consultar($row[id_cliente],'cliente','alias')."</td>
						<td title=''>".date('Y-m-d H:i',$row[timestamp_inconsistencia])."</td>
						<td title='Tipo de inconsistencia'>$row[inconsistencia_tipo]</td>
						<td title='Funcionario que reportó ".usuario_datos_consultar($row[id_funcionario],'usuario','nombre_completo')."'>".usuario_datos_consultar($row[id_funcionario],'usuario','p_apellido')."</td>
						<td title='Observaciones'>$row[observaciones]</td>
						
						<td title='Clave para acceder al formulario'>$row[pin]</td>
						<td title='Click para abrir el formulario'>
						<div id='capa_$row[control]'>
												
												$enviar".envio_revisar($row[control],'','')."
						</div>
						<a href='$url_aplicacion/i/ii.php?r=$row[control]' target='_blank' title='ver el reporte de inconsistencia'>
						<font size='-2' title='Muestra este formato'>VER FORMATO</font></a></td>
						<td></td>
						</tr>";
															}
															
							}/// fin inconsistencia						
$resultado .= "<tr bgcolor='#c2f0e5' ><td colspan='10'>Última actualización ".date('Y-m-d H:i:s',time())."</td></tr></table>";
										}

//$respuesta->addAssign($capa,"innerHTML",$resultado);
return $resultado;
} 
//$xajax->registerFunction("ai_listado");


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