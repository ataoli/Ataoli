<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 

function parametrizacion_otros_nopos($tipo,$id_medicamento,$capa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_empresa = $_SESSION[id_empresa];
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($tipo=='grabar'){
$id_item = $id_medicamento["id_item"];
$codigo_interno = $id_medicamento["codigo_interno"];
$nombre = $id_medicamento["nombre"];
$tipo = $id_medicamento["tipo"];
$servicio = $id_medicamento["servicio"];
$estado = $id_medicamento["estado"];
$clase = $id_medicamento["clase"];
$experimental = $id_medicamento["experimental"];
$grupo_terapeutico = $id_medicamento["grupo_terapeutico"];
$observaciones = $id_medicamento["observaciones"];
if($id_item =='nuevo'){
$consulta_grabar = "INSERT INTO  `insumos_procedimientos_nopos` (
`id` ,
`codigo_interno` ,
`clase` ,
`nombre` ,
`tipo` ,
`servicio` ,
`id_empresa` ,
`estado`,
`experimental`,
`grupo_terapeutico`,
`observaciones`
)
VALUES (
NULL ,  '$codigo_interno',  '$clase',  '$nombre',  '$tipo',  '$servicio',  '$id_empresa',  '$estado',  '$experimental',  '$grupo_terapeutico',  '$observaciones'
)";

$GRABAR = mysql_query($consulta_grabar,$link);
										}else{
$consulta_grabar = "UPDATE `insumos_procedimientos_nopos` SET  `codigo_interno` = '$codigo_interno', `clase` = '$clase',`nombre` = '$nombre', `tipo` = '$tipo',`servicio` = '$servicio', `estado` = '$estado'  , `experimental` = '$experimental'  , `grupo_terapeutico` = '$grupo_terapeutico'  , `observaciones` = '$observaciones'     WHERE `insumos_procedimientos_nopos`.`id` = $id_item;";		
$GRABAR = mysql_query($consulta_grabar,$link);								
												}




$resultado ="<H2>Cambios efectuados correctamente</h2>"; $respuesta->addAssign($capa,"innerHTML",$resultado);
return $respuesta;
						}
elseif ($id_medicamento == '0'){
$resultado .= "<form name='medicamentos' id='medicamentos'>
<input type='hidden' name='id_item' id='id_item' value='nuevo'>
C&oacute;digo Interno:<br><input type='text' name='codigo_interno' size='32' maxlength='20' ><br>
Nombre :<br><input type='text' name='nombre' size='32' maxlength='200' ><br>
Tipo:<br><input type='text' name='tipo' size='32' maxlength='20' ><br>

<br>Experimental: SI <input type='radio' name='experimental' value='1'> 
NO <input type='radio' name='experimental' value='0'>
<br>Grupo terapéutico:<br><input type='text' name='grupo_terapeutico' size='32' maxlength='60' ><br>
<br>Servicio:<br><input type='text' name='servicio' size='32' maxlength='20' ><br>


Estado:<select name='estado' size='1'> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
Clase:<select name='clase' size='1'> 
<option value='1'>Procedimiento</option> 
<option value='0'>Insumo</option>
</select><br>
Observaciones:<br><textarea name='observaciones' cols='30' rows='6' id='observaciones'>$row[observaciones]</textarea><br>

<input type='button' value='   Grabar      ' onclick=\"xajax_parametrizacion_otros_nopos('grabar',xajax.getFormValues(medicamentos),'$capa')\">
</form>";
}

elseif($id_medicamento==''){ 
	$resultado .= "
Otro no pos:<select name='editar_onp' id='editar_onp' onchange=\"xajax_parametrizacion_otros_nopos('',this.value,'$capa')\" size='1' style='width:320'> 
	   <option value=''>Seleccionar</option>
 	   <option value='0'>         INCLUIR NUEVO  </option> 
 	   <option value=''>----------------------------------------------------</option>
";
	$consulta = "SELECT * FROM insumos_procedimientos_nopos WHERE id_empresa = '$id_empresa' ORDER BY clase, nombre , codigo_interno ";
	$result=mysql_query($consulta,$link);
		while ($row = mysql_fetch_array($result)){
		if($row[clase]=='1'){$pos='[procedimiento]';}else{$pos='(insumo)';}
  $resultado .= "<option value='$row[id]'>$pos $row[codigo_interno] $row[nombre] $row[tipo] $row[servicio] </option>";
		}
 $resultado .="
</select>
<div id='capamedicamentos' name='capamedicamentos'></div>";
$respuesta->addAssign($capa,"innerHTML",$resultado);
return $respuesta;
	}
	else { 

$consulta = "SELECT * 
				FROM insumos_procedimientos_nopos
				WHERE id = $id_medicamento";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[estado]=="1"){
$activo = "ACTIVO";
}
else{$activo = "INACTIVO";}
if ($row[clase] !="1"){
$pos = "Insumo";
}
else{$pos = "Servicio";}

if ($row[experimental] !="1"){
$experiemntal  = "NO <input type='radio' name='experimental' value='0' checked";
}
else{$experimental = "SI <input type='radio' name='experimental' value='1' checked>";}




$resultado .= "<form name='medicamentos' id='medicamentos'>
ID:
<input readonly type='text' name='id_item' ID='id_item' value='$id_medicamento' class='invisible' size='6'>
<br>
C&oacute;digo Interno:<br><input type='text' name='codigo_interno' size='32' maxlength='20' value='$row[codigo_interno]' ><br>
Nombre :<br><input type='text' name='nombre' size='32' maxlength='200' value ='$row[nombre]' ><br>
Tipo:<br><input type='text' name='tipo' size='32' maxlength='20' value='$row[tipo]' ><br>
Servicio:<br><input type='text' name='servicio' size='32' maxlength='20' value='$row[servicio]'><br>
<br>Experimental: ( $experimental ) SI <input type='radio' name='experimental' value='1'> 
NO <input type='radio' name='experimental' value='0'> 
<br>Grupo terapéutico:<br><input type='text' name='grupo_terapeutico' size='32' maxlength='60' value='$row[grupo_terapeutico]' ><br>
Estado:<select name='estado' size='1'> 
<option value='$row[estado]'>$activo</option> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
Clase:<select name='clase' size='1'> 
<option value='$row[clase]'>$pos</option> 
<option value='1'>Procedimiento</option> 
<option value='0'>Insumo</option>
</select>
<br>
Observaciones:<br><textarea name='observaciones' cols='30' rows='6' id='observaciones'>$row[observaciones]</textarea><br>
<input type='button' value='Editar ' onclick=\"xajax_parametrizacion_otros_nopos('grabar',xajax.getFormValues(medicamentos),'capamedicamentos')\">
</form>";
}



$respuesta->addAssign("capamedicamentos","innerHTML",$resultado);
return $respuesta;
} 
/// fin parametrizacion_medicamentos
$xajax->registerFunction("parametrizacion_otros_nopos");

///NOMBRE DE LA FUNCION: parametrizacion_medicamentos
//Esta funcion es la encargada de crear medicamentos
function parametrizacion_medicamentos($tipo,$id_medicamento,$capa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($tipo=='grabar'){
$id_item = $id_medicamento["id_item"];
$cod_01 = $id_medicamento["cod_01"];
$cod_02 = $id_medicamento["cod_02"];
$cod_03 = $id_medicamento["cod_03"];
$cod_04 = $id_medicamento["cod_04"];
$medicamento_nombre = $id_medicamento["medicamento_nombre"];
$concentracion_forma = $id_medicamento["concentracion_forma"];
$observaciones = $id_medicamento["observaciones"];
$estado = $id_medicamento["estado_medicamento"];
$nopos = $id_medicamento["NOPOS"];
if($id_item =='nuevo'){
$consulta_grabar = "INSERT INTO medicamentos(`id_medicamento`, `cod_01`,`cod_02`,`cod_03`,`cod_04`, `medicamento_nombre`, `concentracion_forma`, `observaciones`, `estado`, `nopos`) 
VALUES (NULL, '$cod_01', '$cod_02', '$cod_03', '$cod_04', '$medicamento_nombre', '$concentracion_forma', '$observaciones', '$estado', '$nopos')";
$GRABAR = mysql_query($consulta_grabar,$link);
										}else{
$consulta_grabar = "UPDATE `medicamentos` 
						SET `cod_01`='$cod_01', `cod_02`= '$cod_02', `cod_03`= '$cod_03', `cod_04`= '$cod_04', `medicamento_nombre`= '$medicamento_nombre', `concentracion_forma`= '$concentracion_forma', `observaciones`= '$observaciones', `estado`= '$estado', `nopos`= '$nopos' 
						WHERE `id_medicamento`= '$id_item' ";		
$GRABAR = mysql_query($consulta_grabar,$link);								
												}




$resultado ="<H2>Cambios efectuados correctamente</h2>"; $respuesta->addAssign($capa,"innerHTML",$resultado);
return $respuesta;
						}
elseif ($id_medicamento == '0'){
$resultado .= "<form name='medicamentos' id='medicamentos'>
<input type='text' name='id_item' id='id_item' value='nuevo'>
C&oacute;digo 01:<br><input type='text' name='cod_01' size='32' maxlength='5' ><br>
C&oacute;digo 02:<br><input type='text' name='cod_02' size='32' maxlength='5' ><br>
C&oacute;digo 03:<br><input type='text' name='cod_03' size='32' maxlength='5' ><br>
C&oacute;digo 04:<br><input type='text' name='cod_04' size='32' maxlength='5' ><br>
Nombre del medicamento:<br><input type='text' name='medicamento_nombre' size='32' maxlength='200' ><br>
Forma concentraci&oacute;n:<br><input type='text' name='concentracion_forma' size='32' maxlength='32' ><br>
Observaciones:<br><textarea name='observaciones' cols='30' rows='6' id='observaciones'></textarea><br>
Estado:<select name='estado_medicamento' size='1'> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
NOPOS:<select name='NOPOS' size='1'> 
<option value='1'>NOPOS</option> 
<option value='0'>POS</option>
</select><br>
<input type='button' value='Agregar Medicamento' onclick=\"xajax_parametrizacion_medicamentos('grabar',xajax.getFormValues(medicamentos),'$capa')\">
</form>";
}

elseif($id_medicamento==''){ 
	$resultado .= "
Medicamento:<select name='editar_medicamento' id='editar_medicamento' onchange=\"xajax_parametrizacion_medicamentos('',this.value,'$capa')\" size='1' style='width:320'> 
	   <option value=''>Seleccionar</option>
 	   <option value='0'>         INCLUIR NUEVO MEDICAMENTO </option> 
 	   <option value=''>----------------------------------------------------</option>
";
	$consulta = "SELECT id_medicamento, medicamento_nombre, nopos, concentracion_forma FROM medicamentos ORDER BY `nopos` DESC ,  `medicamento_nombre` ASC";
	$result=mysql_query($consulta,$link);
		while ($row = mysql_fetch_array($result)){
		if($row[nopos]=='1'){$pos='[No POS] ';}else{$pos='';}
  $resultado .= "<option value='$row[id_medicamento]'>$pos $row[medicamento_nombre] $row[concentracion_forma]</option>";
		}
 $resultado .="
</select>
<div id='capamedicamentos' name='capamedicamentos'></div>";
$respuesta->addAssign($capa,"innerHTML",$resultado);
return $respuesta;
	}
	else { 

$consulta = "SELECT cod_01, cod_02, cod_03, cod_04, medicamento_nombre, concentracion_forma, observaciones, estado, nopos 
				FROM medicamentos 
				WHERE id_medicamento = $id_medicamento";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[estado]=="1"){
$activo = "ACTIVO";
}
else{$activo = "INACTIVO";}
if ($row[nopos] !="1"){
$pos = "POS";
}
else{$pos = "NO POS";}
$resultado .= "<form name='medicamentos' id='medicamentos'>
Código interno:
<input readonly type='text' name='id_item' ID='id_item' value='$id_medicamento' class='invisible' size='6'>
<br>
C&oacute;digo 01:<br><input type='text' name='cod_01' size='32' maxlength='5' value ='$row[cod_01]'><br>
C&oacute;digo 02:<br><input type='text' name='cod_02' size='32' maxlength='5' value ='$row[cod_02]'><br>
C&oacute;digo 03:<br><input type='text' name='cod_03' size='32' maxlength='5' value ='$row[cod_03]'><br>
C&oacute;digo 04:<br><input type='text' name='cod_04' size='32' maxlength='5' value ='$row[cod_04]'><br>
Nombre del medicamento:<br><input type='text' name='medicamento_nombre' size='32' maxlength='32' value ='$row[medicamento_nombre]' ><br>
Forma concentraci&oacute;n:<br><input type='text' name='concentracion_forma' size='32' maxlength='32' value ='$row[concentracion_forma]'><br>
Observaciones y/o Bibliografía:<br><textarea name='observaciones' cols='30' rows='6' id='observaciones'>$row[observaciones]</textarea><br>
Estado:<select name='estado_medicamento' size='1'> 
<option value='$row[estado]'>".$activo."</option> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
NOPOS:<select name='NOPOS' size='1'> 
<option value='$row[nopos]' selected >$pos</option> 
<option value='1'>NOPOS</option> 
<option value='0'>POS</option>
</select><br>
<input type='button' value='Editar Medicamento' onclick=\"xajax_parametrizacion_medicamentos('grabar',xajax.getFormValues(medicamentos),'capamedicamentos')\">
</form>";
}



