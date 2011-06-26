<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: error.php");
// echo "hola 2";
} 

include_once("entidades/funciones/funciones.php");
include_once("usuarios/funciones/funciones.php");
include_once("albergues/funciones/funciones.php");
include_once("publicacion/funciones/publicacion.php");
//registramos la función creada anteriormente al objeto xajax
//include_once("contabilidad/funciones/contabilidad.php");
include_once("includes/obtener_ip.php");
/*include_once("personal/funciones/personal.php");
include_once("lab/funciones/lab.php");
include_once("quimioterapia/funciones/quimioterapia.php");

include_once("contabilidad/funciones/contabilidad.php");
include_once("contabilidad/funciones/contabilidad_experimental.php");
/// funciones autorizaciones
include_once("i/funciones/i.php");

/// funciones autorizaciones
include_once("i/funciones/i.php");
*/
$xajax->registerFunction("validar_numerico");
$xajax->registerFunction("combo_select");

/// funcion para aceptar la licencia

$xajax->registerFunction("acepto_licencia");
$xajax->registerFunction("enviar_invitacion");
$xajax->registerFunction("comprobar_email");
// funciones suscriptores
include_once("suscriptores/funciones/suscriptores.php");
$xajax->registerFunction("crear_editar_suscriptores");
$xajax->registerFunction("suscriptores_formulario");
$xajax->registerFunction("usuarios_listado_alfabetico");

// funciones parametrizacion
include_once("empresa/funciones/empresa.php"); 
$xajax->registerFunction("modificar_empresa");

// funciones parametrizacion
include_once("parametrizacion/funciones/parametrizacion.php"); 
$xajax->registerFunction("parametrizacion_grupos");

$xajax->registerFunction("parametrizacion_tipo_usuario");
$xajax->registerFunction("parametrizacion_escolaridad");

$xajax->registerFunction("parametrizacion_estado_civil");
$xajax->registerFunction("parametrizacion_tipo_documento_id");
$xajax->registerFunction("parametrizacion_tipo_orden");
$xajax->registerFunction("parametrizacion_tipo_plan_beneficio");
$xajax->registerFunction("parametrizacion_ayuda_clase");
$xajax->registerFunction("select_editar_grupo");
$xajax->registerFunction("select_editar_tipo_usuario");
$xajax->registerFunction("select_editar_tipo_documento_id");
$xajax->registerFunction("select_editar_orden");
$xajax->registerFunction("select_editar_escolaridad");
$xajax->registerFunction("select_editar_estado_civil");
$xajax->registerFunction("select_editar_plan_beneficios");
$xajax->registerFunction("select_editar_ayuda_clases");

$xajax->registerFunction("parametrizacion_editar_grupo");
$xajax->registerFunction("parametrizacion_editar_ayuda_clases");

$xajax->registerFunction("parametrizacion_editar_tipo_orden");
$xajax->registerFunction("parametrizacion_editar_tipo_usuario");
$xajax->registerFunction("parametrizacion_editar_escolaridad");
$xajax->registerFunction("parametrizacion_editar_tipo_documento");
$xajax->registerFunction("parametrizacion_editar_estado_civil");
$xajax->registerFunction("parametrizacion_editar_tipo_plan_beneficios");
$xajax->registerFunction("comprobar_tipo_usuario");
$xajax->registerFunction("comprobar_escolaridad");
$xajax->registerFunction("comprobar_tipo_documento_id");
$xajax->registerFunction("comprobar_estado_civil");
$xajax->registerFunction("comprobar_tipo_plan_beneficios");

$xajax->registerFunction("dummy");
$xajax->registerFunction("sugiere_generico");
// funciones para el manejo de eventos
/*include_once("eventos/funciones/eventos.php");
$xajax->registerFunction("revisar_evento");
$xajax->registerFunction("procesar_formulario");
$xajax->registerFunction("revisar_documento");
$xajax->registerFunction("revisar_email");
$xajax->registerFunction("revisar_telefono");
$xajax->registerFunction("generar_select");
$xajax->registerFunction("municipios");
$xajax->registerFunction("ciudades");
$xajax->registerFunction("servicio_cliente");
$xajax->registerFunction("usuario_datos");
// funciones para el manejo de terceros 
include_once("terceros/funciones/terceros.php"); 
$xajax->registerFunction("terceros");
$xajax->registerFunction("terceros_modificar");
// funciones el manejo de turnos y agenda
include_once("turnos/funciones/turnos.php");
$xajax->registerFunction("turnos_procesar");
$xajax->registerFunction("turnos_grabar");
$xajax->registerFunction("dar_cita");
$xajax->registerFunction("autorizar_consulta");
// funciones para el manejo de consultas
include_once("consulta/funciones/consulta.php");
$xajax->registerFunction("formulario_consulta_procesar");
$xajax->registerFunction("crear_campos_consulta");
$xajax->registerFunction("grabar_consulta");
$xajax->registerFunction("grabar_receta");
$xajax->registerFunction("revisar_medicamentos");
$xajax->registerFunction("revisar_orden");
$xajax->registerFunction("grabar_orden");
$xajax->registerFunction("plan");

$xajax->registerFunction("reload_consulta");
// funciones para diagnosticos relacionados
include_once("consulta/cie_10/orden_cie.php"); 
$xajax->registerFunction("nombre_campo_cie10");

$xajax->registerFunction("grabar_ayudas");
$xajax->registerFunction("superficie_corporal");
$xajax->registerFunction("ayudas_diagnosticas");
$xajax->registerFunction("revisar_ayudas_diagnosticas");
$xajax->registerFunction("campos_consulta_dinamico");
$xajax->registerFunction("resumen_consulta");
// funciones para facturacion
include_once("facturacion/funciones/facturacion.php"); 
$xajax->registerFunction("facturas_listado");
$xajax->registerFunction("factura_buscar");
$xajax->registerFunction("factura_agregar");
$xajax->registerFunction("factura_modificar");
$xajax->registerFunction("factura_encabezado_grabar");
$xajax->registerFunction("factura_encabezado_modificar");
$xajax->registerFunction("factura_encabezado_formulario");
$xajax->registerFunction("factura_nuevo_producto");
//varias
*/
$xajax->registerFunction("ping");
$xajax->registerFunction("envio_documentos");
$xajax->registerFunction("wait");
$xajax->registerFunction("links");

//$xajax->registerFunction("cambiar_numero_letras");
$xajax->processRequests();
//include_once('numeros_letras.php');


///NOMBRE DE LA FUNCION: dummy
// para llamar la funcion utilizar 
// onChange="xajax_dummy(xajax.getFormValues('nombre_formulario'))"

////sucursales
function dummy($variable_array,$capa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$Valor = $variable_array["id_evento"];


//include_once("librerias/conex.php"); 
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");
//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);

$nuevo_select = "<h1>Hola mundo! $Valor , $variable_array</h1>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$nuevo_select .= "".$row['id']."".$row['nombre_completo']."<br>";
//															}
//										}
$nuevo_select .= "<h1>Los dummys</h1>";
$respuesta->addAssign($capa,"innerHTML",$nuevo_select);
return $respuesta;
} 


function categorias($tipo,$tabla_1,$tabla_2,$id,$nombre,$descripcion,$titulo){

if($tipo =='hijo') {
	$consulta = "SELECT $tabla_1.id AS id, $tabla_1.nombre as nombre, $tabla_1.descripcion as descripcion , $tabla_1.* 
FROM $tabla_1, $tabla_2 
WHERE  $tabla_1.clase = $tabla_2.id AND $tabla_2.id = '$id' AND $tabla_1.activo = '1' ORDER BY $tabla_1.orden ASC ";
//return $consulta ;
					}	
	else{
	$consulta ="SELECT $id AS id, $nombre as nombre, $descripcion as descripcion FROM $tabla_1 ORDER BY orden ASC ";
}
	$link=Conectarse(); 
	$sql=mysql_query($consulta,$link);



if (mysql_num_rows($sql)!='0'){
	$resultado .= "";
while( $row = mysql_fetch_array( $sql ) ) {
	if($row[descripcion] =='') {$descripcion_categoria = "$titulo $row[nombre]";} else {$descripcion_categoria = "$titulo $row[descripcion]";}
	if($tipo =='') {
			$campos = categorias('hijo',$tabla_2,$tabla_1,$row[id],$nombre,$descripcion,$titulo);
$resultado .= "<fieldset ><legend>$row[nombre] (<b title='$descripcion_categoria'>?</b>) </legend>
$campos 
</fieldset>";

						}else {
							if($row['tipo'] =="#"){$type = "number"; $size="size='5'";
									$input="<input title='Cantidad $row[tipo] / $type' type='$type' name='caracteristicas[$row[id]]' id='caracteristicas[$row[id]]' $size placeholder='$row[nombre]'> $row[nombre]";							
								}
							elseif($row['tipo'] =="text"){$type = "text"; $size="";
									$input="<input title='$row[tipo] / $type' type='$type' name='caracteristicas[$row[id]]' id='caracteristicas[$row[id]]' $size placeholder='$row[nombre]'> $row[nombre]";							
							}
							else{
								$input ="<select  name='caracteristicas[$row[id]]' id='caracteristicas[$row[id]]' title='$row[tipo]'> ";
								$input .="<option value=''>$row[nombre]</option> "; 
								$vector = explode( ",", $row[tipo]); 
								foreach( $vector as $linea ){
								$input .="<option value='$linea'>$linea</option> "; 
								$lista_campos .=" $linea |" ;
																		}
								$input .="</select>";
									}
								
$resultado .= "<label title='$descripcion_categoria'>
						 $input 
					</label>";							
							
							}


															}

										}
									
										return $resultado;

	}
	

