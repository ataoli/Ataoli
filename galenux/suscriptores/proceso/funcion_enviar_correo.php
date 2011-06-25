<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../includes/error.php");
// echo "hola mundo2";
} 
include("../../librerias/conex.php");
$link=Conectarse();
$hora=(Date("YmdHis"));
$id=$_REQUEST['id'];
$referencia=$_REQUEST['referencia'];
$funcionario = $_REQUEST['funcionario'];
$encabezado="";
header('Content-Type: text/html; charset=UTF-8');
$correo_destinatario = $_POST['mail_destino'];
$asunto_correo = $encabezado.$_POST['asunto_correo'];
$cuerpo_correo = $_POST['cuerpo_correo'];
$correo_funcionario = $_POST['mail_funcionario'];
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: GaleNUx < praxis@galenux.com >\r\n";
$headers .= "Cc: <$correo_funcionario>\r\n"; 
$headers .= "Reply-To: <$correo_funcionario>\r\n";
mysql_query("
INSERT INTO `servicio_cliente` (
`id_servicio_cliente` ,
`fecha_inicio` ,
`fecha_cierre` ,
`asunto` ,
`descripcion` ,
`id` ,
`funcionario` ,
`tipo` ,
`cerrado` ,
`referente`
)
VALUES (
NULL , '$hora', NULL , '$asunto_correo', 'Enviado a: $correo_destinatario Desde: $correo_funcionario -- $cuerpo_correo','$id', '$funcionario', 'email', '', '$referencia'
)",$link);

if ($correo_destinatario == ""){
	echo "<p align=center>Debido a que el suscriptor no posee correo registrado, este correo ser&aacute; guardado en la base de datos y enviada copia a usted.</p>";	
}
elseif ($correo_funcionario== ""){
	echo "<p align=center>Usted no ha registrado correo alguno. Este correo ser&aacute; guardado en la base de datos y enviado al usuario pero no llegar&aacute; copia a usted.</p>";	
}
elseif ($correo_funcionario == $correo_destinatario){
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: GaleNUx < praxis@galenux.com >\r\n";
$headers .= "Reply-To: <$correo_funcionario>\r\n";
}
mail($correo_destinatario,$asunto_correo,$cuerpo_correo,$headers);
?>
<p align=center>El correo fue enviado satisfactoriamente</p>

<script>
function cerrar(){
opener.actualizar();
window.close()
}
</script>

<p align=center><button name='button' onclick=cerrar(); type='submit' TITLE='Pulse para Continuar' value='Actualizar'>CERRAR</button></p>
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