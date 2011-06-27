<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 

					
$id_usuario = $_SESSION['id_usuario'];					

$perfil=mysql_query("SELECT * FROM users WHERE id= $id_usuario AND p_nombre IS NOT NULL ",$link);
$consulta_licencia=mysql_query("SELECT licencia FROM d9_users WHERE id = '$id_usuario' AND licencia !='' LIMIT 1",$link);


///empresa grupo
///PRIMERO SE CONSULTA SI EL USUARIO ESTA EN UNA EMPRESA AGRUPADAD
$empresa=mysql_query("SELECT * FROM empresa_grupo WHERE id_usuario = '$id_usuario' LIMIT 1",$link);
///SI NO ESTA EN UNA EMPRESA AGRUPADA
if (mysql_num_rows($empresa)=='0'){
/// SE BUSCA SI ESTA EN UNA EMPRESA SIMPLE
		$empresa=mysql_query("SELECT * FROM empresa WHERE empresa_responsable = '$id_usuario' LIMIT 1",$link);
/// SI ESTA EN UNA EMPRESA SIMPLE		
				if (mysql_num_rows($empresa)!='0'){
		/// EL $id_empresa es igual al de la empresa simple				
				$id_empresa=mysql_result($empresa,0,"id_empresa");	
				
															}
															
/// SI NO ESTA EN UNA EMPRESA SIMPLE															
															else {
/// EL $id_empresa SERÁ IGUAL A LA EMPRESA HEREDADA															
																	$id_empresa=mysql_result($perfil,0,"id_empresa");
																	

																		
																	}
											
											}
/// SI ESTA EN UNA EMPRESA AGRUPADA ESA SE ESTABLECE COMO $id_empresa
											else {
$id_empresa=mysql_result($empresa,0,"id_empresa");
													}
/*														
if ($_SESSION['grupo'] == '3'){$asistencial = '1';}
elseif ($_SESSION['grupo'] == '8'){$asistencial = '1';}
elseif ($_SESSION['grupo'] == '9'){$asistencial = '1';}

else{$asistencial = '0';}
*/
/*
if($asistencial=='1'){
$especialista=mysql_query("SELECT id_especialista FROM especialistas WHERE id = '$id_usuario'  LIMIT 1",$link);
				}
if (mysql_num_rows($consulta_licencia)=='0'){


	include ("includes/disclaimer.php");
	
	echo "<div align='center'><img src='images/logo.jpg'  border='0' alt='GaleNUx-praxis'>
	<br>
	<table cellpadding='0' cellspacing='0' border='0' align='center' valign='top' width='80%'>
		<tr>
			<td><font size='3'>$licencia</font>
			</td>
		</tr>
	</table><input type='button' value='Acepto los terminos' OnClick=\"xajax_acepto_licencia('$id_usuario');\" >
	</div>";
																						}
																						*/
/*
elseif (!isset($id_empresa)){
echo "<div align='center'>
				<font size='+2'>
					<img src='images/atencion.gif'> Aún no se han definido los detalles de su consultorio o empresa
					<br> a continuación le ayudaremos con el proceso.
				</font><hr>
			</div>";
echo empresa_formulario("inicio");
																}
																
	*/															
																////elseif para especialista
																

