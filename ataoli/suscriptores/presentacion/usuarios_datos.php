<?php 
function usuario_datos($id,$grupo){
$id =$id;
if($_SESSION['grupo']!='1'){$id_empresa= $_SESSION['id_empresa'];}else {$id_empresa='%%';}
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
$Usuario_simple=mysql_query(" 
SELECT 	users.id,
			users.id_grupo,
			users.documento_numero,
			users.documento_tipo,
			users.fecha_nacimiento, 
			users.nombre_completo
FROM users 
WHERE  id_empresa LIKE '$id_empresa' 
AND (users.id =  '$id')
									",$link); 
if($grupo != '2'){
$Usuario_Datos=mysql_query("
SELECT 	users.id,
			users.id_grupo,
			users.documento_numero,
			users.documento_tipo,
			users.fecha_nacimiento, 
			users.nombre_completo
WHERE  users.id_empresa LIKE '$id_empresa' 
AND (users.id =  '$id')
									",$link); 
											}
/*											else
											{
$Usuario_Datos=mysql_query("
SELECT 	users.id, 
			users.id_grupo,
			users.documento_numero,
			users.documento_tipo,
			users.fecha_nacimiento, 
			users.nombre_completo, 
			clientes.alias   AS id_cliente,
			tipo_plan_beneficios.tipo_plan_beneficios AS plan_beneficios,
			tipo_usuarios.tipo_usuario  AS tipo_usuario,
			clientes.estado AS estado
FROM users , clientes , tipo_plan_beneficios, tipo_usuarios
WHERE  users.id_empresa LIKE '$id_empresa' 
AND (users.id =  '$id')
AND users.id_cliente = clientes.id_cliente
AND users.plan_beneficios = tipo_plan_beneficios.id_tipo_plan_beneficios
AND users.tipo_usuario = tipo_usuarios.id_tipo_usuario

									",$link); 
											} 
											*/
if (mysql_num_rows($Usuario_simple)!=0){
							/*
							if($grupo == '2'){
							if (mysql_num_rows($Usuario_Datos)!=0){
							$id_cliente=mysql_result($Usuario_Datos,0,"id_cliente");
							$plan_beneficios=mysql_result($Usuario_Datos,0,"plan_beneficios");
							$tipo_usuario=mysql_result($Usuario_Datos,0,"tipo_usuario");  
							$estado=mysql_result($Usuario_Datos,0,"estado"); 
							$vinculacion .= "
							<li>Entidad: $id_cliente $estado </li>
							<li>Tipo: $tipo_usuario </li>
							<li>Plan de beneficios: $plan_beneficios</li>";
																										
									
									if($estado =='0') {
																	$estado =" <img src='images/atencion.gif' border='0' alt='[!]' title='La EPS esta inactiva'> EPS inactiva ";
																		} else{$estado ="";} 
																												}else {$vinculacion .= "<!-- <div align='center' class='alerta'><img src='images/atencion.gif' border='0' alt='[!]' 
																																title='ATENCION: El usuario TIENE DATOS INCOMPLETOS'> 
																																<h2>El usuario no esta asociado con una EPS<br> o no cuenta con los datos necesarios para facturar
																																</h2><a HREF=\"javascript:abrir('suscriptores/presentacion/editar_usuario.php?id=$id','editar_usuario',600,600,300,0,1)\" 
																																TITLE='Clic AQUI para editar el Usuario'><h1>[ Completar Perfil ]</h1></A>
																																									</div> -->";
																															}
															}
															*/
									$id=mysql_result($Usuario_simple,0,"id");  
									$id_grupo=mysql_result($Usuario_simple,0,"id_grupo");
									$documento_numero=mysql_result($Usuario_simple,0,"documento_numero");      
									$nombre_completo=mysql_result($Usuario_simple,0,"nombre_completo");      
									$fecha_nacimiento=mysql_result($Usuario_simple,0,"fecha_nacimiento");    
									$documento_tipo=mysql_result($Usuario_simple,0,"documento_tipo");  
									 //$documento_tipo = usuario_datos_consultar($documento_tipo,'documento','documento_tipo');
									 //$edad = saber_edad($fecha_nacimiento);

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
$nuevo_select .= "<h2> Código: [$id] $nombre_completo
<a OnClick=\"xajax_suscriptores_formulario('$id','otro')\"  TITLE='Clic AQUI para editar el Usuario'>
<img src='images/editar.gif' border='0' alt='[E]' title='Editar el perfil del usuario'></A> 

<a HREF=\"javascript:abrir('suscriptores/presentacion/enviar_correo.php?id=$id&id_remitente=$id_remitente','enviar_correo',750,400,100,0,1)\" TITLE='Clic AQUI en contactar usuario'>
<img src='images/email.gif' border='0' alt='[M]' title='Enviar correo'>
</a></h2><h3>Documento: $documento_tipo $documento_numero</h3>
";
//$nuevo_select .= $vinculacion;
echo $nuevo_select;
if ($_SESSION['grupo'] == "2"){}
else{
$nuevo_select = $ID; 
$nuevo_select .= "";
echo $nuevo_select;
		}
}ELSE {echo "";}

}//fin funcion

?>
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