$respuesta->addAssign("capamedicamentos","innerHTML",$resultado);
return $respuesta;
} 
/// fin parametrizacion_medicamentos
$xajax->registerFunction("parametrizacion_medicamentos");
function importar_dgh($capa,$path,$formulario){
$respuesta = new xajaxResponse('utf-8');
if($path ==''){
$resultado ="
<form name='formulario_importacion_dgh' id='formulario_importacion_dgh' method='post' enctype='multipart/form-data' action='adentro.php?page=importar'>
Archivo: <input type='file' id='tabla_usuarios_dgh' name='tabla_usuarios_dgh' size='50'>
<br>Para usuarios existentes 
<select id='accion_existentes' name='accion_existentes' title='Especifique que debe hacer el sistema si encuentra usuarios existentes o repetidos'>
	<option value='0'>Ignorar</option>
	<option value='1'>Actualizar</option>
	<option value='2'>Detener importación</option>
</select> 
<br>Datos separados por:
 Coma(,)<input CHECKED type='radio' id='separador' name='separador'  value='0' title='Los datos se encuentran separados por Coma(,)'> /
 Punto y coma (;)<input type='radio' id='separador' name='separador'  value='1'  title='Los datos se encuentran separados por PUNTO Y COMA(;)'>
 <br>Nombre de columnas en la primera fila? 
SI<input CHECKED type='radio' id='encabezado' name='encabezado'  value='1' title='ENCABEZADO O NOMBRE DE LOS CAMPOS EN LA PRIMERA FILA'> /
NO<input type='radio' id='encabezado' name='encabezado'  value='0'  title='EL ARCHIVO NO CONTIENE ENCABEZADOS'>
<BR><input type='submit' value='Enviar'> 
</form>
";
					}

$respuesta->addAssign($capa,"innerHTML",$resultado);
return $respuesta;
}

$xajax->registerFunction("importar_dgh");
function importar($formulario,$capa,$tabla,$path,$separador,$encabezado,$accion_existentes){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
if($formulario=='listado'){
//$path="terceros/temporal";
$directorio=dir($path);

while ($archivo = $directorio->read())
									{

if (strlen($archivo)>3 )
							{$path2="$path/$archivo";
							$nuevo_select .= "<li>$archivo <a onClick=\"xajax_importar('preview','$capa','$tabla','$path2','$separador','$encabezado','$accion_existentes')\" class='cursor'> [<font size='-3' COLOR='green' title=''>IMPORTAR</font></a>]</li>";
							}
  									}
$directorio->close();
									}////fin de listado
									
elseif($formulario=='preview'){							
/*
foreach (glob("*.txt") as $nombre_archivo) {
    echo "$nombre_archivo tamaño " . filesize($nombre_archivo) . "\n";
}

*/
/*
$fp = fopen ($path, "r");

while ($data = fgetcsv ($fp, 1000, “,”)){

$insertar .="INSERT INTO usuarios (nombre,apellidos,delegacion,email)VALUES (’".$data[0]."‘ )<hr>";

//mysql_query($insertar, $cnx);

}

fclose($fp);
$nuevo_select= $insertar;
*/
$row = 1;
$handle = fopen($path, "r");
if($separador=='0'){$separador =',';}else{$separador =';';}
while (($data = fgetcsv($handle, 1000, "$separador")) !== FALSE) {
    $num = count($data);
    //nuevo_select .= "<p> $num fields in line $row: <br /></p>\n";
    //$row++;
    //for ($c=0; $c < $num; $c++) {
    $control = md5($data[2]);

 $id_grupo = "2";
 $id_empresa = "1";
 $contrato = $data[11];
 $plan_beneficios = $data[9];
 $tipo_usuario = $data[8];
 $p_nombre = $data[5];
 $s_nombre = $data[6];
 $p_apellido = $data[3];
 $s_apellido = $data[4];
 $nombre_completo = "$data[5] $data[6] $data[3] $data[4]";
 $fecha_nacimiento = $data[19];
/* $array_nacimiento = explode ( "-", $fecha_de_nacimiento );


$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años
$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días
*/
 $documento_tipo = $data[1];
 if($documento_tipo =='3'){$documento_tipo='5';}
 elseif($documento_tipo =='5'){$documento_tipo='3';}
 else{$documento_tipo=$documento_tipo;} 
 $documento_numero = $data[2];
 $documento_expedicion = $data[43];
 $direccion = $data[16];
 $barrio = $data[14];
 //$control = md5(mktime()+rand(32234));
 $ciudad = $data[48];
 $zona_residencia = $data[59];
  if($zona_residencia =='1'){$zona_residencia='U';}
  else{$zona_residencia='R';}
 $departamento = $data[47];
 $pais = "COL";
 $genero = $data[22];
     if($genero=='1') {$genero="M";}
    else{$genero="F";}
 $estrato = $data[15];
 $ocupacion = $data[20];
 $cargo = $data[21];
 $carnet= $data[61];
 $link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
/*
 $buscar_usuarios_repetidos ="SELECT id, documento_numero , nombre_completo FROM d9_users WHERE documento_numero = '$documento_numero'";
 $sql =mysql_query($buscar_usuarios_repetidos,$link);
if (mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
$nuevo_select .= "" . $row['id'] . "" . $row['nombre_completo'] . "<br>";
														}
								} 
								*/
$buscar_contratos ="SELECT  id_cliente, razon_social , alias FROM clientes WHERE numero_contrato = '$contrato' LIMIT 1";
 $sql =mysql_query($buscar_contratos,$link);
if (mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
$contador++ ;
$nuevo_select .= "$contador $row[id_cliente]  $row[razon_social] $row[alias]<br>";

														}
								} else{$nuevo_select .= "<font color='red'>No existe el contrato <b>$contrato</b></font><br>";}
  /*		  $nuevo_select .=  "INSERT INTO `d9_users` (

 `id_grupo`,
 `id_empresa`,
 `id_cliente`,
 `plan_beneficios`,
 `tipo_usuario`,
 `p_nombre`,
 `s_nombre`,
 `p_apellido`,
 `s_apellido`,
 `nombre_completo`,
 `fecha_nacimiento`,
 `documento_tipo`,
 `documento_numero`,
 `documento_expedicion`,
 `direccion`,
 `barrio`,
 `control`,
 `ciudad`,
 `zona_residencia`,
 `departamento`,
 `pais`,
 `genero`,
 `estrato`,
 `carnet`
 
 ) VALUES <br>(  $id_grupo / 
 $id_empresa / 
 $id_cliente / 
 $plan_beneficios / 
 $tipo_usuario / 
 $p_nombre / 
 $s_nombre / 
 $p_apellido / 
 $s_apellido / 
 $nombre_completo / 
 $fecha_nacimiento / 
 $documento_tipo / 
 $documento_numero / 
 $documento_expedicion / 
 $direccion / 
 $barrio / 
 $control / 
 $ciudad / 
 $zona_residencia / 
 $departamento / 
 $pais / 
 $genero / 
 $estrato / 
 $ocupacion / 
 $cargo / 
 $carnet/)<hr>";
$resultado= ""; 
*/
    //}
}
fclose($handle);
//include_once("librerias/conex.php"); 
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");

//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$nuevo_select .= "" . $row['id'] . "" . $row['nombre_completo'] . "<br>";
//															}
//										}
								}///fin de preview
								else{}
