<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 

$usuario=$_SESSION['usuario'];
include("../../librerias/cabeza_formulario.php");

include_once("../../librerias/conex.php");
$link=Conectarse();
$id = $_REQUEST['id'];
if ($id !=""){ 
mysql_query("SET NAMES 'utf8'");
$Usuario_Datos=mysql_query("SELECT * FROM users  WHERE  (id =  '$id')",$link); 
$num=mysql_num_rows($Usuario_Datos);
if (mysql_num_rows($Usuario_Datos)!=0){
$i=0;
$id=mysql_result($Usuario_Datos,$i,"id");  
$id_grupo=mysql_result($Usuario_Datos,$i,"id_grupo");       
$nombre_completo=mysql_result($Usuario_Datos,$i,"nombre_completo");   

$id_cliente=mysql_result($Usuario_Datos,$i,"id_cliente");
$plan_beneficios=mysql_result($Usuario_Datos,$i,"plan_beneficios");
$tipo_usuario=mysql_result($Usuario_Datos,$i,"tipo_usuario");
$documento_numero=mysql_result($Usuario_Datos,$i,"documento_numero");      
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
$responsable_nombre=mysql_result($Usuario_Datos,$i,"responsable_nombre");
$responsable_direccion=mysql_result($Usuario_Datos,$i,"responsable_direccion");
$responsable_telefono=mysql_result($Usuario_Datos,$i,"responsable_telefono");

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
$seguridad = "llamando_form";
}}

?>

		<?php  $formulario = "editar_usuario";  $accion = "editar";  ?>
		<form name="<? echo $formulario; ?>" id="<? echo $formulario; ?>" method="post" action='../proceso/usuarios_crear.php' onsubmit="return Verificar(this.form)">		
		<input type='hidden' name='accion' value='<? echo $accion; ?>'>
		<input type='hidden' name='id' value='<?php echo $id; ?>'>
		<?php include_once("formulario.php");?>
		</body></html><?php
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