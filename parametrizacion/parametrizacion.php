<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: error.php");
// echo "hola mundo2";
} 
if($_SESSION['grupo']=='1'){
echo "<h1>Parametrizaci&oacute;n de datos GaleNUx</h1>
<li><a onclick=\"xajax_parametrizacion_editar_sucursal('','','capa_sucursal','')\">Sucursales o áreas de servicio</a></li>
<div id='capa_sucursal' name='capa_sucursal'></div>
<li><a onclick=\"xajax_parametrizacion_tipo_consulta('consultar_listado','capa_tipo_consulta','')\">Parametrizar tipos de consulta</a></li>
<div id='capa_tipo_consulta' name='capa_tipo_consulta'></div>
<li><a  onClick=\"xajax_importar_dgh('capa_subir_contratos','','')\">Importar Usuarios DHG</a></li>
		<div id='capa_subir_contratos' name='capa_subir_contratos'></div>
<li><a  onClick=\"xajax_parametrizacion_medicamentos('','','capa_parametrizar_medicamentos')\">Edición de medicamentos</a></li>
		<div id='capa_parametrizar_medicamentos' name='capa_parametrizar_medicamentos'></div>
<li><a  onClick=\"xajax_parametrizacion_otros_nopos('','','capa_parametrizar_otros_nopos')\">Parametrizar otros no pos</a></li>
		<div id='capa_parametrizar_otros_nopos' name='capa_parametrizar_otros_nopos'></div>

";		
		}

		/*
include_once("parametrizacion/grupos.php");
include_once("parametrizacion/tipo_usuario.php");
include_once("parametrizacion/escolaridad.php");
include_once("parametrizacion/tipo_documento_id.php");
include_once("parametrizacion/estado_civil.php");
include_once("parametrizacion/tipo_orden.php");
include_once("parametrizacion/plan_beneficio.php");

include_once("parametrizacion/ayuda_clases.php");
*/
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