$respuesta->addAssign($capa,"innerHTML",$nuevo_select);
return $respuesta;
} 
$xajax->registerFunction("importar");
 
//tipos de consulta

function parametrizacion_tipo_consulta($tipo,$capa,$id){ 
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
 if($tipo=='consultar_listado'){
 $consulta="SELECT * FROM consulta_tipo";
 $sql =mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$resultado ="Tipo de Consulta: <select name='id_consulta_tipo' id='id_consulta_tipo' onchange=\"xajax_parametrizacion_tipo_consulta('consultar_campos','$capa',this.value)\">";
$resultado .= "<option value=''>Tipo de consulta</option>";
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "<option value='$row[id_consulta_tipo]'>$row[consulta_tipo_nombre]</option>";
															}
$resultado .="</select>";															
										}
										}
										
if ($tipo=='consultar_campos'){
 $consulta="SELECT consulta_tipo_campos.id_campo,campo_nombre, obligatorio,control,prellenado,consulta_tipo_campos.orden FROM consulta_tipo_campos, consulta_campos WHERE tipo_consulta = $id AND consulta_tipo_campos.id_campo = consulta_campos.id_consulta_campo ORDER BY consulta_tipo_campos.orden";
 $sql =mysql_query($consulta,$link);
 $consulta_nombre="SELECT * FROM consulta_tipo WHERE id_consulta_tipo ='$id'";
 $sql_nombre =mysql_query($consulta_nombre,$link);
 $consulta_tipo_nombre =mysql_result($sql_nombre,0,"consulta_tipo_nombre");
 //if (mysql_num_rows($sql)!='0'){
$resultado ="<h2>$consulta_tipo_nombre</h2>
				<table>"; 
				$resultado .= "<tr><td><b>Campo</b></td><td><b>Obligatorio</b></td><td>Prellenado</td><td>Orden</td><td>X</td></tr>";

while( $row = mysql_fetch_array( $sql ) ) 	{
$resultado .= "<tr>
						<td><sup><font color='#7F7F7F'>($row[id_campo]) </font></sup> $row[campo_nombre]</td>
						<td>
							<div name='obligatorio_$row[control]' id='obligatorio_$row[control]' style='display:inline'>
								<a title='Click para cambiar el valor' 
								onClick=\"xajax_parametrizacion_tipo_consulta('obligatorio','obligatorio_$row[control]','$row[obligatorio]','$row[control]')\">$row[obligatorio]
								</a>
							</div>
						</td>
						<td>
							<div name='prellenado_$row[control]' id='prellenado_$row[control]' style='display:inline'>
								<a title='Click para cambiar el valor' 
								onClick=\"xajax_parametrizacion_tipo_consulta('prellenado','prellenado_$row[control]','$row[prellenado]','$row[control]')\">$row[prellenado]
								</a>
							</div>
						</td>
						<td>
							<div name='orden_$row[control]' id='orden_$row[control]' style='display:inline'>
								<a title='Click para cambiar el valor' 
								onClick=\"xajax_parametrizacion_tipo_consulta('orden','orden_$row[control]','$row[orden]','$row[control]')\">$row[orden]
								</a>
							</div>
						</td>
						<td>
								<div name='eliminar_$row[control]' id='eliminar_$row[control]' style='display:inline'>
								<a title='Click para cambiar el valor' 
								onClick=\"xajax_parametrizacion_tipo_consulta('eliminar','eliminar_$row[control]','','$row[control]','$id','$capa')\">
								<img src='images/eliminar.gif' border='0' alt='[X]' title='Eliminar este campo'> 
								</a>
							</div>
						</td>
					</tr>";
															}
$resultado .="</table>";	
$consulta_campos_todos ="SELECT  consulta_campos.id_consulta_campo, consulta_campos.campo_nombre FROM consulta_campos ORDER BY campo_nombre ";	
$sql_consulta_campo =mysql_query($consulta_campos_todos,$link); 
//if(mysql_num_rows($sql_consulta_campo) !='0')	{
$resultado .="<div name='atencion' id='atencion' style='display:inline'></div>
<select name='id_consulta_campo' id='id_consulta_campo' onchange=\"xajax_parametrizacion_tipo_consulta('grabar_campos','$capa',this.value,'$id')\">";
$resultado .= "<option value=''> Agregar campo a $consulta_tipo_nombre  </option>";
								while( $row = mysql_fetch_array( $sql_consulta_campo ) ) {
$resultado .= "<option value='$row[id_consulta_campo]'>$row[campo_nombre]</option>";
																											}
$resultado .="</select> <hr>";	
												//				}											
														
										//	}
											}/// fin de consultar_campos
											
if($tipo=='grabar_campos'){
$id_consulta=func_get_arg(3);
$consulta = "SELECT id_campo FROM consulta_tipo_campos WHERE id_campo= '$id' AND tipo_consulta= $id_consulta"; 
$sql_consulta =mysql_query($consulta,$link); 
$id_empresa= $_SESSION['id_empresa'];
if(mysql_num_rows($sql_consulta) =='0')	{
$microtime = microtime();
$consulta_grabar=" INSERT INTO consulta_tipo_campos (
`id_campo` ,
`id_empresa` ,
`tipo_consulta` ,
`obligatorio`,
`control`
)
VALUES (
'$id', '$id_empresa', '$id_consulta', '0', md5('$microtime' + rand())
)";
$sql_consulta_grabar =mysql_query($consulta_grabar,$link);
$respuesta->addScript("xajax_parametrizacion_tipo_consulta('consultar_campos','$capa','$id_consulta')");
return $respuesta;
														}else{$capa='atencion';$resultado="<img src='images/atencion.gif' alt='[!]' title='El campo ya pertenece a esa consulta'> ";}

									}///fin de grabar_campos	
									
if($tipo=='eliminar'){
$confirmar=func_get_arg(3);


if($id==''){
$id_c=func_get_arg(4);
$capa_original=func_get_arg(5); 
$resultado = "<img src='images/atencion.gif' border='0' alt='[X]' title='Eliminar este campo'> 
									Seguro que desea eliminar el campo de esta consulta? 
									<a onClick=\"xajax_parametrizacion_tipo_consulta('eliminar','eliminar_$confirmar','$confirmar','$confirmar','$id_c','$capa_original')\"> [SI] </a>
									<a onClick=\"xajax_parametrizacion_tipo_consulta('eliminar','eliminar_$confirmar','x','$confirmar','$id_c','$capa_original')\"> [NO]</a>
									
									";}
	else{
	if($id=='x'){ /// si se pasa una x como argumento se regresa a la capa original
$resultado .= "<a title='Click para cambiar el valor' 
								onClick=\"xajax_parametrizacion_tipo_consulta('eliminar','eliminar_$confirmar','','$confirmar')\">
								<img src='images/eliminar.gif' border='0' alt='[X]' title='Eliminar este campo'> 
								</a>";
				}else{
$consulta="DELETE FROM `consulta_tipo_campos` WHERE `control` = '$confirmar' LIMIT 1";
$sql_consulta_eliminar = mysql_query($consulta,$link);
$capa=func_get_arg(5);
$id_consulta=func_get_arg(4);
$respuesta->addScript("xajax_parametrizacion_tipo_consulta('consultar_campos','$capa','$id_consulta')");
//return $respuesta;
//$resultado = $consulta;
						}
			}

							}/// fin de eliminar											
if($tipo == 'obligatorio'){
if($id == '0'){$id='1';}else{$id='0';}
$control = func_get_arg(3); 
$consulta= "UPDATE `consulta_tipo_campos` SET `obligatorio` = '$id' WHERE `control` = '$control' LIMIT 1 "; 
$sql_consulta_grabar =mysql_query($consulta,$link);
$a ="<a title='Click para cambiar el valor' 
								onClick=\"xajax_parametrizacion_tipo_consulta('obligatorio','obligatorio_$control','$id','$control')\">$id
								</a>";
$respuesta->addAssign($capa,"innerHTML",$a);
return $respuesta;
								
									}/// fin de obligatorio												
if($tipo == 'orden'){ /// orden
//if($id == '0'){$id='1';}else{$id='0';}
$control = func_get_arg(3); 
$consulta= "UPDATE `consulta_tipo_campos` SET `orden` = '$id' WHERE `control` = '$control' LIMIT 1 "; 
$sql_consulta_grabar =mysql_query($consulta,$link);
$a ="<input type='text' size='2' title='Escriba un valor para el orden de aparición de este campo en la consulta' value='$id'
								onChange=\"xajax_parametrizacion_tipo_consulta('orden','orden_$control',this.value,'$control')\">$id
								</a>";
								
$respuesta->addAssign($capa,"innerHTML",$a);
return $respuesta;
								
									}/// fin de obligatorio																	
											
if($tipo == 'prellenado'){
if($id == '0'){$id='1';}else{$id='0';}
$control = func_get_arg(3); 
$consulta= "UPDATE `consulta_tipo_campos` SET `prellenado` = '$id' WHERE `control` = '$control' LIMIT 1 "; 
$sql_consulta_grabar =mysql_query($consulta,$link);
$a ="<a title='Click para cambiar el valor' 
								onClick=\"xajax_parametrizacion_tipo_consulta('prellenado','prellenado_$control','$id','$control')\">$id
								</a>";
$respuesta->addAssign($capa,"innerHTML",$a);
return $respuesta;
								
									}/// fin de oprellenado																	
											
$respuesta->addAssign($capa,"innerHTML",$resultado);
return $respuesta;
 										
			}
