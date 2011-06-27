<?php
function registrar_acceso($id){
$lastdate = date('Y-m-d g:i:s');
include_once("obtener_ip.php");
$lastip = obtener_ip();
foreach($_SERVER as $valores)
  {
   $servidor .= $valores."\n";
  }
$ip_publica = $_SERVER['REMOTE_ADDR'];
include("../librerias/conex.php");
$link=Conectarse();
mysql_query("UPDATE `d9_users` SET  `lastip`='$lastip', `lastdate`='$lastdate' WHERE `d9_users`.`id` = $id ",$link);
mysql_query("INSERT INTO `usuario_log` (`id_log_acceso`, `id_usuario`, `hora_acceso`, `ip_local`, `ip_publica`, `info_servidor`) VALUES (NULL, '$id', '$lastdate', '$lastip', '$ip_publica', '$servidor')",$link);
echo mysql_error();
}
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