function opciones($tipo,$tabla,$id,$nombre,$descripcion,$titulo){
	$consulta ="SELECT $id AS id, $nombre as nombre, $descripcion as descripcion FROM $tabla ";

	$link=Conectarse(); 
	$sql=mysql_query($consulta,$link);



if (mysql_num_rows($sql)!='0'){
	$resultado .= "<fieldset><legend>Financiación</legend>";
while( $row = mysql_fetch_array( $sql ) ) {

	if($row[descripcion] =='') {$descripcion = "$titulo $row[nombre]";} else {$descripcion = "$titulo $row[descripcion]";}
$resultado .= "<label> <input type='checkbox' name='".$tabla."[]' id='".$tabla."[]' value='$row[id]'  />$row[nombre]</label>";
															}
$resultado .= "</fieldset>";
										}
									
										return $resultado;

	}
	
function campos_iguales($campo_1,$campo_2,$div){
$respuesta = new xajaxResponse('utf-8');
if ($campo_1 != $campo_2)
{ $resultado = "<img src='images/atencion.gif' title='Los campos no coinciden' alt='[!]'>";}
else{$resultado = "<img src='images/check.gif' title='Los campos no coinciden' alt='[!]'>";}
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;
}
$xajax->registerFunction("campos_iguales");

function limpiar_caracteres($valor){
$b=array("<",">","(",")"," POR "," DE ",".","+","{","}","]","/","-","[",";",":","¡","!","¿","?","'",'"');
$c=array(" "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," ");
$resultado=str_replace($b,$c,$valor);
return $resultado ;
}

function quitar_caracteres($valor){
$b=array("<",">","(",")"," POR "," DE ",".","+","{","}","]","/","-","[",";",":","¡","!","¿","?","'",'"');
$c=array("","","","","","","","","","","","","","","","","","","","","","");
$resultado=str_replace($b,$c,$valor);
return $resultado ;
}

function remplacetas($tabla,$campo,$valor,$por){

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT $por FROM $tabla 
						WHERE $campo = '$valor'";
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$resultado=mysql_result($sql,0,$por);
										}else{$resultado ="$valor";}
return $resultado;
} 

function remplacetas_oncolinux($tabla,$campo,$valor,$por){
//include("librerias/oncolinux.php");
$link_oncolinux=oncolinux(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT $por FROM $tabla 
						WHERE $campo = '$valor'";
 $sql=mysql_query($consulta,$link_oncolinux);
if (mysql_num_rows($sql)!='0'){
$resultado=mysql_result($sql,0,$por);
										}else{$resultado ="$valor";}

//$resultado .= $consulta;
return $resultado;
} 

function verificar_campo($valor,$campo,$tabla,$div){
//creo el xajaxResponse para generar una salida
$id_empresa= $_SESSION['id_empresa'];
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta="SELECT $campo FROM $tabla WHERE $campo = '$valor' AND id_empresa='$id_empresa'LIMIT 0,10";
$sql =mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$verificacion = "atencion"; $existe='SI';
$campo = "nit[general]";
$respuesta->addAssign($campo,"value","");
$respuesta->addAlert("El valor $valor $existe existe");
$resultado = "<img src='images/$verificacion.gif' title='El valor $valor $existe existe'>";
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;
										}else {$verificacion ="check";  $existe='NO';}
$resultado = "<img src='images/$verificacion.gif' title='El valor $valor $existe existe'>";
$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
} 
$xajax->registerFunction("verificar_campo");



function validar_numerico($div,$valor,$campo,$tipo){
$respuesta = new xajaxResponse('utf-8');
if($tipo =='n'){
if(is_numeric($valor) == TRUE){$resultado = "<img src='images/check.gif' title='Ok'>";}
				
													else{

$resultado = "<img src='images/atencion.gif' title='ERROR'>";
$respuesta->addAlert("El valor $valor no es numerico");
$respuesta->addAssign($campo,"value","");
													}}/// fin de numerico
if($tipo =='f'){

$year = substr($valor, 0, 4);
$mes = substr($valor, 4, 2);
$dia = substr($valor, 6, 2);
$fecha="$year/$mes/$dia";

if(is_numeric($valor) == TRUE AND checkdate($mes,$dia,$year)){ $timestamp=fecha_timestamp($valor);$resultado = "<img src='images/check.gif' title='Ok $timestamp'>  ";}
										
		else{

$resultado = "<img src='images/atencion.gif' title='ERROR'>";
$respuesta->addAlert("El valor $valor no es una fecha  valida");
$respuesta->addAssign($campo,"value","");
												
											
												
													
													}	}/// fin fecha
//$respuesta->addAssign($campo,"value",$resultado);	
												
 
$respuesta->addAssign($div,"innerHTML",$resultado);


return $respuesta;
} 
 function fecha_timestamp($fecha){
$year = substr($fecha, 0, 4);
$mes = substr($fecha, 4, 2);
$dia = substr($fecha, 6, 2);
$fecha="$year/$mes/$dia"; 
$timestamp=mktime(0,0,0,"$mes","$dia","$year");
return $timestamp;
 }


function select($tabla,$value,$descripcion,$onchange,$where){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$id_empresa= $_SESSION['id_empresa'];
if($where != ''){$w = "AND ".$where;}else{ $w="";}
$consulta = "SELECT $value, $descripcion FROM $tabla WHERE id_empresa ='$id_empresa' $w ";
$sql=mysql_query($consulta,$link);
$name=$tabla."_".$value;
if (mysql_num_rows($sql)!='0'){
$resultado="<SELECT NAME='$name' id='$name' onchange=\"$onchange\">
				<option value=''>Seleccione $descripcion</option>
				<option value=''> >> Nuevo $descripcion << </option>" ;
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "<option value='$row[$value]'>$row[$descripcion]</option>";
															}
$resultado .= "</select>";
										}else{$resultado = "<font color='red'>SELECT VACIO</font>";}
//$resultado .= "$consulta,$tabla,$value,$descripcion,$onchange,$where";
return $resultado;
}


function combo_select($id,$tabla,$campo_valor,$campo_descripcion,$tipo){
/*
combo_select('id','contabilidad_retefuente_tabla','rubro','concepto','');
$id campo que se espera que retorne el select hijo
$tabla a consultar
$campo_valor campo clave value del primer select
$campo_descripcion descripcion en el primer select
$tipo debe estar vacio al invocar la funcion
*/
if($tabla=="places") {$empresa ="";}
else {
	$id_empresa= $_SESSION['id_empresa'];	
	$empresa = " AND id_empresa = '$id_empresa'";}

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$Campo_descripcion = ucwords($campo_descripcion);
$Campo_valor = ucwords($campo_valor);
$nombre=$tabla."_".$campo_valor;
$div=$nombre."_hijo";
$combo = $id."_".$tabla;
if($tipo!=''){
$respuesta = new xajaxResponse('utf-8');
$consulta ="SELECT $id,$campo_valor, $campo_descripcion FROM $tabla WHERE $campo_valor = '$tipo' $empresa GROUP BY $campo_descripcion";
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$resultado .= "<label>$Campo_descripcion <select id='$combo' name='$combo'>";
$resultado .= "<option value=''> Seleccione $Campo_descripcion</option>";
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "<option value='$row[$id]'> $row[$campo_valor] $row[$campo_descripcion]</option>";
															}
$resultado .= "/<select></label>";
										}
										


$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;}
ELSE{ /// si no especifica $tipo
$consulta ="SELECT $id,$campo_valor, $campo_descripcion FROM $tabla WHERE 1 $empresa GROUP BY $campo_valor ";
$sql=mysql_query($consulta,$link);
///$Documento=mysql_result($grupo,0,"documento_numero");
$resultado = "<label>$Campo_valor <select name='combo$nombre' id='combo$nombre'
					onchange=\"xajax_combo_select('$id','$tabla','$campo_valor','$campo_descripcion',(this.value)) \";>";
					$resultado .= "<option value=''> Seleccione $Campo_valor</option>";
if (mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "<option value='$row[$campo_valor]' >$row[$campo_valor]</option>";
															}
										}