/*
 													
elseif ($asistencial =='1' && mysql_num_rows($especialista)=='0' ){/// si asistencial  =1
//if(mysql_num_rows($especialista)=='0'){  /// si no se ha grabado el especilista
$Usuario_Datos=mysql_query("SELECT * FROM users  WHERE  (id =  '$id_usuario')",$link); 
$num=mysql_num_rows($Usuario_Datos);
if (mysql_num_rows($Usuario_Datos)!=0){ /// si hay datos de usuario valido 

$id=mysql_result($Usuario_Datos,0,"id");  
$id_grupo=mysql_result($Usuario_Datos,0,"id_grupo");       
$nombre_completo=mysql_result($Usuario_Datos,0,"nombre_completo");   
$id_cliente=mysql_result($Usuario_Datos,0,"id_cliente");
$plan_beneficios=mysql_result($Usuario_Datos,0,"plan_beneficios");
$tipo_usuario=mysql_result($Usuario_Datos,0,"tipo_usuario");
$documento_numero=mysql_result($Usuario_Datos,0,"documento_numero");      
$p_apellido=mysql_result($Usuario_Datos,0,"p_apellido");
$s_apellido=mysql_result($Usuario_Datos,0,"s_apellido"); 
$s_nombre=mysql_result($Usuario_Datos,0,"s_nombre"); 
$p_nombre=mysql_result($Usuario_Datos,0,"p_nombre");  
$documento_tipo=mysql_result($Usuario_Datos,0,"documento_tipo"); 
$estado_civil=mysql_result($Usuario_Datos,0,"estado_civil"); 
$genero=mysql_result($Usuario_Datos,0,"genero");  
$fecha_nacimiento=mysql_result($Usuario_Datos,0,"fecha_nacimiento");  
$email=mysql_result($Usuario_Datos,0,"email");  
$direccion=mysql_result($Usuario_Datos,0,"direccion");   
$barrio=mysql_result($Usuario_Datos,0,"barrio");   
$control=mysql_result($Usuario_Datos,0,"control");   
$departamento=mysql_result($Usuario_Datos,0,"departamento");   
$ciudad=mysql_result($Usuario_Datos,0,"ciudad");      
$ciudad_extranjero=mysql_result($Usuario_Datos,0,"ciudad_extranjero");   
$pais=mysql_result($Usuario_Datos,0,"pais");   
$estado=mysql_result($Usuario_Datos,0,"estado");   
$genero=mysql_result($Usuario_Datos,0,"genero");   
$estado_civil=mysql_result($Usuario_Datos,0,"estado_civil");   
$escolaridad=mysql_result($Usuario_Datos,0,"escolaridad");    
$titulo_profesional=mysql_result($Usuario_Datos,0,"titulo_profesional");   
$ocupacion=mysql_result($Usuario_Datos,0,"ocupacion");   
$empresa=mysql_result($Usuario_Datos,0,"empresa");  
$cargo=mysql_result($Usuario_Datos,0,"cargo");   
$telefono_fijo=mysql_result($Usuario_Datos,0,"telefono_fijo");  
$telefono_fijo_1=mysql_result($Usuario_Datos,0,"telefono_fijo_1");  
$fax=mysql_result($Usuario_Datos,0,"fax");  
$web=mysql_result($Usuario_Datos,0,"web");   
$telefono_celular=mysql_result($Usuario_Datos,0,"telefono_celular");  
$telefono_VoIP=mysql_result($Usuario_Datos,0,"telefono_VoIP");   
$activos=mysql_result($Usuario_Datos,0,"activos");
$responsable_nombre=mysql_result($Usuario_Datos,0,"responsable_nombre");
$responsable_direccion=mysql_result($Usuario_Datos,0,"responsable_direccion");
$responsable_telefono=mysql_result($Usuario_Datos,0,"responsable_telefono");

if ($fecha_nacimiento == "0000-00-00"){/// si la fecha de nacimiento no es igual a 0 se convierte a date
$fecha_nacimiento == "";
													}/// fin de fecha de nacimiento


												}///fin de datos del usuario
			
			echo "
			
			<div name='resultado' id='resultado' align='center'>
			<div align='center'><img src='images/logo.jpg'  border='0' alt='GaleNUx-praxis'><br>
				<font size=''>
				A continuación le ayudaremos a ingresar los datos personales <br>para crear su perfil de usuario.
					
				</font>
							
				<hr>
				<div name='usuarios' id='usuarios' align='center'>
				<form id='perfil' name='perfil'>
				<input type='hidden' name='formulario' value='perfil'>
				<input type='hidden' name='id_grupo' id='id_grupo' value='$_SESSION[grupo]'> 
				<input type='hidden' name='id' size='5' value='$_SESSION[id_usuario]'>
				
<input type='hidden' name='email' id='email'  value='$_SESSION[email]'>
<input type='hidden' name='email_2' id='email_2' value='$_SESSION[email]'>
				<table>
<tr><td><h2>Datos b&aacute;sicos</h2><hr></td><td></td></tr>
<tr><td colspan='2'>
</td></tr>
<tr><td><div id='p_nombre'></div>Primer Nombre:</td><td>Segundo Nombre:</td></tr>
<tr><td><input type='text' name='p_nombre' size='25' value='$p_nombre'></td>
<td> <input type='text' name='s_nombre' size='25' value='$s_nombre'> </td></tr>
<tr><td><div id='p_apellido'></div>Primer Apellido:</td><td>Segundo Apellido:</td></tr>
<tr><td><input type='text' name='p_apellido' size='25' value='$p_apellido'></td>
<td><input type='text' name='s_apellido' size='25' value='$s_apellido'></td></tr>
<tr><td align='right'><div id='documento_numero'></div>Tipo documento:</td><td>Documento: / Confirmacion</td></tr>
<tr><td align='right'><select name='documento_tipo' size='0'>";

$Tipo_documento=mysql_query('SELECT * FROM documento_tipo',$link);  
while($row = mysql_fetch_array($Tipo_documento)) {
      echo "<option value='".$row['id_documento_tipo']."'>". $row['documento_tipo']."</option>";}
echo "
</select></td><td>
<input type='text' name='documento_numero' id='documento_numero'  value='$documento_numero'  >
<input type='text' name='documento_numero_2' id='documento_numero_2' value=''>
</td></tr>
			<tr>
				<td align='right'> Fecha de Nacimiento: (a&ntilde;o-mes-dia)</td>
				<td><input size='10' id='fc_fecha_nacimiento'  title='YYYY-MM-DD' onClick=\"displayCalendar(this);\"  type='text'  name='fecha_nacimiento'  value='$fecha_nacimiento'>
			</tr>				
			<tr>
<tr><td align='right'>Direccion:</td><td> <input type='text' name='direccion'  value='$direccion' size='40'></td></tr>
<tr><td align='right'> Tel&eacute;fono fijo:</td>
<td><input type='text' name='telefono_fijo' id='telefono_fijo'  onKeyPress='return acceptNum(event)' value='$telefono_fijo'></tr>
<tr><td align='right'> Tel&eacute;fono movil:</td><td> <input type='text' name='telefono_celular' onKeyPress='return acceptNum(event)' value='$telefono_celular'></td></tr>
<tr><td></td><td>";
   echo mundo("perfil","$pais","$departamento","$ciudad","");
echo "
</td></tr>
<tr><td><h2>Datos profesionales</h2><hr></td><td></td></tr>
<td><div align='right'>Registro médico: </div></td>
<td><input name='registro_medico' id='registro_medico' size='60' maxlength='255' value='' title='Registro medico' type='text'></td></tr>
<tr><td width='30%'><div align='right'>Universidad Pregrado: </div></td>
<td><input name='universidad_pregrado' id='universidad_pregrado' size='60' maxlength='255' value='' title='universidad_pregrado' type='text'></td></tr>
<tr><td width='30%'><div align='right'>Especialidad: </div></td>
<td><input name='especialidad' id='especialidad' size='60' maxlength='255' value='' title='especialidad' type='text'></td></tr>
<tr><td width='30%'><div align='right'>Universidad Especialización: </div></td>
<td><input name='universidad_especializacion' id='universidad_especializacion' size='60' maxlength='255' value='' title='universidad_especializacion' type='text'></td></tr>
<tr><td width='30%'><div align='right'> Cargo: </div></td>
<td><input name='cargo' id='cargo' size='60' maxlength='255' value='' title='' type='text'></td></tr>

</table>
	<hr>
 			<div id='error'></div>
<center> 			<input type='button' value='Guardar los cambios' 
 								onClick=\"xajax_crear_editar_suscriptores(xajax.getFormValues('perfil'),'inicio')\"/> </center>
</form>
				</div>
			</div>
					";

			echo "</div>";
//																				}/// fin sino se ha grabado el especilistas
//																		else {echo "hola";}
																				
														}			
														*/												
																///// fin del elseif de especialista