// fin de la funcion
$xajax->registerFunction("parametrizacion_tipo_consulta");			
///sucursales
function parametrizacion_editar_sucursal($id_campo,$tipo,$capa,$activo){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($tipo=='editar'){

if($id_campo > 0){
$consulta ="SELECT * FROM sucursales WHERE id_sucursal = '$id_campo'  LIMIT 1";
$sql=mysql_query($consulta,$link);
$sucursal_nombre=mysql_result($sql,0,"sucursal_nombre");
$sucursal_descripcion=mysql_result($sql,0,"sucursal_descripcion");
$sucursal_prioridad=mysql_result($sql,0,"sucursal_prioridad");
$prioridad = "<option value='$sucursal_prioridad' selected>$sucursal_prioridad</option>";
$sucursal_activo=mysql_result($sql,0,"activo");
if($sucursal_activo =='0'){$sucursal_activo = "<option value='0' selected>0</option>";}else{$sucursal_activo = "<option value='1' selected>1</option>";}
					}ELSE{}
$formulario .= "<form name='editar_sucursal' id='editar_sucursal'>
<input name='id_sucursal' id='id_sucursal' type='hidden' value='$id_campo' size='3' readonly>
<input title='Nombre de la sucursal o el área de servicio' name='sucursal_nombre' id='sucursal_nombre' type='text' value='$sucursal_nombre' size='50'>
<br><textarea title='Descripción de la sucursal o el área de servicio' name='sucursal_descripcion' id='sucursal_descripcion' cols='40' rows='4'>$sucursal_descripcion</textarea>
<br>Estado: <select name='activo' id='activo' title='Estado de la sucursal o área de servicio(0= Inactivo, 1= Activo)'>$sucursal_activo<option value='0'>0</option><option value='1'>1</option> </select>
 Prioridad:<select title='Si prioridad >= 5 el area es asistencial\n y se verá reflejada en el triage' name='sucursal_prioridad' id='sucursal_prioridad'  size='1'> 
 		$prioridad 
	   <option value='0'>-</option> 
		<option value='1'>1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
		<option value='4'>4</option>
		<option value='5'>5</option>
		<option value='6'>6</option>
		<option value='7'>7</option>
		<option value='8'>8</option>
		<option value='9'>9</option>
		<option value='10'>10</option>
		</select> <b title='Si prioridad >= 5 el area es asistencial\n y se verá reflejada en el triage'>[?]</b><br>
		<input type='button' onclick=\"xajax_parametrizacion_editar_sucursal(xajax.getFormValues('editar_sucursal'),'guardar','capa_sucursal','')\" value='Guardar los cambios'>
		</form>
";
      }//// fin de editar
      elseif($tipo=='guardar'){
      if($_SESSION['grupo']=='1'){
      $sucursal_nombre = $id_campo["sucursal_nombre"];
      $sucursal_descripcion = $id_campo["sucursal_descripcion"];
      $sucursal_prioridad = $id_campo["sucursal_prioridad"];
      $activo = $id_campo["activo"];
      $id_sucursal = $id_campo["id_sucursal"];
      if($id_sucursal >0){
      $consulta ="UPDATE `sucursales` SET `sucursal_nombre` = '$sucursal_nombre', sucursal_descripcion = '$sucursal_descripcion' , sucursal_prioridad ='$sucursal_prioridad', activo='$activo'  WHERE `id_sucursal` ='$id_sucursal' LIMIT 1 ";
      						}/// si es para editar
      						else{
      							$consulta ="INSERT INTO sucursales(`sucursal_nombre`, `sucursal_descripcion`, `sucursal_prioridad`, `activo`) VALUES ('$sucursal_nombre','$sucursal_descripcion','$sucursal_prioridad','$activo')";
      								}
      				$result=mysql_query($consulta,$link);
      				$formulario="<font color='red'>Grabando ...</font>";	
      				$respuesta->addScript("xajax_parametrizacion_editar_sucursal(this.value,'','$capa','')");	
      						}///fin de administrador
      						else{$formulario ="<img src='images/atencion.gif'> No tiene permisos suficientes para efectuar este proceso";}
      				}////fin de grabar
  elseif($tipo=='establecer'){
  if($id_campo !=''){
$consulta = "SELECT sucursal_descripcion, sucursal_nombre FROM sucursales WHERE id_sucursal = '$id_campo' LIMIT 1";
$sql=mysql_query($consulta,$link);
$sucursal_nombre=mysql_result($sql,0,"sucursal_nombre");
$sucursal_descripcion=mysql_result($sql,0,"sucursal_descripcion");
$ip= $_SERVER['REMOTE_ADDR'];
//$ip = ; 
$consulta ="INSERT INTO sucursales_ocupacion(`id_sucursal`, `id_usuario`, `ip`) VALUES ('$id_campo','$_SESSION[id_usuario]',inet_aton('$ip'))";
$sql=mysql_query($consulta,$link);

  $_SESSION[sucursal]=$id_campo; 
  $_SESSION[sucursal_nombre]=$sucursal_nombre;  
  $formulario="<a href='adentro.php' >Se ha establecido $sucursal_nombre como su área de servicio</a><br>($sucursal_descripcion)";
  								}else{$formulario ="<img src='images/atencion.gif'> No se ha seleccionado un lugar o área de servicio";}	}/// fin establecer     				
 elseif($tipo=='select'){

 $formulario ="<select name='id_editar_sucursal' id='id_editar_sucursal' onchange=\"xajax_parametrizacion_editar_sucursal(this.value,'establecer','$capa','1')\" size='1' style='width:250'> 
	   			<option value=''>Seleccionar</option>";

	$consulta = "SELECT id_sucursal, sucursal_nombre FROM sucursales WHERE activo ='$activo'";
	$result=mysql_query($consulta,$link);
		while ($row = mysql_fetch_array($result)){
   			$formulario .= "<option value='$row[id_sucursal]'>$row[sucursal_nombre]</option>";
																}

				$formulario .="</select>";
 
      				  }/// fin de select
elseif($tipo=='solo_select'){

 $formulario ="<br> Seleccionar área de servicio: <select name='id_sucursal' id='id_sucursal'  size='1' style='width:250'> 
	   			<option value=''>Sin selección</option>";

	$consulta = "SELECT id_sucursal, sucursal_nombre FROM sucursales WHERE activo ='$activo' AND sucursal_prioridad >= '5'";
	$result=mysql_query($consulta,$link);
		while ($row = mysql_fetch_array($result)){
   			$formulario .= "<option value='$row[id_sucursal]'>$row[sucursal_nombre]</option>";
																}

				$formulario .="</select>";
 
      				  }/// fin de select      				  
      								else{$formulario ="
      								
Sucursal o área de servicio:<select name='id_editar_sucursal' id='id_editar_sucursal' onchange=\"xajax_parametrizacion_editar_sucursal(this.value,'editar','$capa','')\" size='1' style='width:250'> 
	   <option value=''>Seleccionar</option> 
	   <option value=''>---------------------------</option> 
	   <option value='0'>      CREAR NUEVO   </option> 
	   <option value=''>---------------------------</option> ";

	$consulta = "SELECT id_sucursal, sucursal_nombre FROM sucursales";
	$result=mysql_query($consulta,$link);
		while ($row = mysql_fetch_array($result)){
   			$formulario .= "<option value='$row[id_sucursal]'>$row[sucursal_nombre]</option>";
																}

				$formulario .="</select>";
      									}


$respuesta->addAssign($capa,"innerHTML",$formulario);
return $respuesta;
} 
$xajax->registerFunction("parametrizacion_editar_sucursal");
/// fin sucursales

function comprobar_tipo_plan_beneficios($id_editar_tipo_plan_beneficios){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
if ($id_editar_tipo_plan_beneficios == 0){
$nuevo_select = "<h3>El n&uacute;mero identificador no puede ser 0</h3>";
}
else{
include_once("librerias/conex.php");
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
$consulta = "Select tipo_plan_beneficios FROM tipo_plan_beneficios where id_tipo_plan_beneficios = $id_editar_tipo_plan_beneficios";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[0]==""){
$nuevo_select = "<h3>Campo disponible</h3>";
$nuevo_select .= '<input type="hidden" id="sobreescribir" name="sobreescribir" value="1">';
}
else{
$nuevo_select = "<h3>El campo se encuentra ocupado por el valor ";
$nuevo_select .= $row[0]."</h3>";
$nuevo_select .= '<tr><td>Desea sobreescribir:</td><td>Si <input name="sobreescribir" id="sobreescribir_si" value="1" type="radio"> No<input name="sobreescribir" id="sobreescribir_no" value="0" checked="checked" type="radio"></td>
</tr>';
}
}
$respuesta->addAssign("capacompruebaplanbeneficios","innerHTML",$nuevo_select);
return $respuesta;
}

function parametrizacion_editar_tipo_plan_beneficios($edita_tipo_plan_beneficios){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$aux_id_tipo_plan_beneficios = $edita_tipo_plan_beneficios["aux_id_tipo_plan_beneficios"];
$id_editar_tipo_plan_beneficios = $edita_tipo_plan_beneficios["id_editar_tipo_plan_beneficios"];
$activo_editar_tipo_plan_beneficios = $edita_tipo_plan_beneficios["activo_editar_tipo_plan_beneficios"];
$tipo_plan_beneficios = $edita_tipo_plan_beneficios["tipo_plan_beneficios"];
$editar_tipo_plan_beneficios_descripcion = $edita_tipo_plan_beneficios["editar_tipo_plan_beneficios_descripcion"];
$sobreescribir = $edita_tipo_plan_beneficios["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `tipo_plan_beneficios` WHERE `id_tipo_plan_beneficios`= '$id_editar_tipo_plan_beneficios' ",$link);
mysql_query("UPDATE `tipo_plan_beneficios` SET  `tipo_plan_beneficios`= '$tipo_plan_beneficios', `tipo_plan_beneficios_descripcion`= '$editar_tipo_plan_beneficios_descripcion', `activo`= '$activo_editar_tipo_plan_beneficios', `id_tipo_plan_beneficios`= '$id_editar_tipo_plan_beneficios' WHERE `id_tipo_plan_beneficios`= '$aux_id_tipo_plan_beneficios' ",$link);
$nuevo_select = "<h3>Tipo plan de beneficio editado correctamente</h3>";
}
else{
if ($id_editar_tipo_plan_beneficios == $id_editar_tipo_plan_beneficios){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `tipo_plan_beneficios` SET  `tipo_plan_beneficios`= '$tipo_plan_beneficios', `tipo_plan_beneficios_descripcion`= '$editar_tipo_plan_beneficios_descripcion', `activo`= '$activo_editar_tipo_plan_beneficios', `id_tipo_plan_beneficios`= '$id_editar_tipo_plan_beneficios' WHERE `id_tipo_plan_beneficios`= '$aux_id_tipo_plan_beneficios' ",$link);
$nuevo_select = "<h3>Tipo plan de beneficio editado correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se edito el plan de beneficios seleccionado</h3>";
}
}
$respuesta->addAssign("capaplanbeneficios","innerHTML",$nuevo_select);
return $respuesta;
}