$resultado .= "</select></label><div name='$div' id='$div'><!-- <input type='text' id='$combo' name='$combo'> --></div>";
				}/// FIN de $tipo no especifico

return $resultado;
} 


function saber_edad($edad){
/*list($anio,$mes,$dia) = explode("-",$edad);
$anio_dif = date("Y") - $anio;
$mes_dif = date("m") - $mes;
$dia_dif = date("d") - $dia;
if ($dia_dif < 0 || $mes_dif < 0){$anio_dif--;}
$edad_completa ="$anio_dif Años $mes_dif Meses $dia_dif Dias";
//return $anio_dif ;
*/ 
$fecha_actual = date ("Y-m-d"); 
$fecha_de_nacimiento = $edad;


// separamos en partes las fechas
$array_nacimiento = explode ( "-", $fecha_de_nacimiento );
$array_actual = explode ( "-", $fecha_actual );

$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años
$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días

//ajuste de posible negativo en $días
if ($dias < 0)
{
    --$meses;

    //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
    switch ($array_actual[1]) {
           case 1:     $dias_mes_anterior=31; break;
           case 2:     $dias_mes_anterior=31; break;
           case 3: 
                if (bisiesto($array_actual[0]))
                {
                    $dias_mes_anterior=29; break;
                } else {
                    $dias_mes_anterior=28; break;
                }
           case 4:     $dias_mes_anterior=31; break;
           case 5:     $dias_mes_anterior=30; break;
           case 6:     $dias_mes_anterior=31; break;
           case 7:     $dias_mes_anterior=30; break;
           case 8:     $dias_mes_anterior=31; break;
           case 9:     $dias_mes_anterior=31; break;
           case 10:     $dias_mes_anterior=30; break;
           case 11:     $dias_mes_anterior=31; break;
           case 12:     $dias_mes_anterior=30; break;
    }

    $dias=$dias + $dias_mes_anterior;
}

//ajuste de posible negativo en $meses
if ($meses < 0)
{
    --$anos;
    $meses=$meses + 12;
}

$edad_completa =  "$anos años con $meses meses y $dias días";

return $edad_completa;
}

function bisiesto($anio_actual){
    $bisiesto=false;
    //probamos si el mes de febrero del año actual tiene 29 días
      if (checkdate(2,29,$anio_actual))
      {
        $bisiesto=true;
    }
    return $bisiesto;
} 
///$xajax->registerFunction("dummy");
function g_nombre_ciudad($cod_departamento,$cod_municipio){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$nombre_localidad=mysql_query("SELECT nombre_departamento, nombre_municipio FROM geo_municipios_colombia WHERE codigo_departamento like '$cod_departamento' AND codigo_municipio like '$cod_municipio'",$link);
if (mysql_num_rows($nombre_localidad)!='0'){
$nombre_municipio = mysql_result($nombre_localidad,0,"nombre_municipio");
} else{$nombre_municipio="[$cod_departamento][$cod_municipio]";}
return $nombre_municipio;
		}
function g_nombre_departamento($cod_departamento,$cod_municipio){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$nombre_localidad=mysql_query("SELECT nombre_departamento, nombre_municipio FROM geo_municipios_colombia WHERE codigo_departamento like '$cod_departamento' AND codigo_municipio like '$cod_municipio'",$link);
if (mysql_num_rows($nombre_localidad)!='0'){
$nombre_departamento = mysql_result($nombre_localidad,0,"nombre_departamento");
} else{$nombre_departamento="[$cod_departamento][$cod_municipio]";}
return $nombre_departamento;
		}

//suggestivo('33','d9_users','id','nombre_completo');
function suggestivo($item,$tabla,$campo,$campo_descripcion,$oculto,$titulo){
if($oculto =='1'){$tipo='hidden';}else{$tipo='text';}
$campos_formulario .="<label>$titulo <input type='text' id='buscar$item' name='buscar$item' placeholder='$titulo' title='$titulo' value='' size='30'
 								onkeyup=\"if(revisa('buscar$item')=='si'){numeros(event,'$item','generico','$tabla','$campo','$campo_descripcion'); }
                else{limpia($item)}\"  onClick=\"this.value='' \" title='$titulo Digite al menos CUATRO	caracteres y pulse BUSCAR'/></label>
                <input READONLY type='$tipo' id='$item' name='$item' value='' size='5'
 								  \"/><!-- <input type='button' value='BUSCAR'> -->
                

                <div id='contenedor$item' onmouseover='sobre()' style='    
                position:relative;
text-align:justify;
height:200px;
background-color: white;
z-index:1002;
overflow: auto;
overflow-x:hidden;
font-size: 8pt;
font-family: Arial, Helvetica, sans-serif;
<!-- width:150px -->;height:200px;  display:inline' ></div>
                ";
                
return $campos_formulario;
                }
                
                
 function sugiere_generico($valor,$item,$tabla,$campo,$campo_descripcion) {
    $respuesta = new xajaxResponse('ISO-8859-1');
 if(strlen($valor) > '0'){
 $link=Conectarse(); 
//$tabla="cie_10";
if($tabla == 'd9_users'){$and ="OR documento_numero  LIKE '%%$valor%%'"; $campo_extra =', documento_numero AS campo_extra';

if($campo_descripcion == 'documento_numero'){$campo_extra =', nombre_completo AS campo_extra';}
$nombre_competo= 'nombre_completo';

if(is_numeric($valor) == TRUE AND $campo_descripcion != 'documento_numero'){$mensaje .="SOLO SE PERMITEN LETRAS";
  $mensaje .= "<li title ='LIMPIAR BUSQUEDA' onclick=\"document.getElementById('buscar$item').value='' ;document.getElementById('$item').value='' ;
 document.getElementById('contenedor$item').style.display='none'\"' class='cursor' id='li$row[campo]' ><b>Limpiar Busqueda [<font color='red'>X</font>]</b> 


 </li>";
$pinta ="<font color='red'> <b>NO HAY RESULTADOS</b> </font>$mensaje";
           $respuesta->addAssign("contenedor$item", "innerHTML", "<ul  id='lista$item'>$pinta</ul>");
            $respuesta->addAssign("contenedor$item","style.display","block");
            return $respuesta;
													}else {$mensaje .="";}

}

if($tabla == "entidades"){$and ="OR p_apellido  LIKE '%%$valor%%' OR p_nombre  LIKE '%%$valor%%'  OR s_nombre  LIKE '%%$valor%%'  OR s_apellido  LIKE '%%$valor%%'  OR alias  LIKE '%%$valor%%'   OR nit  LIKE '%%$valor%%'"; $campo_extra =", concat(nit ,' ', p_nombre ,' ', s_nombre ,' ', p_apellido  )  AS campo_extra"; }


mysql_query("SET NAMES 'utf8'");
                $sql = "SELECT $campo AS campo  ,$campo_descripcion AS campo_descripcion $campo_extra FROM $tabla 
                WHERE  $campo_descripcion LIKE '%%$valor%%' $and
                ORDER BY $campo_descripcion LIMIT 100";
$query =mysql_query($sql,$link);
 //           $query = pg_query($sql);
            if(mysql_num_rows($query)==0)
            {
            $pinta .="<font color='red'>$mensaje <b>NO HAY RESULTADOS</b> </font>";
             $mensaje .= "<li title ='LIMPIAR BUSQUEDA' onclick=\"document.getElementById('buscar$item').value='' ;document.getElementById('$item').value='' ;
 document.getElementById('contenedor$item').style.display='none'\"' class='cursor' id='li$row[campo]' ><b>Limpiar Busqueda [<font color='red'>X</font>]</b> 


 </li>";
           $respuesta->addAssign("contenedor$item", "innerHTML", "<ul  id='lista$item'>$mensaje $pinta</ul>");
            $respuesta->addAssign("contenedor$item","style.display","block");
            }
            else{
            while( $row = mysql_fetch_array( $query ) ) {
           $resultado =  "$row[campo_descripcion] $row[campo_extra]";
   						$p  = stripos($resultado, $valor);
                    $s1 = substr($resultado, 0, $p);
                    $s2 = substr($resultado, $p, strlen($valor));
                    $s3 = substr($resultado, ($p + strlen($valor)));
                    /* 	$p  = stripos($row[campo_descripcion], $valor);
                    $s1 = substr($row[campo_descripcion], 0, $p);
                    $s2 = substr($row[campo_descripcion], $p, strlen($valor));
                    $s3 = substr($row[campo_descripcion], ($p + strlen($valor))); */
 
                    $r = $s1."<font color='red'>$s2</font>".$s3;
 
              //      $pinta .= "	<li onclick=\"rc_autocompleter_click('edtAutocompleter', '$row[descripcion]', 'completer_preview');\">$r";
if($tabla == "users"){
 $pinta .= "<li title ='OPRIMA PARA SELECCIONAR' onclick=\"window.location='adentro.php?page=suscriptores&usuario=$row[campo]';
 document.getElementById('contenedor$item').style.display='none'\"' class='cursor' id='li$row[campo]' ><!-- <b>$row[campo_extra]</b>  -->
 $r [$row[campo]]

 </li>";
 						}else{
$pinta .= "<li title ='OPRIMA PARA SELECCIONAR' onclick=\"document.getElementById('buscar$item').value='$resultado' ;document.getElementById('$item').value='$row[campo]' ;
 document.getElementById('contenedor$item').style.display='none'\"' class='cursor' id='li$row[campo]' ><!-- <b>$row[campo_extra]</b> --> 
 $r [$row[campo]]

 </li>";

 }
															}
 $mensaje .= "<li title ='LIMPIAR BUSQUEDA' onclick=\"document.getElementById('buscar$item').value='' ;document.getElementById('$item').value='' ;
 document.getElementById('contenedor$item').style.display='none'\"' class='cursor' id='li$row[campo]' ><b>Limpiar Busqueda [<font color='red'>X</font>]</b> 


 </li>";
 														
  
            $respuesta->addAssign("contenedor$item", "innerHTML", "<ul  id='lista$item'>$mensaje $pinta</ul>");
            $respuesta->addAssign("contenedor$item","style.display","block");
            }
          //  $respuesta->addScript("contenedor.scrollTop=0");
          }else{
          //$pinta.= "ESTO $item //";
            //       $respuesta->addAssign("contenedor", "innerHTML", "<ul  id='lista'>$pinta</ul>");
           // $respuesta->addAssign("contenedor","style.display","block");
          }
          
            return $respuesta;

    }

    
       