/*
if(!isset($_SESSION[sucursal])){
if($_SESSION[grupo]=='2'){echo "<div align='center' style=' width: 50%; align:center'><img src='images/atencion.gif' alt='[!]'> <h1>Bienvenido al sistema de información <b>GaleNUx.com</b> el uso de la información a la que tendrá acceso es de carácter informativo, es su responsabilidad y no implica responsabilidad alguna ni constituye comunicación oficial de la institución.   
<a onclick=\"xajax_parametrizacion_editar_sucursal('8','establecer','capa_sucursal','1')\" size='1' style='width:250'> [ ENTRAR ] <a href='includes/salir.php' title='Salir y cerrar la sesión'>[ SALIR ]</h1>

  </div>
  <div id='capa_sucursal' name='capa_sucursal'></div>";}
else{
echo "<div align='center'><img src='images/atencion.gif'> No se ha definido una sucursal o área de servicio </div>";
echo "<div align='center'><a onclick=\"xajax_parametrizacion_editar_sucursal(this.value,'select','capa_sucursal','1')\">
<h2>Definir sucursal o área de servicio</h2></a>
<div id='capa_sucursal' name='capa_sucursal'></div></div>
		";
		}
												}
else{
//include("includes/menu_horizontal.php"); 
*/
?>
        <div>
  <b class='caja_externa'>
  <b class='caja_externa1'><b></b></b>
  <b class='caja_externa2'><b></b></b>  
   <b class='caja_externa3'></b>
  <b class='caja_externa4'></b>
  <b class='caja_externa5'></b></b>

  <div class='caja_externafg'>   	

 	</td>
 
 </tr>
  <tr>
   <td style=" text-align: left; vertical-align: top; width: 150;" >
        <table style=" width: 100%;  text-align: left; vertical-align: top; " border="0" cellpadding="0" cellspacing="0">
        <tr>
        	<td><img src="images/logo.jpg"  border="0" alt="GaleNUx-praxis">
<?php
include ("includes/menu.php");
echo "</td></tr></table>
            
         </td>                 
                <td  style='background:#c2f0e5; ' valign='top'>
								&nbsp;</td>           
          <td  style='background:#c2f0e5; '  valign='top'>
         <font size='-3'> &nbsp;</font>
     			<div >
  <b class='caja_principal'>
  <b class='caja_principal1'><b></b></b>
  <b class='caja_principal2'><b></b></b>
  <b class='caja_principal3'></b>
  <b class='caja_principal4'></b>
  <b class='caja_principal5'></b></b>

  <div class='caja_principalfg'>
          <table  valign='top' style='width: 98%; align: center;' HEIGHT='500' border='0' cellpadding='0' cellspacing='0' align='center'>
           <tr>
           	<td style=' vertical-align: ' top; valign='top' title='Ubique el mouse o cursor sobre un campo para recibir ayuda'>



          ";
 if ( isset ( $_REQUEST['page'] ) )  
					{$page=$_REQUEST['page']; include_once("$page/$page.php");} 
					else {include_once("servicio_cliente/servicio_cliente.php");}
			

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