function comprobar_estado_civil($id_editar_estado_civil){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
if ($id_editar_estado_civil == 0){
$nuevo_select = "<h3>El n&uacute;mero identificador no puede ser 0</h3>";
}
else{
include_once("librerias/conex.php");
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
$consulta = "Select estado_civil FROM estado_civil where id_estado_civil = $id_editar_estado_civil";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[0]==""){
$nuevo_select = "<h3>Campo disponible</h3>";
$nuevo_select .= '<input type="hidden" id="sobreescribir" name="sobreescribir" value="1">';
}
else{
$nuevo_select = "<h3>El campo se encuentra ocupado por el valor ";
$nuevo_select .= $row[0]."</h3>";
$nuevo_select .= '<tr><td>Desea sobreescribir:</td><td>Si <input name="sobreescribir" id="sobreescribir_si" value="1" type="radio"> No<input name="sobreescribir" id="sobreescribir_no" value="0" checked="checked" type="radio"></td>
</tr>';
}
}
$respuesta->addAssign("capacompruebaestadocivil","innerHTML",$nuevo_select);
return $respuesta;
}

function parametrizacion_editar_estado_civil($edita_estado_civil){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$aux_id_estado_civil = $edita_estado_civil["aux_id_estado_civil"];
$id_estado_civil = $edita_estado_civil["id_estado_civil"];
$estado_civil = $edita_estado_civil["estado_civil"];
$sobreescribir = $edita_estado_civil["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `estado_civil` WHERE `id_estado_civil`= '$id_estado_civil'",$link);
mysql_query("UPDATE `estado_civil` SET  `id_estado_civil`= '$id_estado_civil', `estado_civil`= '$estado_civil' WHERE `id_estado_civil`= '$aux_id_estado_civil' ",$link);
$nuevo_select = "<h3>Estado civil editado correctamente</h3>";
}
else{
if ($aux_id_estado_civil == $id_estado_civil){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `estado_civil` SET  `id_estado_civil`= '$id_estado_civil', `estado_civil`= '$estado_civil' WHERE `id_estado_civil`= '$aux_id_estado_civil' ",$link);
$nuevo_select = "<h3>Estado civil editado correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se edito el estado civil seleccionado</h3>";
}
}
$respuesta->addAssign("capaestadocivil","innerHTML",$nuevo_select);
return $respuesta;
}

function comprobar_tipo_documento_id($id_editar_tipo_documento_id){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
if ($id_editar_tipo_documento_id == 0){
$nuevo_select = "<h3>El n&uacute;mero identificador no puede ser 0</h3>";
}
else{
include_once("librerias/conex.php");
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
$consulta = "Select documento_tipo FROM documento_tipo where id_documento_tipo = $id_editar_tipo_documento_id";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[0]==""){
$nuevo_select = "<h3>Campo disponible</h3>";
$nuevo_select .= '<input type="hidden" id="sobreescribir" name="sobreescribir" value="1">';
}
else{
$nuevo_select = "<h3>El campo se encuentra ocupado por el valor ";
$nuevo_select .= $row[0]."</h3>";
$nuevo_select .= '<tr><td>Desea sobreescribir:</td><td>Si <input name="sobreescribir" id="sobreescribir_si" value="1" type="radio"> No<input name="sobreescribir" id="sobreescribir_no" value="0" checked="checked" type="radio"></td>
</tr>';
}
}
$respuesta->addAssign("capacompruebadocumentoid","innerHTML",$nuevo_select);
return $respuesta;
}


function parametrizacion_editar_tipo_documento($edita_documento_tipo){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$aux_id_documento_tipo = $edita_documento_tipo["aux_id_documento_tipo"];
$id_editar_documento_tipo = $edita_documento_tipo["id_editar_tipo_documento_id"];
$editar_documento_tipo = $edita_documento_tipo["editar_documento_tipo"];
$sobreescribir = $edita_documento_tipo["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `documento_tipo` WHERE `id_documento_tipo`= '$id_editar_documento_tipo'",$link);
mysql_query("UPDATE `documento_tipo` SET  `id_documento_tipo`= '$id_editar_documento_tipo', `documento_tipo`= '$editar_documento_tipo' WHERE `id_documento_tipo`= '$aux_id_documento_tipo' ",$link);
$nuevo_select = "<h3>Tipo de documento editado correctamente</h3>";
}
else{
if ($aux_id_documento_tipo == $id_editar_documento_tipo){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `documento_tipo` SET  `id_documento_tipo`= '$id_editar_documento_tipo', `documento_tipo`= '$editar_documento_tipo' WHERE `id_documento_tipo`= '$aux_id_documento_tipo' ",$link);
$nuevo_select = "<h3>Tipo de documento editado correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se edito el tipo de documento seleccionado</h3>";
}
}
$respuesta->addAssign("capadocumentotipo","innerHTML",$nuevo_select);
return $respuesta;
}

function comprobar_escolaridad($id_editar_escolaridad){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
if ($id_editar_escolaridad == 0){
$nuevo_select = "<h3>El n&uacute;mero identificador no puede ser 0</h3>";
}
else{
include_once("librerias/conex.php");
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
$consulta = "Select escolaridad FROM escolaridad where id_escolaridad = $id_editar_escolaridad";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[0]==""){
$nuevo_select = "<h3>Campo disponible</h3>";
$nuevo_select .= '<input type="hidden" id="sobreescribir" name="sobreescribir" value="1">';
}
else{
$nuevo_select = "<h3>El campo se encuentra ocupado por el valor ";
$nuevo_select .= $row[0]."</h3>";
$nuevo_select .= '<tr><td>Desea sobreescribir:</td><td>Si <input name="sobreescribir" id="sobreescribir_si" value="1" type="radio"> No<input name="sobreescribir" id="sobreescribir_no" value="0" checked="checked" type="radio"></td>
</tr>';
}
}
$respuesta->addAssign("capacompruebaescolaridad","innerHTML",$nuevo_select);
return $respuesta;
}


function parametrizacion_editar_escolaridad($edita_escolaridad){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_escolaridad = $edita_escolaridad["id_escolaridad"];
$aux_id_escolaridad = $edita_escolaridad["aux_id_escolaridad"];
$escolaridad = $edita_escolaridad["escolaridad"];
$sobreescribir = $edita_escolaridad["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE FROM `escolaridad` WHERE `id_escolaridad`= '$id_escolaridad'",$link);
mysql_query("UPDATE `escolaridad` SET  `id_escolaridad`= '$id_escolaridad', `escolaridad`= '$escolaridad' WHERE `id_escolaridad`= '$aux_id_escolaridad' ",$link);
$nuevo_select = "<h3>Escolaridad editada correctamente</h3>";
}
else{
if ($aux_id_escolaridad == $id_escolaridad){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `escolaridad` SET  `id_escolaridad`= '$id_escolaridad', `escolaridad`= '$escolaridad' WHERE `id_escolaridad`= '$aux_id_escolaridad' ",$link);
$nuevo_select = "<h3>Escolaridad editada correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se edito la escolaridad seleccionado</h3>";
}
}
$respuesta->addAssign("capaescolaridad","innerHTML",$nuevo_select);
return $respuesta;
}

function comprobar_tipo_usuario($id_editar_tipo_usuario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
if ($id_editar_tipo_usuario == 0){
$nuevo_select = "<h3>El n&uacute;mero identificador no puede ser 0</h3>";
}
else{
include_once("librerias/conex.php");
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
$consulta = "Select tipo_usuario FROM tipo_usuarios where id_tipo_usuario = $id_editar_tipo_usuario";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[0]==""){
$nuevo_select = "<h3>Campo disponible</h3>";
$nuevo_select .= '<input type="hidden" id="sobreescribir" name="sobreescribir" value="1">';
}
else{
$nuevo_select = "<h3>El campo se encuentra ocupado por el valor ";
$nuevo_select .= $row[0]."</h3>";
$nuevo_select .= '<tr><td>Desea sobreescribir:</td><td>Si <input name="sobreescribir" id="sobreescribir_si" value="1" type="radio"> No<input name="sobreescribir" id="sobreescribir_no" value="0" checked="checked" type="radio"></td>
</tr>';
}
}
$respuesta->addAssign("capacompruebatipousuario","innerHTML",$nuevo_select);
return $respuesta;
}

function parametrizacion_editar_tipo_usuario($edita_tipo_usuario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_editar_tipo_usuario = $edita_tipo_usuario["id_editar_tipo_usuario"];
$aux_id_tipo_usuario = $edita_tipo_usuario["aux_id_tipo_usuario"];
$nombre_editar_tipo_usuario = $edita_tipo_usuario["nombre_editar_tipo_usuario"];
$descripcion_editar_tipo_usuario = $edita_tipo_usuario["descripcion_editar_tipo_usuario"];
$activo_editar_tipo_usuario = $edita_tipo_usuario["activo_editar_tipo_usuario"];
$sobreescribir = $edita_tipo_usuario["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php");
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE FROM `tipo_usuarios` WHERE `id_tipo_usuario`= '$id_editar_tipo_usuario'",$link);
mysql_query("UPDATE `tipo_usuarios` SET  `id_tipo_usuario`= '$id_editar_tipo_usuario', `tipo_usuario`= '$nombre_editar_tipo_usuario', `tipo_descripcion`='$descripcion_editar_tipo_usuario', `activo`= '$activo_editar_tipo_usuario' WHERE `id_tipo_usuario`= '$aux_id_tipo_usuario' ",$link);
$nuevo_select = "<h3>Tipo de usuario editado correctamente</h3>";
}
else{
if ($aux_id_escolaridad == $id_escolaridad){
include_once("librerias/conex.php");
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `tipo_usuarios` SET  `id_tipo_usuario`= '$id_editar_tipo_usuario', `tipo_usuario`= '$nombre_editar_tipo_usuario', `tipo_descripcion`='$descripcion_editar_tipo_usuario', `activo`= '$activo_editar_tipo_usuario' WHERE `id_tipo_usuario`= '$id_editar_tipo_usuario' ",$link);
$nuevo_select = "<h3>Tipo de usuario editado correctamente</h3>";
}
else {
$nuevo_select = "<h3>No se edito el tipo de usuario seleccionado</h3>";
}
}
$respuesta->addAssign("capatipousuario","innerHTML",$nuevo_select);
return $respuesta;
}


