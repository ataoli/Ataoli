<?PHP session_start();
$error=$_SESSION['error'];
header('Content-Type: text/html; charset=UTF-8');

if ($_SESSION['prioridad'] < "3"){} 
else { 


}
if (isset($_REQUEST['ID'])) {echo "<script language='JavaScript' src='../../librerias/gen_validatorv2.js' type='text/javascript'></script>";}
?>
 <html><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Seleccionar suscriptor</title>  

<link href="../../estilos/estilo.css" rel="stylesheet" type="text/css">
<script>


function SoloCerrar(){
window.close()
}

function validar(){
 if (document.buscar.apellido_suscriptor.value == ""){
    alert("Ingrese el nombre, apellido y numero de documento de quien desea buscar")
    document.buscar.apellido_suscriptor.focus();
    return false;
  }
}

var nav4 = window.Event ? true : false;
function acceptNum(evt){	
var key = nav4 ? evt.which : evt.keyCode;	
return (key == 13 || key == 8 || key == 32 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122));
}

function retornar_ID(id){
	window.opener.document.buscador.elements[0].value = id
}
</script>
</head><?
if ($error == 1){
echo "<body onload=\"javascript:resizeTo(500,200)\">";}else
{
?>
<body onload="javascript:resizeTo(500,200), document.buscar.apellido_suscriptor.focus();" >

<?
}
?>
<table border='0' widht=100% align='center' >
<tr><td>


<fieldset>
      <legend align='right'><font color='green' size='+2'><b>Buscar Usuario</b></font></legend>
<?
if ($error == 1){
		echo "<h2>No hay Usuarios con esos datos, intentelo nuevamente</h2>";
		$_SESSION['error']=0;
}
?>
	<table align=center border=0>
		<tr>
			<td>
			</td>
			<td>Nombre, apellido o documento:<br>
				<form name='buscar' method=POST action='mostrar_usuario.php' ENCTYPE='multipart/form-data' onsubmit="return validar(this.form)">
				<input type='text' name='apellido_suscriptor' size="32" maxlength="32" onKeyPress="return acceptNum(event)"> 
				<input type='submit' name='button' TITLE='Pulse para Continuar'   value='Buscar'>
				</form>
			</td>
		</tr>
		<tr>
			<td colspan='2' align='center'>
				<input type='submit' name='button' onclick=SoloCerrar(); type='submit' TITLE='Cerrar esta ventana'   value='Cerrar esta ventana'>
    		</td>
    	</tr>
	
	</table> 

 </fieldset>
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