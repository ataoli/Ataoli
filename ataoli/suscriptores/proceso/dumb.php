<?
include_once("../../librerias/conex.php");	
$link=Conectarse();

 for ($i=0;$i<1;$i++){
mysql_query("INSERT INTO `users` ( `id` , `username` , `passwd` , `id_grupo` , `email` , `entkey` , `rank` , `adddate` , `status` , `lastip` , `lastdate` , `p_nombre` , `s_nombre` , `p_apellido` , `s_apellido` ,`nombre_completo` , `fecha_nacimiento` , `documento_tipo` , `documento_numero` , `direccion` , `barrio` , `ciudad` , `departamento` , `estado` , `pais` , `ciudad_extranjero` , `genero` , `estado_civil` , `escolaridad` , `titulo_profesional` , `ocupacion` , `cargo` , `empresa` , `telefono_celular` , `telefono_fijo` ,`telefono_fijo_1` ,`fax` ,`web` , `telefono_VoIP` , `fotografia` , `fotografia_tipo_archivo` , `presentacion` , `compartir_informacion` , `enviar_correo_editorial` )
VALUES ( NULL , 'casparop' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' ,'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' ,'NULL' ,'NULL' ,'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' , 'NULL' )",$link);
echo mysql_error();
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