function links($accion,$capa,$item){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
//include_once("librerias/conex.php"); 
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");

if ($accion=='mostrar'){
if($_SESSION['grupo']=='1'){
									$nuevo ="<hr><div align=''><a onclick=\"xajax_wait('capa_links');xajax_links('editar','capa_links','')\"><font size='-2' color='red'>Nuevo Link [<font color='red'>+</font>]  </font></a></div>";
									}else{$nuevo="";}
												
$sql=mysql_query("SELECT * FROM links WHERE id_empresa = '$_SESSION[id_empresa]'  ORDER BY link_titulo ASC",$link);
///$Documento=mysql_result($grupo,0,"documento_numero");


if (mysql_num_rows($sql)!='0'){
$mis_links .= "<table cellpadding='0' cellspacing='0' border='0' width='120'>";
while( $row = mysql_fetch_array( $sql ) ) {
if($_SESSION['grupo']=='1'){$permiso="<a onclick=\"xajax_wait('capa_links');xajax_links('editar','capa_links','$row[id_link]')\">
												<img src='images/editar.gif' border='0' alt='[E]' title='Editar links externos'></a>";
												}else{$permiso="";}
if($row[activo]=='1'){$activo= "a href='$row[link_url]'";}else{$activo= 'b';}

//if ($icono = @fopen("$row[link_url]/favicon.ico","r"))  {$icono="$row[link_url]/favicon.ico"; }else{$icono="http://galenux.com/favicon.gif"; }
$mis_links .= "<tr >
										<td height='22px'>
											 &nbsp; <!-- <img src='$icono' width='20' height='20' border='0' alt='[O]'> -->
										</td>
										<td valign='middle' height='22px' >
										$permiso 
											<$activo title='$row[link_descripcion]' class='cursor' target='$row[link_tipo]'>
												<font size='-2' > $row[link_titulo]</font>
											</a>
										</td>
									</tr>";
															}
$mis_links .= "</table>
$nuevo
<div align=''><hr><a onclick=\"xajax_wait('capa_links');xajax_links('ocultar','capa_links','')\"><font size='-2'> <font size='-2'>[<font color='red'>-</font>] Ocultar</font></a></div>
";
//echo $mis_links;
									} ///fin de resultados
								}/// fin mostrar
elseif($accion=='editar'){
$sql=mysql_query("SELECT * FROM links WHERE id_empresa = '$_SESSION[id_empresa]' AND id_link ='$item' ",$link);
if (mysql_num_rows($sql)!='0'){ /// si el item existe se edita
$link_titulo=mysql_result($sql,0,"link_titulo");
$id_link=mysql_result($sql,0,"id_link");
$activo=mysql_result($sql,0,"activo");
if($activo=='1'){$link_activo ="Activo <input type='radio' name='activo' value='1' checked> inactivo<input type='radio' name='activo' value='0' >";}
else{$link_activo ="Activo <input type='radio' name='activo' value='1' > Inactivo<input type='radio' name='activo' value='0' checked>";}
$link_url=mysql_result($sql,0,"link_url");
$link_descripcion=mysql_result($sql,0,"link_descripcion");
$activo=mysql_result($sql,0,"activo");
										}else
										{/// si no existe se crea nuevo
										
										}
$mis_links .= "<form id='editar_link' name='editar_link'>
					<input type='hidden' value='$id_link' id='id_link'  name='id_link' >
					<input type='text' value='$link_titulo' id='link_titulo'  name='link_titulo' size='20' title='TITULO DEL ENLACE'>
					<br><input type='text' value='$link_url' id='link_url'  name='link_url' size='20' title='DIRECCION DEL ENLACE incluir \"http:// \"'>
					<br><textarea id='link_descripcion'  name='link_descripcion' cols='12' rows='3'>$link_descripcion</textarea>
					$link_activo
					<br><input type='button' value='Grabar' OnClick=\"xajax_wait('capa_links');xajax_links('grabar','capa_links',xajax.getFormValues('editar_link'))  \">	
					<input type='button' value='cancelar' OnClick=\"xajax_wait('capa_links');xajax_links('mostrar','capa_links','')  \">				
					
					</form>";
											

									}
elseif($accion=='grabar'){
$id_link = $item["id_link"];
$link_titulo = $item["link_titulo"];
$link_url = $item["link_url"];
$link_descripcion = $item["link_descripcion"];
$activo = $item["activo"];
$timestamp = time();
$control = $timestamp.$id_link.$link_titulo;
$control = MD5($control);
if($link_titulo==''){$respuesta->addAlert("El titulo no puede estar vacio");  
							$respuesta->addScript("xajax_links('mostrar','$capa','')");
							return $respuesta;}
if($id_link==''){
$actualizar ="INSERT INTO  links (id_usuario,link_titulo,link_url,link_descripcion,activo,control,id_empresa,link_tipo) 
					         VALUES ('$_SESSION[id_usuario]','$link_titulo','$link_url', '$link_descripcion','$activo','$control','$_SESSION[id_empresa]','_nueva')";
					         }else{
$actualizar = "UPDATE `links` 
SET `id_usuario` = '$_SESSION[id_usuario]', 
`link_titulo` = '$link_titulo',
 `link_url` = '$link_url',
 `link_descripcion` = '$link_descripcion',
 `activo` = '$activo' 
WHERE `id_empresa` ='$_SESSION[id_empresa]' 
AND id_link ='$id_link'
 LIMIT 1 ;";			}	
 $sql=mysql_query($actualizar,$link);
 if ($sql){
 $respuesta->addScript("xajax_links('mostrar','$capa','')");
//$mis_links=$actualizar;
return $respuesta;
 				}else {$mis_links="<img src='images/alerta.gif' border='0' alt='[!]' title='Ocurrio un problema al grabar!'> Alerta!";}		
								}									
else{$mis_links .= "<div align=''><a onclick=\"xajax_wait('capa_links');xajax_links('mostrar','$capa','')\"><font size='-2'>[<font color='red'>+</font>] Links</font></a></div>";}
//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);

//$nuevo_select = "<h1>Hola mundo! $Valor , $variable_array</h1>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$nuevo_select .= "".$row['id']."".$row['nombre_completo']."<br>";
//															}
//										}
//$nuevo_select .= "<h1>Los dummys</h1>";
$respuesta->addAssign($capa,"innerHTML",$mis_links);
return $respuesta;
} 
///$xajax->registerFunction("dummy");

function wait($capa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');

$nuevo_select = "<h1><blink>Cargando .....</blink></h1>";

$respuesta->addAssign($capa,"innerHTML",$nuevo_select);
return $respuesta;
} 


/// fin sucursales

function envio_documentos($id_documento,$tabla,$referencia,$id_destino,$destino_tabla,$id_canal,$cuerpo,$capa){
include('includes/datos.php');
$debug = " SIMULACRO ";
$debug_2 = " <img src='$url_aplicacion/images/atencion.gif' ALT='SIMULACRO'> Nos encontramos en pruebas de nuestro sistema de información <a href='http://galenux.com' >http://GaleNUx.com</a> y este es un simulacro, puede seguir los pasos sugeridos para conocer el sistema o ignorar este mensaje <hr>";
$respuesta = new xajaxResponse('utf-8');
;
global $url_aplicacion, $empresa, $empresa_direccion, $empresa_sigla;
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
/*
SE DESACTIVA TEMPORALMENTE PARA TOMAR EL MAIL DIRECTO DE LA TABLA DE CLIENTES
$direccion_envio = "SELECT `direccion`,`canal_nombre`
FROM `envios_direcciones`, `envios_canal`
WHERE envios_direcciones.id_canal = '$id_canal'
AND envios_direcciones.id_canal = envios_canal.id_canal
AND envios_direcciones.id_empresa ='$_SESSION[id_empresa]'
AND envios_direcciones.id_destino = '$id_destino'
AND envios_direcciones.destino_tabla LIKE '$destino_tabla'";
$datos_destino=mysql_query($direccion_envio,$link);
if (mysql_num_rows($datos_destino)!='0'){
$direccion=mysql_result($datos_destino,0,"direccion");
$canal=mysql_result($datos_destino,0,"canal_nombre");
														}
														*/
$direccion =usuario_datos_consultar($id_destino,cliente,'email_autorizaciones');
$id_usuario=usuario_datos_consultar($id_documento,$tabla,'id_usuario');	

/////ATENCION NICIAL
if($tabla == 'atencion_inicial'){

$formato_titulo = "formato de atención inicial (anexo 2 resolución 3047 de 2008)";
$formato_url=$url_aplicacion."/i/ai.php?r=$referencia";
$formato_pin=usuario_datos_consultar($id_documento,$tabla,'pin');														

$asunto =" $debug Reporte de atención inicial Ref [[$referencia]] ";
											}
// inconsistencias
elseif($tabla == 'inconsistencias'){
	
$formato_titulo = "reporte de inconsistencias en la base de datos (anexo 1 resolución 3047 de 2008)";
$formato_url=$url_aplicacion."/i/ii.php?r=$referencia";
$formato_pin=usuario_datos_consultar($id_documento,$tabla,'pin');														

$asunto =" $debug Informe de inconsistencia en la base de datos Ref [[$referencia]] ";
											}
elseif($tabla == 'autorizaciones_solicitud'){
	
$formato_titulo = "Solicitud de autorización para servicios posteriores a la atención de Urgencias (anexo 3 resolución 3047 de 2008)";
$formato_url=$url_aplicacion."/i/sa.php?r=$referencia";
$formato_pin=usuario_datos_consultar($id_documento,$tabla,'pin');														

$asunto =" $debug Solicitud de autorización Ref [[$referencia]] ";
											}
											else{}
$cuerpo ="
<html>
<body>
$debug_2
<table cellpadding='0' cellspacing='10' border='0' align='center' bgcolor='#FFFFFF' width='500px'>
	<tr>
		<td>
		<div align='center'><img src='$url_aplicacion/images/email_encabezado.gif' ALT='$empresa $empresa_direccion'></div>
		<br>Señores:
		<br>".usuario_datos_consultar($id_destino,'cliente','razon_social')." Código ".usuario_datos_consultar($id_destino,'cliente','codigo')."
		<br><b>Atención a ".usuario_datos_consultar($id_destino,'cliente','contacto_administrativo')."</b>
		<br>".usuario_datos_consultar($id_destino,'cliente','direccion')."<br>
		<br>Cordial saludo,<br>
		<br>Por medio de la presente comunicación, nos permitimos anexarle <b>$formato_titulo</b> el cual refiere  al usuario <b>identificado 
		con el documento número ".usuario_datos_consultar($id_usuario,'usuario','documento_numero')."</b> adscrito a su institución.
		<br>Para consultar el citado formulario siga este enlace: <a href='$formato_url' target='_blank'>$formato_url</a> o escriba la dirección del mismo en su navegador.
		<br>Cuando el sistema le solicite un <b>PIN</b> por favor escriba el siguiente: \"  <b>$formato_pin</b> \" 
		<br>
		<br>Atentamente,
		<br><b>".usuario_datos_consultar($_SESSION[id_usuario],'usuario','nombre_completo')."</b>
		<br>$empresa_sigla
		<br><font size='-2'>$empresa_direccion</font>
		<hr>
		La información reportada y/o autorización de servicios solicitada, esta acorde con los lineamientos técnicos del Decreto 4747 de 2007, 
		la Resolución 3047 de 2008 y la Ley 527 de 1999(en lo relacionado con la validéz e irrefutabilidad de la información electrónica).
		
		<div align='center'><img src='$url_aplicacion/images/email_pie.gif' alt ='Powered by http://GaleNUx.com, Implementado por http://qwerty.com.co, con el apoyo de: http://OpusLibertati.org' title='Powered by http://GaleNUx.com Implementado por http://qwerty.com.co Con e apoyo de: http://OpusLibertati.org'></div>

		</td>
	</tr>
</table>
</body>
</html>
";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= 'From: Autorizaciones HUSDA <autorizaciones@sanjuandediosarmenia.net>'. "\r\n";
$headers .= 'Cc: wialosza+pruebas@gmail.com' . "\r\n";

mail($direccion,$asunto,$cuerpo,$headers);

$consulta ="INSERT INTO  envios (id_documento,tabla,id_funcionario,referencia,id_destino,destino_tabla,direccion,canal,id_empresa) 
					         VALUES ('$id_documento','$tabla', '$_SESSION[id_usuario]','$referencia','$id_destino','$destino_tabla','$direccion','$canal','$_SESSION[id_empresa]')";
$sql=mysql_query($consulta,$link);



//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$resultado .= $asunto;
$resultado = envio_revisar($referencia,'','');
//															}
//										}

$respuesta->addAssign($capa,"innerHTML",$resultado);
return $respuesta;
} 

///fin funcion envio_documentos

function usuario_datos_consultar($id,$tipo,$campo){
$link=Conectarse(); 
if($tipo == 'usuario'){$tabla= 'd9_users'; $clave ='id'; $w = "LIMIT 1"; }
elseif($tipo == 'sucursal'){$tabla= 'sucursales'; $clave ='id_sucursal'; $w = "LIMIT 1";}
elseif($tipo == 'cliente'){$tabla= 'clientes'; $clave ='id_cliente'; $w = "LIMIT 1";}
elseif($tipo == 'nit'){$tabla= 'clientes'; $clave ='nit'; $w = "LIMIT 1";}
elseif($tipo == 'documento'){$tabla= 'documento_tipo'; $clave ='id_documento_tipo'; $w = "LIMIT 1";}
elseif($tipo == 'cie10'){$tabla= 'cie_10'; $clave ='codigo'; $w = "LIMIT 1";}
elseif($tipo == 'turnos_usuario'){$tabla= 'turnos'; $clave ='id_turno'; $w = "LIMIT 1";}
elseif($tipo == 'autorizaciones_solicitud'){$tabla= 'autorizaciones_solicitud'; $clave ='id_autorizacion_solicitud'; $w = "LIMIT 1";}
elseif($tipo == 'atencion_inicial'){$tabla= 'atencion_inicial'; $clave ='id_atencion_inicial'; $w = "LIMIT 1";}
elseif($tipo == 'clasificacion'){$tabla= 'atencion_inicial'; $clave ='control'; $w = "LIMIT 1";}
elseif($tipo == 'inconsistencias'){$tabla= 'inconsistencias'; $clave ='id_inconsistencia'; $w = "LIMIT 1";}
elseif($tipo == 'motivo_consulta'){$tabla= 'consulta_datos'; $clave ='control'; $w = "AND id_campo ='1' LIMIT 1";}
elseif($tipo == 'consultas_referencia'){$tabla= 'atencion_inicial'; $clave ='id_usuario'; $w ='ORDER BY `timestamp_atencion` DESC'; $lista ='1'; $campo ='*'; $nombre_select="control";}
elseif($tipo == 'eventos'){$tabla= 'eventos'; $clave ='id_evento'; }

else{}
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT $campo FROM $tabla WHERE $clave = '$id' $w ";
$sql=mysql_query($consulta,$link);

if (mysql_num_rows($sql)!='0'){
if($lista =='1'){$resultado .= "<select name='$nombre_select'>";}
while( $row = mysql_fetch_array( $sql ) ) {
if($lista !='1'){
$resultado .= "$row[$campo]" ;
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


function envio_revisar($referencia,$tipo,$campo){
$link=Conectarse(); 

mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM envios WHERE referencia = '$referencia' ORDER BY timestamp DESC";
$sql=@mysql_query($consulta,$link);
$cantidad =@mysql_num_rows($sql);
if (@mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
if($cantidad =='1'){
$resultado .= "<br><font color='green' size='-2' title='Enviado el $row[timestamp]'><font color='red'>Enviado</font> $row[timestamp]</font>";
						}else {$resultado .="<br><font size='-2'  color='green' title='Enviado el $row[timestamp]'><font color='red'>Enviado</font> $row[timestamp]</font>";}
														}
									}else {$resultado= ""; 
												return $resultado;
											}

return $resultado;

																 }
																 

function ping(){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$Valor = $variable_array["id_evento"];


//include_once("librerias/conex.php"); 
$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");

//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);



//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$nuevo_select .= "".$row['id']."".$row['nombre_completo']."<br>";
//															}
//										}
//$nuevo_select .= "<h1>".microtime()."</h1>";
$time=time();
$sql=mysql_query("
UPDATE `d9_users` 
SET `ping` = '$time' 
WHERE `id` ='$_SESSION[id_usuario]' LIMIT 1 ;",$link); 
$respuesta->addAssign("capa_ping","innerHTML",$nuevo_select);

$respuesta->addScript("ping('18000')");

return $respuesta;
} 
/// acepto licencia
function acepto_licencia($id_usuario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
include ("includes/disclaimer.php");
$lastdate = date('Y-m-d g:i:s');

include("includes/obtener_ip.php");
$lastip = obtener_ip();
foreach($_SERVER as $valores)
  {
   $servidor .= $valores."\n";
  }
$ip_publica = $_SERVER['REMOTE_ADDR'];
$licencia_fecha = time();
$acepto .= "Fecha: $lastdate \n
						Licencia: $licencia\n
						Ip: $lastip \n
						Posible IP publica: $ip_publica \n
						Datos del cliente: $servidor ";

//include_once("librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");

$sql=mysql_query("
UPDATE `d9_users` 
SET `licencia` = '$acepto',`licencia_fecha` = '$licencia_fecha'
WHERE `id` ='$id_usuario' LIMIT 1 ;",$link); 
$invitacion=mysql_query("
UPDATE `invitaciones` 
SET `timestamp_aceptado`  = '$licencia_fecha'
WHERE `id_invitado` ='$id_usuario' LIMIT 1 ;",$link); 

$respuesta->addRedirect("adentro.php");

return $respuesta;
} 
// fin de acepto licencia


///usuario_datos
function usuario_datos_dinamico($variable_array){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$documento = $variable_array["documento"];

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");

$Usuario_Datos=mysql_query("SELECT * FROM d9_users  WHERE  (documento_numero =  '$documento')",$link); 
$num=mysql_num_rows($Usuario_Datos);
if (mysql_num_rows($Usuario_Datos)!=0){
$i=0;
$id=mysql_result($Usuario_Datos,$i,"id");  
$id_grupo=mysql_result($Usuario_Datos,$i,"id_grupo");   
$documento_numero=mysql_result($Usuario_Datos,$i,"documento_numero");      
$nombre_completo=mysql_result($Usuario_Datos,$i,"nombre_completo");      
$p_apellido=mysql_result($Usuario_Datos,$i,"p_apellido");
$s_apellido=mysql_result($Usuario_Datos,$i,"s_apellido"); 
$s_nombre=mysql_result($Usuario_Datos,$i,"s_nombre"); 
$p_nombre=mysql_result($Usuario_Datos,$i,"p_nombre");  
$documento_tipo=mysql_result($Usuario_Datos,$i,"documento_tipo"); 
$estado_civil=mysql_result($Usuario_Datos,$i,"estado_civil"); 
$genero=mysql_result($Usuario_Datos,$i,"genero");  
$fecha_nacimiento=mysql_result($Usuario_Datos,$i,"fecha_nacimiento");  
$email=mysql_result($Usuario_Datos,$i,"email");  
$direccion=mysql_result($Usuario_Datos,$i,"direccion");   
$barrio=mysql_result($Usuario_Datos,$i,"barrio");   
$estrato=mysql_result($Usuario_Datos,$i,"estrato");   
$departamento=mysql_result($Usuario_Datos,$i,"departamento");   
$ciudad=mysql_result($Usuario_Datos,$i,"ciudad");      
$ciudad_extranjero=mysql_result($Usuario_Datos,$i,"ciudad_extranjero");   
$pais=mysql_result($Usuario_Datos,$i,"pais");   
$estado=mysql_result($Usuario_Datos,$i,"estado");   
$genero=mysql_result($Usuario_Datos,$i,"genero");   
$estado_civil=mysql_result($Usuario_Datos,$i,"estado_civil");   
$escolaridad=mysql_result($Usuario_Datos,$i,"escolaridad");    
$titulo_profesional=mysql_result($Usuario_Datos,$i,"titulo_profesional");   
$ocupacion=mysql_result($Usuario_Datos,$i,"ocupacion");   
$empresa=mysql_result($Usuario_Datos,$i,"empresa");  
$cargo=mysql_result($Usuario_Datos,$i,"cargo");   
$telefono_fijo=mysql_result($Usuario_Datos,$i,"telefono_fijo");  
$telefono_fijo_1=mysql_result($Usuario_Datos,$i,"telefono_fijo_1");  
$fax=mysql_result($Usuario_Datos,$i,"fax");  
$web=mysql_result($Usuario_Datos,$i,"web");   
$telefono_celular=mysql_result($Usuario_Datos,$i,"telefono_celular");  
$telefono_VoIP=mysql_result($Usuario_Datos,$i,"telefono_VoIP");   
$presentacion=mysql_result($Usuario_Datos,$i,"presentacion");  
$activos=mysql_result($Usuario_Datos,$i,"activos");

if ($fecha_nacimiento == "0000-00-00"){
$ano = "";
$mes = "";
$dia = "";
}
else {
$letras=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$fecha_nacimiento = strtotime($fecha_nacimiento);
$ano = date("Y", $fecha_nacimiento);
$mes = date("m", $fecha_nacimiento);
$dia = date("d", $fecha_nacimiento);
$mes_letras = date("n", $fecha_nacimiento);
$mes_letras = $letras[$mes_letras];
}
$nuevo_select = "<a HREF=\"javascript:abrir('suscriptores/presentacion/editar_usuario.php?id=$id','editar_usuario',600,600,300,0,1)\" TITLE='Clic AQUI para editar el Usuario'><h1> ID: [$id] $nombre_completo</h1><h1>$direccion $barrio $ciudad $ciudad_extranjero $estado $departamento $pais </h1></A>";
//echo $nuevo_select;
if ($_SESSION['grupo'] == "2"){}
else{
$nuevo_select .= $ID; 
$nuevo_select .= "<a HREF=\"javascript:abrir('suscriptores/presentacion/enviar_correo.php?id=$id&id_remitente=$id_remitente','enviar_correo',600,300,100,0,1)\" TITLE='Clic AQUI en contactar usuario'><p>Enviar correo a usuario</p></a>";
//echo $nuevo_select;
 

}
}

$respuesta->addAssign("usuarios","innerHTML",$nuevo_select);
return $respuesta;



} 


//// SERVICIO AL CLIENTE
function servicio_cliente($variable_array){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$Valor = $variable_array["id_servicio_cliente"];
$ID = $variable_array["id"];
$funcionario=$_SESSION["id_usuario"];
$fecha_sistema=date('Y-m-d H:i:s');

//include_once("librerias/conex.php"); 
$link=Conectarse(); 

$sql=mysql_query("
UPDATE `servicio_cliente` 
SET `cerrado` = '1' ,
 `cerrado_por` = '$funcionario' ,
  `fecha_cierre` = '$fecha_sistema' 


WHERE `servicio_cliente`.`id_servicio_cliente` =$Valor LIMIT 1 ;",$link); 
//servicio_cliente.id = $ID AND
$listado_reportes=mysql_query("

SELECT fecha_inicio, asunto, descripcion,nombre_completo , id_servicio_cliente
FROM `servicio_cliente` ,`d9_users` 
WHERE   servicio_cliente.cerrado != '1'
AND d9_users.id = $funcionario
ORDER BY fecha_inicio DESC",$link);
$nuevo_select = "";
if (mysql_num_rows($listado_reportes)!=0)	{
$nuevo_select .=  "<h2>Mensajes o reportes pendientes</h2>";
$nuevo_select .=  "<table align=center border=0 title='Reportes de servicio al cliente'>";
$nuevo_select .= "<td align=center>Fecha</td>";
$nuevo_select .=  "<td align=center>Asunto</td>";
$nuevo_select .=  "<td  align=right>Descripci&oacute;n</td>
<td  align=center>Funcionario</td><td  align=center>Acci&oacute;n</td>
</tr><tr>";

while($salida = mysql_fetch_array($listado_reportes)){

       for ($i=0;$i<5;$i++){


        if($i!=4){       

$nuevo_select .=  "<td  bgcolor='#fde0ac'><font size=-2>".$salida[$i]."</font></td>";
        				}else{
$nuevo_select .=  "<td bgcolor='#fde0ac'>
        			<a HREF=\"javascript:abrir('suscriptores/presentacion/enviar_correo.php?id=$ID&responder=$salida[id_servicio_cliente]','enviar_correo',600,300,100,0,1)\" TITLE='Responder'><p>Responder</p></a>
       
        <form id='mensaje' name='mensaje'><center>
        <input type='hidden' name='id_servicio_cliente' value='$salida[id_servicio_cliente]'>
        <input type='hidden' name='id' value='$ID'>
      <input  value='(X)' onclick=\"xajax_servicio_cliente(xajax.getFormValues('mensaje'))\" type='button' title='Marcar como leido'></form></center></td></tr>";
    							}
        							}   
																		}
$nuevo_select .=  "</tr>
</table>";

 }else{$nuevo_select .= "AL PARECER NO HAY REPORTES";}																		




//while( $row = mysql_fetch_array( $sql ) ) {
//$nuevo_select .= '' . $row['id'] . '">' . $row['nombre_completo'] . '<br>';
//}

$respuesta->addAssign("servicio_cliente","innerHTML",$nuevo_select);
return $respuesta;



} 
//// SERVICIO AL CLIENTE FIN


///FUNCION PARA EL MuNDO

function mundo($formulario,$pais, $departamento, $ciudad,$campo_mundo){

$mundo .= "Pais $campo_mundo: <br>
								<select name='cod_pais' id='cod_pais' onchange=\"xajax_generar_select(xajax.getFormValues('$formulario'))\">
								<option value='999' SELECTED>Pais</option>
					";

$link=Conectarse(); 
mysql_query ("SET NAMES 'utf8'");
if ($pais != ""){
$Pais_definido=mysql_query("SELECT * FROM geo_pais WHERE cod_pais = '$pais'",$link);
$pais_definido=mysql_result($Pais_definido,0,"nom_pais");
$mundo .= "<option value='$pais' selected >>$pais_definido<</option>";
								}else {$mundo .= "<option value='COL' selected >Seleccione un pais</option>";}
$Pais_Tipo=mysql_query("SELECT * FROM geo_pais",$link);
if (mysql_num_rows($Pais_Tipo)!='0'){
while( $row = mysql_fetch_array( $Pais_Tipo ) ) {
$mundo .= "<option value='".$row['cod_pais']."'>".$row["nom_pais"]."</option>";
																					}
																		}

     
$mundo .="</select><br><div id='seleccombinado'>";
if ($departamento != ""){
if ($pais == "COL") {
$Departamento_definido= @mysql_query("SELECT * FROM geo_municipios_colombia WHERE codigo_departamento = '$departamento'",$link);
$departamento_definido=@mysql_result($Departamento_definido,0,"nombre_departamento");
$mundo .= "Departamento $campo_mundo: <b>$departamento_definido</b>
						<input type='hidden' name='cod_departamento'  value='$departamento'>";
										}else{

$mundo .= "Estado o provincia $campo_mundo: <b>$departamento</b>
					<input type='hidden' name='cod_departamento'  value='$departamento'>";
													}

												}
$mundo .= "</div><div id='selecmunicipios'>";
if ($ciudad != ""){
if ($pais == "COL") {
$Municipio_definido=mysql_query("SELECT * FROM geo_municipios_colombia WHERE codigo_departamento = '$departamento' AND codigo_municipio ='$ciudad'",$link);
$municipio_definido=@mysql_result($Municipio_definido,0,"nombre_municipio");
$mundo .= "Ciudad $campo_mundo: <b>$municipio_definido</b><input type='hidden' name='cod_ciudad'  value='$ciudad'>";
										}else{

$mundo .= "Ciudad $campo_mundo: <b>$ciudad</b><input type='hidden' name='cod_ciudad'  value='$ciudad'>";
													}

												}
$mundo .= "</div>";
return $mundo;
 }

//// departamentos

function departamentos($formulario,$pais, $departamento, $ciudad,$campo_mundo){

$mundo .= "Departamento<br>
								<select name='cod_departamento' id='cod_departamento' onchange=\"xajax_municipios(xajax.getFormValues('$formulario'))\">
								<option value='' SELECTED>Departamentos</option>
					";

$link=Conectarse(); 
mysql_query ("SET NAMES 'utf8'");
if ($departamento != ""){
$Departamento_definido=mysql_query("SELECT * FROM geo_municipios_colombia WHERE cod_departamento = '$departamento'",$link);
$pais_definido=mysql_result($Pais_definido,0,"nom_pais");
$mundo .= "<option value='$pais' selected >>$pais_definido<</option>";
								}else {
								
$mundo .= "<option value='' selected >Seleccione un departamento</option>";}
$Pais_Tipo=mysql_query("SELECT * FROM geo_municipios_colombia GROUP BY codigo_departamento",$link);
if (mysql_num_rows($Pais_Tipo)!='0'){
while( $row = mysql_fetch_array( $Pais_Tipo ) ) {
$mundo .= "<option value='".$row['codigo_departamento']."'>".$row["nombre_departamento"]."</option>";
																					}
																		}

     
$mundo .="</select><br><div id='seleccombinado'>";
if ($departamento != ""){
if ($pais == "COL") {
$Departamento_definido=mysql_query("SELECT * FROM geo_municipios_colombia WHERE codigo_departamento = '$departamento'",$link);
$departamento_definido=mysql_result($Departamento_definido,0,"nombre_departamento");
$mundo .= "Departamento $campo_mundo: <b>$departamento_definido</b>
						<input type='hidden' name='cod_departamento'  value='$departamento'>";
										}else{

$mundo .= "Estado o provincia $campo_mundo: <b>$departamento</b>
					<input type='hidden' name='cod_departamento'  value='$departamento'>";
													}

												}
$mundo .= "</div><div id='selecmunicipios'>";
if ($ciudad != ""){
if ($pais == "COL") {
$Municipio_definido=mysql_query("SELECT * FROM geo_municipios_colombia WHERE codigo_departamento = '$departamento' AND codigo_municipio ='$ciudad'",$link);
$municipio_definido=mysql_result($Municipio_definido,0,"nombre_municipio");
$mundo .= "Ciudad $campo_mundo: <b>$municipio_definido</b><input type='hidden' name='cod_ciudad'  value='$ciudad'>";
										}else{

$mundo .= "Ciudad $campo_mundo: <b>$ciudad</b><input type='hidden' name='cod_ciudad'  value='$ciudad'>";
													}

												}
$mundo .= "</div>";
return $mundo;
 }


//// departamentos
function generar_select ($formulario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$conn=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$pais = $formulario["cod_pais"];
$formulario = $formulario["formulario"];

mysql_select_db($BaseDeDatos,$conn);

mysql_query ("SET NAMES 'utf8'");
/// si el pais no es colombia
if ($pais != "COL"){
										$nuevo_select .= "Estado o provincia $campo_mundo: 
																			<br><select name='cod_departamento' id='cod_departamento' onchange=\"xajax_ciudades(xajax.getFormValues('$formulario'))\">
																				<option value=''>Estado o provincia:</option>																			
																			"; 	
	
										$ssql = "SELECT * FROM geo_ciudad WHERE  cod_pais = '$pais' GROUP BY distrito_ciudad "; 
										$rs = mysql_query($ssql,$conn); 

										while( $row = mysql_fetch_array( $rs ) ) {
													$nuevo_select .= '<option value="'.$row['distrito_ciudad'].'">' . $row['nombre_ciudad'] . '</option>/n';

																															}

										$nuevo_select .= "</select>";
									}	
/// si el pais es colombia									
						ELSE {
									$nuevo_select .= "Departamento $campo_mundo: <br>
																		<select name='cod_departamento' id='cod_departamento' onchange=\"xajax_municipios(xajax.getFormValues('$formulario'))\">
																		<option value=''>Departamento:</option>
																		"; 	

									$ssql = "SELECT * FROM geo_municipios_colombia GROUP by codigo_departamento"; 
									$rs = mysql_query($ssql,$conn);
									while( $row = mysql_fetch_array( $rs ) ) {
													$nuevo_select .= '<option value="'.$row['codigo_departamento'].'">'. $row['nombre_departamento'] . '</option>/n';
																														}
									$nuevo_select .= "</select>";
									$borrar = "";
						  		}				
$respuesta->addAssign("seleccombinado","innerHTML",$nuevo_select);
$respuesta->addAssign("selecmunicipios","innerHTML",$borrar);
return $respuesta;
}
////funcion municipios
function municipios($formulario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$departamento = $formulario["cod_departamento"];
$formulario = $formulario["formulario"];
$conn=Conectarse(); 
mysql_query("SET NAMES 'utf8'"); 
$nuevo_select .= "Ciudad  <br><select id='cod_ciudad' name='cod_ciudad'>";	
$ssql = "SELECT * FROM geo_municipios_colombia WHERE  codigo_departamento = '$departamento'  "; 
$rs = mysql_query($ssql,$conn);
while( $row = mysql_fetch_array( $rs ) ) {
$nuevo_select .= '<option value="'.$row['codigo_municipio'].'">' . $row['nombre_municipio'] . '</option>/n';
}
$nuevo_select .= "</select>";
$respuesta->addAssign("selecmunicipios","innerHTML",$nuevo_select);
return $respuesta;
}
////fin funcion municipios

////funcion ciudades
function ciudades($formulario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$distritoX = $formulario["distrito_ciudad"];
$formulario = $formulario["formulario"];
$conn=Conectarse(); 
mysql_query("SET NAMES 'utf8'");

$nuevo_select .= "Ciudad  <br> <select id='cod_ciudad' name='cod_ciudad'>";	
$ssql = "SELECT * FROM geo_ciudad WHERE  distrito_ciudad = '$distrito'  "; 
$rs = mysql_query($ssql,$conn);
while( $row = mysql_fetch_array( $rs ) ) {
$nuevo_select .= '<option value="'.$row['nombre_ciudad'].'">' . $row['nombre_ciudad'] . '</option>/n';
}
$nuevo_select .= "</select>";
$respuesta->addAssign("selecmunicipios","innerHTML",$nuevo_select);
return $respuesta;
}


//// FIN FUNCION PARA EL MUNDO


function procesar_formulario($form_entrada){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$inicio = $form_entrada["inicio"];
$fin = $form_entrada["fin"];

include_once("librerias/conex.php"); 
$link=Conectarse(); 

$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);


$nuevo_select = "inicio = $inicio // fin = $fin <br>";
while( $row = mysql_fetch_array( $sql ) ) {
$nuevo_select .= '' . $row['id'] . '">' . $row['nombre_completo'] . '<br>';
}
$nuevo_select .= "";
$respuesta->addAssign("capaformulario","innerHTML",$nuevo_select);
return $respuesta;



} 


function revisar_documento($documentos){
$respuesta = new xajaxResponse('utf-8');
$documento1 = $documentos["documento_numero"];
$documento2 = $documentos["documento_numero2"];
if ($documento2 != $documento1)
{ $nuevo_select = '<font color="red">Las identificaciones no coinciden</font>';}
else{$nuevo_select = '<font color="green">Identificaciones correctas</font>';}
$respuesta->addAssign("documca","innerHTML",$nuevo_select);
return $respuesta;
}

function revisar_email($email){
$respuesta = new xajaxResponse('utf-8');
$email1 = $email["email"];
$email2 = $email["email_2"];
if ($email2 != $email1)
{ $nuevo_select = '<font color="red">Correos ingresados incorrectos</font>';}
else{$nuevo_select = '<font color="green">Correos ingresados correctos</font>';}
$respuesta->addAssign("mailca","innerHTML",$nuevo_select);
return $respuesta;
}

function revisar_telefono($telefono){
$respuesta = new xajaxResponse('utf-8');
$telefono1 = $telefono["$telefono_fijo"];
if ( strlen($telefono1)<7)
{ $nuevo_select = '<font color="red">Tel&eacute;fono incorrecto</font>';}
else{$nuevo_select = '<font color="green">Telefono correcto</font>';}
$respuesta->addAssign("tele1ca","innerHTML",$nuevo_select);
return $respuesta;
}

function item_menu($item,$titulo){
$item_actual=$_REQUEST['page'];
if($item==$item_actual){
$item_menu="
	<tr  
		bgcolor='c2f0e5'>
		<td width='200'>
			<a href='?page=$item'  title= '$titulo'>&nbsp;$titulo</a>
		</td>
	</tr>";
													}
													else {
$item_menu="
	<tr  onClick=\"uno(this,'c2f0e5');\"  onMouseOver=\"uno(this,'c2f0e5');\" onMouseOut=\"dos(this,'ffffff');\" 
		bgcolor=''>
		<td width='200'>
			<a href='?page=$item' title= '$titulo'>&nbsp;$titulo</a>
		</td>
	</tr>";
																}
return $item_menu;
}

function comprobar_email($email){
$respuesta = new xajaxResponse('utf-8');
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1; 
                }
             }
          }
       }
    }
    if ($mail_correcto)
       {$ok="<a  onclick=\"xajax_enviar_invitacion(xajax.getFormValues('invitar'))\"><font size='-2' title='Un solo click para continuar'><b>[ INVITAR ]</b></font></a>";}
    else
      {$ok="<font size='-2' color='#E5E5E5'>[ INVITAR ]</font><br><font size='-2' color='red'>Email no valido</font>";}

$respuesta->addAssign("capa_mail","innerHTML",$ok);
return $respuesta;
} 

function enviar_invitacion($correo){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'"); 
$correo_invitado = $correo["correo_invitado"];
$nombre_invitado = $correo["nombre_invitado"];
$timestamp = time();
$id_anfitrion =$_SESSION['id_usuario'];
$control= "$timestamp-$id_anfitrion";
if($correo_invitado != ''){
$comprobar_usuario=mysql_query("SELECT * FROM d9_users WHERE email = '$correo_invitado' AND licencia !='' LIMIT 1",$link);
$comprobar_invitado=mysql_query("SELECT * FROM invitaciones WHERE email_invitado = '$correo_invitado' AND timestamp_aceptado IS NULL  LIMIT 1",$link);
if (mysql_num_rows($comprobar_usuario)!='0'){$error="<font color='red'>$nombre_invitado ya es miembro de GaleNUx</font>";}
elseif (mysql_num_rows($comprobar_invitado)!='0'){$error="<font color='red'><b>$nombre_invitado</b> ya fué invitado a GaleNUx y estamos esperando que acepte la invitación.</font>";}
else {$error='0';}
if ($error == '0'){//// si no hay error
include_once("includes/datos.php");
global $empresa,$url_aplicacion;  
$nombre_completo =$_SESSION['nombre_completo'];

$from =$_SESSION['email'];
$destinatario = $correo_invitado;
include_once("suscriptores/password/generar_password.php");  
$password = generar_password();
$password_cifrado = md5($password);
include_once("suscriptores/proceso/crear_entkey.php"); 
$numero = rand(1111,9999);
$entkey=crear_entkey($numero); 
$sql=mysql_query("INSERT INTO  d9_users (id, passwd, username,entkey, email, id_grupo,control) 
					VALUES ('NULL', '$password_cifrado','$correo_invitado', '$entkey', '$correo_invitado', '9', '$control')",$link);
$invitado=mysql_query("SELECT * FROM d9_users WHERE control = '$control' LIMIT 1",$link);
$id_invitado=mysql_result($invitado,0,"id");
$invitacion=mysql_query("INSERT INTO invitaciones (id_invitacion, id_anfitrion, id_invitado, nombre_invitado, email_invitado, timestamp,control) 
					VALUES ('NULL', '$id_anfitrion', '$id_invitado','$nombre_invitado', '$correo_invitado', '$timestamp', '$control')",$link);

$asunto ="Hola colega";
$cuerpo ="
<html>
<body>
<p>Hola colega</p>
<p>Estoy usando GaleNUx-praxis y me ha gustado, por eso te invito para que lo utilices en tu consultorio.</p>
<p>GaleNUx es un sistema de información para la práctica médica, que brinda las herramientas necesarias para 
la realización del acto médico y las tareas administativas como generación de RIPS y facturación.</p>
$licencia_fecha<p>No tienes que instalar nada en tu computador, simplemente aceptar esta invitación y seguir los pasos del asistente
que te ayudará en la configuración de tu consultorio. El sistema está bassado en Internet, por lo que lo puedes usar 
en cualquier parte, por ejemplo si viajas o vas a hacer consultas a los mismos pacientes en diferentes consultorios. </p>
<a href='http://galenux.com'>http://GaleNUx.com</a><br>
<ul>
<li>Nombre de usuario: <b>$correo_invitado</b></li>
<li>Password: <b>$password</b></li>
</ul>
<p>Saludos.<br>
$nombre_completo MD.</p>
</body>
</html>
";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $from";

mail($destinatario,$asunto,$cuerpo,$headers);
$nuevo_select .= "Acabas de invitar a <strong>$nombre_invitado</strong>";
									} /// fin de correo no existe
										else 
										{$nuevo_select = $error;}

											}/// FI DE CORREO NO VACIO
else {$nuevo_select = "<h1>No indicó correo alguno</h1>";}
$respuesta->addAssign("capa_invitacion","innerHTML",$nuevo_select);
return $respuesta;
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