function parametrizacion_editar_tipo_orden($edita_tipo_orden){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_editar_tipo_orden = $edita_tipo_orden["id_editar_tipo_orden"];
$activo_tipo_orden = $edita_tipo_orden["activo_tipo_orden"];
$tipo_orden = $edita_tipo_orden["tipo_orden"];
$descripcion_tipo_orden = $edita_tipo_orden["descripcion_tipo_orden"];
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `tipo_orden` SET  `orden_tipo`= '$tipo_orden', `descripcion`='$descripcion_tipo_orden', `estado`= '$activo_tipo_orden' WHERE `id_tipo_orden`= '$id_editar_tipo_orden' ",$link);
$nuevo_select = "Tipo de orden editado correctamente";
$respuesta->addAssign("capatipoorden","innerHTML",$nuevo_select);
return $respuesta;
}

function parametrizacion_editar_medicamentos($editar_medicamentos,$capa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");

$id_editar_medicamento = $editar_medicamentos["id_editar_medicamento"];
$cod_01 = $editar_medicamentos["cod_01"];
$cod_02 = $editar_medicamentos["cod_02"];
$cod_03 = $editar_medicamentos["cod_03"];
$cod_04 = $editar_medicamentos["cod_04"];
$medicamento_nombre = $editar_medicamentos["medicamento_nombre"];
$concentracion_forma = $editar_medicamentos["concentracion_forma"];
$observaciones = $editar_medicamentos["observaciones"];
$estado_medicamento = $editar_medicamentos["estado_medicamento"];
$NOPOS = $editar_medicamentos["NOPOS"];

mysql_query("UPDATE `medicamentos` SET `cod_01`='$cod_01', `cod_02`= '$cod_02', `cod_03`= '$cod_03', `cod_04`= '$cod_04', `medicamento_nombre`= '$medicamento_nombre', `concentracion_forma`= '$concentracion_forma', `observaciones`= '$observaciones', `estado`= '$estado_medicamento', `nopos`= '$NOPOS' WHERE `id_medicamento`= '$id_editar_medicamento' ",$link);
$nuevo_select = "Medicamento editado correctamente";
$respuesta->addAssign($capa,"innerHTML",$nuevo_select);
return $respuesta;
}


function parametrizacion_editar_ayuda_clases($editar_ayuda_clase){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_editar_ayuda_clase = $editar_ayuda_clase["id_editar_ayuda_clase"];
$activo_editar_ayuda_clase = $editar_ayuda_clase["activo_editar_ayuda_clase"];
$editar_ayuda_clases = $editar_ayuda_clase["editar_ayuda_clases"];
$editar_ayuda_forma = $editar_ayuda_clase["editar_ayuda_forma"];
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `ayuda_clases` SET  `ayuda_clase`= '$editar_ayuda_clases', `ayuda_forma`='$editar_ayuda_forma', `activo`= '$activo_editar_ayuda_clase' WHERE `id_ayuda_clase`= '$id_editar_ayuda_clase' ",$link);
$nuevo_select = "Ayuda clase editada correctamente";
$respuesta->addAssign("capaayudaclase","innerHTML",$nuevo_select);
return $respuesta;
}

function parametrizacion_editar_grupo($editar_grupos){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_editar_grupo = $editar_grupos["id_grupo"];
$nombre_editar_grupo = $editar_grupos["nombre_editar_grupo"];
$descripcion_editar_grupo = $editar_grupos["descripcion_editar_grupo"];
$prioridad_editar_grupo = $editar_grupos["prioridad_editar_grupo"];
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("UPDATE `usuarios_grupo` SET `grupo_nombre`= '$nombre_editar_grupo', `descripcion_grupo`= '$descripcion_editar_grupo', `prioridad`='$prioridad_editar_grupo' WHERE `id_grupo`= '$id_editar_grupo' ",$link);
$nuevo_select = "Grupo editado correctamente";
$respuesta->addAssign("capagrupos","innerHTML",$nuevo_select);
return $respuesta;
}

