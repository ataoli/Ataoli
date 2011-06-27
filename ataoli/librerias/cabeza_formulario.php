<?php
//incluímos la clase ajax
require ('../../../xajax/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();

require ('../../includes/mundo_XAJAX.php');

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequests();

?>
<html xmlns="http://www.w3.org/1999/xhtml"xml:lang="es" lang="es" dir="ltr">
<head>


 <?php $xajax->printJavascript("../../../xajax/");  ?>



  <title><?php echo "$empresa $aplicacion $page $usuario"; ?></title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="../../estilos/estilo.css" rel="stylesheet" type="text/css">
  <link rel="SHORTCUT ICON" href="../../icono.ico">
  <script>
var nav4 = window.Event ? true : false;
function acceptNum(evt){	
var key = nav4 ? evt.which : evt.keyCode;	
return (key <= 13 || (key >= 48 && key <= 57));
}

function Verificar()  {
    if (document.forms[0].p_nombre.value==""){
    alert("Ingrese el primer nombre del suscriptor")
    document.forms[0].p_nombre.focus();
    return false;
  }
    else if (document.forms[0].p_apellido.value==""){
    alert("Ingrese el primer apellido del suscriptor")
    document.forms[0].p_apellido.focus();
    return false;
  }
    else if (document.forms[0].documento_numero.value==""){
    alert("Ingrese el numero de documento")
    document.forms[0].documento_numero.focus();
    return false;
  }
    else if (document.forms[0].documento_numero2.value==""){
    alert("Ingrese la rectificacion del numero de documento")
    document.forms[0].documento_numero2.focus();
    return false;
  }

    documento1 = document.forms[0].documento_numero.value
    documento2 = document.forms[0].documento_numero2.value
    if (documento1 != documento2){
       alert("Los dos documentos ingresados son distintos, favor corregirlos de nuevo")
       document.forms[0].documento_numero2.focus();
       return false;
    }

    email1 = document.forms[0].email.value
    email2 = document.forms[0].email_2.value
    if (email1 != email2){       
       alert("Los dos correos ingresados no son iguales, favor corregirlos de nuevo")
       document.forms[0].email_2.focus();
       return false;
    }
}

function SoloCerrar(){
window.close()
}      
</script>
  
  </head>

<body >

					

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
