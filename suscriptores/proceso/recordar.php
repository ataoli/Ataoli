<?php 
session_start();
if ( !isset ( $_SESSION['grupo'] ) ) {
 header("Location: ../includes/error.php");
}

$accion=$_POST['accion'];

if ($accion == "editar"){
$id=$_POST['id'];
include_once("../../librerias/conex.php");
$link=Conectarse(); 
$datos_suscriptor = mysql_query("SELECT * FROM users WHERE id = $id LIMIT 1", $link);
$row = mysql_fetch_row($datos_suscriptor);
include_once("../../includes/correos.php");
datos_editar_usuario($row);
}
else{
$mail=$_POST['mail'];
$usuario=$_POST['usuario'];
$password=$_POST['password'];

include_once("../../includes/correos.php");
datos_nuevo_usuario($usuario, $mail, $password);
}
?>
<script>
opener.actualizar();
window.close()
</script>



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