///NOMBRE DE LA FUNCION: select_editar_medicamentos
//Esta funcion es la encargada de habilitar el formulario para edicion de plan beneficio
function select_editar_medicamentos($editar_medicamento){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 

$respuesta->addAssign("capamedicamentos","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_medicamentos

///NOMBRE DE LA FUNCION: select_editar_ayuda_clases
//Esta funcion es la encargada de habilitar el formulario para edicion de plan beneficio
function select_editar_ayuda_clases($editar_ayuda_clases){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if ($editar_ayuda_clases == ""){}
elseif ($editar_ayuda_clases == 0){
$nuevo_select = "<form name='ayuda_clase' id='ayuda_clase'>
Activo:<select name='activo_ayuda_clase' size='1'> 
	   <option value='1'>ACTIVO</option> 
	   <option value='0'>INACTIVO</option>
	   </select><br>
Nombre ayuda clases:<br><input type='text' name='nombre_ayuda_clase' size='32' maxlength='32' ><br>
Forma ayuda clases:<br><textarea name='forma_ayuda_clase' cols='30' rows='6'></textarea><br>
<input type='button' value='Crear ayuda clase' onclick=\"xajax_parametrizacion_ayuda_clase(xajax.getFormValues('ayuda_clase'))\">
</form>";
}
else{
$consulta = "Select ayuda_clase, ayuda_forma, activo from ayuda_clases where id_ayuda_clase = $editar_ayuda_clases";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[2]=="1"){
$activo = "ACTIVO";
}
else{$activo = "INACTIVO";}
$nuevo_select = "<form name='editar_ayuda_clase' id='editar_ayuda_clase'>
<input type='hidden' name='id_editar_ayuda_clase' value='".$editar_ayuda_clases."'>
Estado:<select name='activo_editar_ayuda_clase' size='1'> 
<option value='".$row[2]."'>".$activo."</option> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
Tipo plan beneficios:<br><input type='text' name='editar_ayuda_clases' size='32' maxlength='32' value='".$row[0]."'><br>
Descripcion tipo plan beneficios:<br><textarea name='editar_ayuda_forma' cols='30' rows='6'>".$row[1]."</textarea><br>
<input type='button' value='Editar tipo de ayuda de clases' onclick=\"xajax_parametrizacion_editar_ayuda_clases(xajax.getFormValues('editar_ayuda_clase'))\">
</form>";
}
$respuesta->addAssign("capaayudaclase","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_ayuda_clases

///NOMBRE DE LA FUNCION: select_editar_plan_beneficio
//Esta funcion es la encargada de habilitar el formulario para edicion de plan beneficio
function select_editar_plan_beneficios($editar_tipo_plan_beneficios){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
if ($editar_tipo_plan_beneficios == ""){}
elseif ($editar_tipo_plan_beneficios == 0){
$nuevo_select = "<form name='plan_beneficio' id='plan_beneficio'>
Activo:<select name='activo_beneficio' size='1'> 
	   <option value='1'>ACTIVO</option> 
	   <option value='0'>INACTIVO</option>
	   </select><br>
Tipo plan beneficios:<br><input type='text' name='id_beneficio' size='32' maxlength='32' onchange='xajax_comprobar_tipo_plan_beneficios(this.value)'><br>
<div id='capacompruebaplanbeneficios' name='capacompruebaplanbeneficios'></div>
Nombre tipo plan beneficios:<br><input type='text' name='nombre_beneficio' size='32' maxlength='32' ><br>
Descripci&oacute;n tipo plan beneficio:<br><textarea name='descripcion_beneficio' cols='30' rows='6' id='descripcion_beneficio'></textarea><br>
<input type='button' value='Crear tipo de plan beneficio' onclick=\"xajax_parametrizacion_tipo_plan_beneficio(xajax.getFormValues('plan_beneficio'))\">
</form>";
}
else{
mysql_query("SET NAMES 'utf8'");
$consulta = "Select tipo_plan_beneficios, tipo_plan_beneficios_descripcion, activo from tipo_plan_beneficios where id_tipo_plan_beneficios = $editar_tipo_plan_beneficios";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[2]=="1"){
$activo = "ACTIVO";
}
else{$activo = "INACTIVO";}
$nuevo_select = "<form name='edita_tipo_plan_beneficios' id='edita_tipo_plan_beneficios'>
<input type='hidden' name='aux_id_tipo_plan_beneficios' value='".$editar_tipo_plan_beneficios."'>
Tipo plan beneficios:<br><input type='text' name='id_editar_tipo_plan_beneficios' size='32' maxlength='32' value='".$editar_tipo_plan_beneficios."' onchange='xajax_comprobar_tipo_plan_beneficios(this.value)'><br>
<div id='capacompruebaplanbeneficios' name='capacompruebaplanbeneficios'></div>
Estado:<select name='activo_editar_tipo_plan_beneficios' size='1'> 
<option value='".$row[2]."'>".$activo."</option> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
Nombre tipo plan beneficios:<br><input type='text' name='tipo_plan_beneficios' size='32' maxlength='32' value='".$row[0]."'><br>
Descripcion tipo plan beneficios:<br><textarea name='editar_tipo_plan_beneficios_descripcion' cols='30' rows='6'>".$row[1]."</textarea><br>
<input type='button' value='Editar tipo de plan de beneficios' onclick=\"xajax_parametrizacion_editar_tipo_plan_beneficios(xajax.getFormValues('edita_tipo_plan_beneficios'))\">
</form>";
}
$respuesta->addAssign("capaplanbeneficios","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_tipo_plan_beneficio

///NOMBRE DE LA FUNCION: select_editar_estado_civil
//Esta funcion es la encargada de habilitar el formulario para edicion de estado civil
function select_editar_estado_civil($editar_estado_civil){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
if ($editar_estado_civil == ""){}
elseif ($editar_estado_civil == 0){
mysql_query("SET NAMES 'utf8'");
$nuevo_select = "<form name='estado_civil' id='estado_civil'>
Estado civil:<br><input type='text' name='id_estado_civil' size='32' maxlength='32' onchange='xajax_comprobar_estado_civil(this.value)'><br>
<div id='capacompruebaestadocivil' name='capacompruebaestadocivil'></div><br>
Nombre Estado civil:<br><input type='text' name='estado_civil' size='32' maxlength='32' ><br>
<input type='button' value='Agregar estado civil' onclick=\"xajax_parametrizacion_estado_civil(xajax.getFormValues('estado_civil'))\">
</form>";
}
else{
$consulta = "Select estado_civil from estado_civil where id_estado_civil = $editar_estado_civil";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
$nuevo_select = "<form name='edita_estado_civil' id='edita_estado_civil'>
<input type='hidden' name='aux_id_estado_civil' value='".$editar_estado_civil."'>
Estado civil:<br><input type='text' name='id_estado_civil' size='32' maxlength='32' value='".$editar_estado_civil."' onchange='xajax_comprobar_estado_civil(this.value)'><br>
<div id='capacompruebaestadocivil' name='capacompruebaestadocivil'></div>
Nombre estado civil:<br><input type='text' name='estado_civil' size='32' maxlength='32' value='".$row[0]."'><br>
<input type='button' value='Editar estado civil' onclick=\"xajax_parametrizacion_editar_estado_civil(xajax.getFormValues('edita_estado_civil'))\">
</form>";
}
$respuesta->addAssign("capaestadocivil","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_estado_civil

///NOMBRE DE LA FUNCION: select_editar_tipo_documento_id
//Esta funcion es la encargada de habilitar el formulario para edicion de tipo de documento de id
function select_editar_tipo_documento_id($editar_tipo_id){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
if ($editar_tipo_id == ""){}
elseif ($editar_tipo_id == 0){
$nuevo_select = "<form name='tipo_documento_id' id='tipo_documento_id'>
Tipo documento identificaci&oacute;n: <br><input type='text' name='id_tipo_documento_id' size='50' maxlength='50' onchange='xajax_comprobar_tipo_documento_id(this.value)'><br>
<div id='capacompruebadocumentoid' name='capacompruebadocumentoid'></div>
Nombre Tipo documento identificaci&oacute;n: <br><input type='text' name='tipo_documento_id' size='50' maxlength='50' ><br>
<input type='button' value='Agregar tipo de documento' onclick=\"xajax_parametrizacion_tipo_documento_id(xajax.getFormValues('tipo_documento_id'))\">
</form>";
}
else{
mysql_query("SET NAMES 'utf8'");
$consulta = "Select documento_tipo from documento_tipo where id_documento_tipo = $editar_tipo_id";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
$nuevo_select = "<form name='edita_documento_tipo' id='edita_documento_tipo'>
<input type='hidden' name='aux_id_documento_tipo' value='".$editar_tipo_id."'>
Tipo documento id:<br><input type='text' name='id_editar_tipo_documento_id' size='32' maxlength='32' value='".$editar_tipo_id."' onchange='xajax_comprobar_tipo_documento_id(this.value)'><br>
<div id='capacompruebadocumentoid' name='capacompruebadocumentoid'></div>
Nombre tipo documento id:<br><input type='text' name='editar_documento_tipo' size='32' maxlength='32' value='".$row[0]."'><br>
<input type='button' value='Editar tipo documento identificaci&oacute;n' onclick=\"xajax_parametrizacion_editar_tipo_documento(xajax.getFormValues('edita_documento_tipo'))\">
</form>";
}
$respuesta->addAssign("capadocumentotipo","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_tipo_documento_id


///NOMBRE DE LA FUNCION: select_editar_escolaridad
//Esta funcion es la encargada de habilitar el formulario para edicion de escolaridad
function select_editar_escolaridad($editar_escolaridad){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
if ($editar_escolaridad == ""){}
elseif ($editar_escolaridad == 0){
$nuevo_select = "<form name='escolaridad' id='escolaridad'>
Escolaridad:<br><input type='text' name='id_crear_escolaridad' size='32' maxlength='32' onchange='xajax_comprobar_escolaridad(this.value)'><br>
<div id='capacompruebaescolaridad' name='capacompruebaescolaridad'></div>
Nombre escolaridad:<br><input type='text' name='escolaridad' size='32' maxlength='32' ><br>
<input type='button' value='Crear tipo de escolaridad' onclick=\"xajax_parametrizacion_escolaridad(xajax.getFormValues('escolaridad'))\">
</form>";
}
else{
mysql_query("SET NAMES 'utf8'");
$consulta = "Select escolaridad FROM escolaridad where id_escolaridad = $editar_escolaridad";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
$nuevo_select = "<form name='edita_escolaridad' id='edita_escolaridad'>
<input type='hidden' name='aux_id_escolaridad' value='".$editar_escolaridad."'>
Escolaridad:<br><input type='text' name='id_escolaridad' size='32' maxlength='32' value='".$editar_escolaridad."' onchange='xajax_comprobar_escolaridad(this.value)'><br>
<div id='capacompruebaescolaridad' name='capacompruebaescolaridad'></div>
Nombre escolaridad:<br><input type='text' name='escolaridad' size='32' maxlength='32' value='".$row[0]."'><br>
<input type='button' value='Editar escolaridad' onclick=\"xajax_parametrizacion_editar_escolaridad(xajax.getFormValues('edita_escolaridad'))\">
</form>";
}
$respuesta->addAssign("capaescolaridad","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_escolaridad

///NOMBRE DE LA FUNCION: select_editar_orden
//Esta funcion es la encargada de habilitar el formulario para edicion de tipo de orden
function select_editar_orden($editar_tipo_orden){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
if ($editar_tipo_orden == ""){}
elseif ($editar_tipo_orden == 0){
$nuevo_select = "<form name='tipo_orden' id='tipo_orden'>
Estado:<select name='activo_tipo_orden' size='1'> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
Tipo Orden:<br><input type='text' name='nombre_tipo_orden' size='32' maxlength='32'><br>
Descripcion tipo orden:<br><textarea name='descripcion_tipo_orden' cols='30' rows='6' ></textarea><br>
<input type='button' value='Agregar tipo de orden' onclick=\"xajax_parametrizacion_tipo_orden(xajax.getFormValues('tipo_orden'))\">
</form>";
}
else{
mysql_query("SET NAMES 'utf8'");
$consulta = "Select orden_tipo, descripcion, estado FROM tipo_orden where id_tipo_orden = $editar_tipo_orden";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[2]=="1"){
$activo = "ACTIVO";
}
else{$activo = "INACTIVO";}
$nuevo_select = "<form name='edita_tipo_orden' id='edita_tipo_orden'>
<input type='hidden' name='id_editar_tipo_orden' value='".$editar_tipo_orden."'>
Estado:<select name='activo_tipo_orden' size='1'> 
<option value='".$row[2]."'>".$activo."</option> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
Tipo Orden:<br><input type='text' name='tipo_orden' size='32' maxlength='32' value='".$row[0]."'><br>
Descripcion tipo orden:<br><textarea name='descripcion_tipo_orden' cols='30' rows='6'>".$row[1]."</textarea><br>
<input type='button' value='Editar tipo de orden' onclick=\"xajax_parametrizacion_editar_tipo_orden(xajax.getFormValues('edita_tipo_orden'))\">
</form>";
}
$respuesta->addAssign("capatipoorden","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_orden

///NOMBRE DE LA FUNCION: select_editar_tipo_usuario
//Esta funcion es la encargada de habilitar el formulario para edicion de tipo de usuario
function select_editar_tipo_usuario($editar_tipo_usuario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if ($editar_tipo_usuario == ""){}
elseif ($editar_tipo_usuario == 0){
$nuevo_select = "<form name='tipo_usuario' id='tipo_usuario'>
Tipo:<br><input type='text' name='crear_id_tipo' size='32' maxlength='32' onchange='xajax_comprobar_tipo_usuario(this.value)'><br>
<div id='capacompruebatipousuario' name='capacompruebatipousuario'></div>
Nombre tipo usuario:<br><input type='text' name='nombre_tipo_usuario' size='32' maxlength='32' ><br>
Descripcion tipo usuario:<br><textarea name='descripcion_usuario' cols='30' rows='6' ></textarea><br>
Activo:<select name='activo_usuario' size='1'> 
<option value='1'>ACTIVO</option> 
<option value='0'>INACTIVO</option>
</select><br>
<input type='button' value='Agregar tipo de Usuario' onclick=\"xajax_parametrizacion_tipo_usuario(xajax.getFormValues('tipo_usuario'))\">
</form>";
}
else{
$consulta = "Select tipo_usuario, tipo_descripcion, activo FROM tipo_usuarios where id_tipo_usuario = $editar_tipo_usuario";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
if ($row[2]=="1"){
$activo = "ACTIVO";
}
else{$activo = "INACTIVO";}
$nuevo_select = "<form name='edita_tipo_usuario' id='edita_tipo_usuario'>
<input type='hidden' name='aux_id_tipo_usuario' value='".$editar_tipo_usuario."'>
Tipo:<br><input type='text' name='id_editar_tipo_usuario' value='".$editar_tipo_usuario."' size='32' maxlength='32' onchange='xajax_comprobar_tipo_usuario(this.value)'><br>
<div id='capacompruebatipousuario' name='capacompruebatipousuario'></div>
Nombre tipo usuario:<br><input type='text' name='nombre_editar_tipo_usuario' size='32' maxlength='32' value='".$row[0]."'><br>
Descripcion tipo usuario:<br><textarea name='descripcion_editar_tipo_usuario' cols='30' rows='6'>".$row[1]."</textarea><br>
Activo:<select name='activo_editar_tipo_usuario' size='1'> 
	        <option value='".$row[2]."'>".$activo."</option> 
		<option value='1'>ACTIVO</option>
		<option value='0'>INACTIVO</option>
		</select><br>
<input type='button' value='Editar tipo de usuario' onclick=\"xajax_parametrizacion_editar_tipo_usuario(xajax.getFormValues('edita_tipo_usuario'))\">
</form>";
}
$respuesta->addAssign("capatipousuario","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_tipo_usuario


///NOMBRE DE LA FUNCION: select_editar_grupo
//Esta funcion es la encargada de habilitar el formulario para edicion de grupo 
function select_editar_grupo($editar_grupo){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if ($editar_grupo == ""){}
elseif ($editar_grupo == 0){
$nuevo_select = "<form name='crear_grupos' id='crear_grupos'>
Nombre grupo:<br><input type='text' name='crear_nombre' id='crear_nombre' size='32' maxlength='32' ><br>
Descripcion grupo:<br><textarea name='crear_descripcion' id='crear_descripcion' cols='30' rows='6' id='crear_descripcion'></textarea><br>
 Prioridad:<select name='crear_prioridad' id='crear_prioridad'  size='1'>  
	   <option value='0'>-</option> 
		<option value='1'>1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
		<option value='4'>4</option>
		<option value='5'>5</option>
		<option value='6'>6</option>
		<option value='7'>7</option>
		<option value='8'>8</option>
		<option value='9'>9</option>
		<option value='10'>10</option>
		</select><br>
<input type='button' value='Crear grupo' onclick=\"xajax_parametrizacion_grupos(xajax.getFormValues('crear_grupos'))\">
</form>";
}else{
$consulta = "Select grupo_nombre, descripcion_grupo, prioridad FROM usuarios_grupo where id_grupo = $editar_grupo";
$result=mysql_query($consulta,$link);
$row = mysql_fetch_array($result);
$nuevo_select = "<form name='editar_grupos' id='editar_grupos'>
<input type='hidden' name='id_grupo' value='".$editar_grupo."'>
Nombre grupo:<br><input type='text' name='nombre_editar_grupo' size='32' maxlength='32' value=".$row[0]."><br>
Descripcion grupo:<br><textarea name='descripcion_editar_grupo' cols='30' rows='6'>".$row[1]."</textarea><br>
Prioridad:<select name='prioridad_editar_grupo'  size='1'> 
	        <option value='".$row[2]."'>".$row[2]."</option> 
		<option value='1'>1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
		<option value='4'>4</option>
		<option value='5'>5</option>
		<option value='6'>6</option>
		<option value='7'>7</option>
		<option value='8'>8</option>
		<option value='9'>9</option>
		<option value='10'>10</option>
		</select><br>
<input type='button' value='Editar grupo' onclick=\"xajax_parametrizacion_editar_grupo(xajax.getFormValues('editar_grupos'))\">
</form>";
}
$respuesta->addAssign("capagrupos","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin select_editar_grupo

///NOMBRE DE LA FUNCION: parametrizacion_ayuda_clase
//Esta funcion es la encargada de crear ayudas clases
function parametrizacion_ayuda_clase($ayuda_clase){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$nombre_ayuda = $ayuda_clase["nombre_ayuda_clase"];
$forma_ayuda = $ayuda_clase["forma_ayuda_clase"];
$activo_ayuda = $ayuda_clase["activo_ayuda_clase"];
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("INSERT INTO ayuda_clases(`id_ayuda_clase`, `ayuda_clase`, `ayuda_forma`, `activo`) VALUES (NULL,'$nombre_ayuda','$forma_ayuda','$activo_ayuda')",$link);
$nuevo_select = "<h3>Ayuda de clases creado satisfactoriamente</h3>";
$respuesta->addAssign("capaayudaclase","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin parametrizacion_ayuda_clase


///NOMBRE DE LA FUNCION: parametrizacion_tipo_plan_beneficio
//Esta funcion es la encargada de crear tipos de plan de beneficios
function parametrizacion_tipo_plan_beneficio($plan_beneficio){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_beneficio = $plan_beneficio["id_beneficio"];
$nombre_beneficio = $plan_beneficio["nombre_beneficio"];
$descripcion_beneficio = $plan_beneficio["descripcion_beneficio"];
$activo_beneficio = $plan_beneficio["activo_beneficio"];
$sobreescribir = $estado_civil["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `tipo_plan_beneficios` WHERE `id_tipo_plan_beneficios` = '$id_beneficio'",$link);
mysql_query("INSERT INTO tipo_plan_beneficios(`id_tipo_plan_beneficios`, `tipo_plan_beneficios`, `tipo_plan_beneficios_descripcion`, `activo`) VALUES ('$id_beneficio','$nombre_beneficio','$descripcion_beneficio','$activo_beneficio')",$link);
$nuevo_select = "<h3>Tipo de plan beneficio creado satisfactoriamente</h3>";
}
else{
$nuevo_select = "<h3>No se ha creado el plan de beneficios</h3>";
}
$respuesta->addAssign("capaplanbeneficios","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin parametrizacion_tipo_plan_beneficio

///NOMBRE DE LA FUNCION: parametrizacion_tipo_orden
//Esta funcion es la encargada de crear y editar grupos 
function parametrizacion_tipo_orden($tipo_orden){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$orden_tipo = $tipo_orden["nombre_tipo_orden"];
$descripcion_tipo_orden = $tipo_orden["descripcion_tipo_orden"];
$activo_tipo_orden = $tipo_orden["activo_tipo_orden"];
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("INSERT INTO tipo_orden(`id_tipo_orden`, `orden_tipo`, `descripcion`, `estado`) VALUES (NULL,'$orden_tipo','$descripcion_tipo_orden','$activo_tipo_orden')",$link);
$nuevo_select = "<h3>Tipo de orden creada satisfactoriamente</h3>";
$respuesta->addAssign("capatipoorden","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin parametrizacion_tipo_orden

///NOMBRE DE LA FUNCION: parametrizacion_estado_civil
//Esta funcion es la encargada de crear y editar grupos 
function parametrizacion_estado_civil($estado_civil){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_estado = $estado_civil["id_estado_civil"];
$estado = $estado_civil["estado_civil"];
$sobreescribir = $estado_civil["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `estado_civil` WHERE `id_estado_civil` = '$id_estado'",$link);
mysql_query("INSERT INTO estado_civil(`id_estado_civil`, `estado_civil`) VALUES ('$id_estado','$estado')",$link);
$nuevo_select = "<h3>Estado civil creado correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se ha creado el estado civil</h3>";
}
$respuesta->addAssign("capaestadocivil","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin parametrizacion_estado_civil

///NOMBRE DE LA FUNCION: parametrizacion_tipo_documento_id
//Esta funcion es la encargada de crear el tipo documento de identificacion
function parametrizacion_tipo_documento_id($tipo_documento_id){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_documento_id = $tipo_documento_id["id_tipo_documento_id"];
$documento_id = $tipo_documento_id["tipo_documento_id"];
$sobreescribir = $tipo_documento_id["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `documento_tipo` WHERE `id_documento_tipo` = '$id_documento_id'",$link);
mysql_query("INSERT INTO documento_tipo(`id_documento_tipo`, `documento_tipo`) VALUES ($id_documento_id,'$documento_id')",$link);
$nuevo_select = "<h3>Tipo de documento de identificaci&oacute;n creado correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se ha creado el tipo de documento de identificacion</h3>";
}
$respuesta->addAssign("capadocumentotipo","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin parametrizacion_tipo_documento_id

///NOMBRE DE LA FUNCION: parametrizacion_escolaridad
//Esta funcion es la encargada de crear tipos de escolaridad
function parametrizacion_escolaridad($escolaridad){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_crear_escolaridad = $escolaridad["id_crear_escolaridad"];
$nombre_escolaridad = $escolaridad["escolaridad"];
$sobreescribir = $escolaridad["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `escolaridad` WHERE `id_escolaridad` = '$id_crear_escolaridad'",$link);
mysql_query("INSERT INTO escolaridad(`id_escolaridad`, `escolaridad`) VALUES ('$id_crear_escolaridad','$nombre_escolaridad')",$link);
$nuevo_select = "<h3>Escolaridad creada correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se ha creado escolaridad</h3>";
}
$respuesta->addAssign("capaescolaridad","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin parametrizacion_escolaridad


///NOMBRE DE LA FUNCION: parametrizacion_tipo_usuario
//Esta funcion es la encargada de crear tipos de usuario
function parametrizacion_tipo_usuario($tipo_usuario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$id_tipo_usuario = $tipo_usuario["crear_id_tipo"];
$nombre_tipo_usuario = $tipo_usuario["nombre_tipo_usuario"];
$descripcion_tipo_usuario = $tipo_usuario["descripcion_usuario"];
$activo_tipo_usuario = $tipo_usuario["activo_usuario"];
$sobreescribir = $tipo_usuario["sobreescribir"];
if ($sobreescribir == "1"){
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("DELETE from `tipo_usuarios` WHERE `id_tipo_usuario` = '$id_tipo_usuario'",$link);
mysql_query("INSERT INTO tipo_usuarios (`id_tipo_usuario`, `tipo_usuario`, `tipo_descripcion`, `activo`) VALUES ('$id_tipo_usuario','$nombre_tipo_usuario', '$descripcion_tipo_usuario', '$activo_tipo_usuario')",$link);
$nuevo_select = "<h3>Tipo de usuario creado correctamente</h3>";
}
else{
$nuevo_select = "<h3>No se ha creado el tipo de usuario</h3>";
}
$respuesta->addAssign("capatipousuario","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin parametrizacion_tipo_usuario

///NOMBRE DE LA FUNCION: grupos
//Esta funcion es la encargada de crear grupos

function parametrizacion_grupos($crear_grupos){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$nombre_grupo = $crear_grupos["crear_nombre"];
$descripcion_grupo = $crear_grupos["crear_descripcion"];
$prioridad_grupo = $crear_grupos["crear_prioridad"];
include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
mysql_query("INSERT into usuarios_grupo(`id_grupo`, `grupo_nombre`, `descripcion_grupo`, `prioridad`) VALUES (NULL, '$nombre_grupo', '$descripcion_grupo', '$prioridad_grupo')",$link);
$nuevo_select = "<h3>Grupo creado correctamente</h3>";
$respuesta->addAssign("capagrupos","innerHTML",$nuevo_select);
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