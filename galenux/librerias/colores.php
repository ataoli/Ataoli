<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Elegir colores</title>
<script language="JavaScript">
function actualizaPadre(miColor){
	window.opener.document.bgColor = miColor
	window.opener.colorin.bgColor = miColor
	window.opener.document.getElementById('color').value = miColor
	window.close()
	
}
function SoloCerrar(){
window.close()
}
</script>
    <link href="../estilos/estilo.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#ffffff" link=000000 alink=000000 vlink=000000>

<table width="80%" align="center" cellpadding="1" cellspacing="1"> 
<script language="javascript">
var r = new Array("99","CC","FF");
var g = new Array("99","CC","FF");
var b = new Array("99","CC","FF");
for (i=0;i<r.length;i++) 
	for (j=0;j<g.length;j++) {
		document.write("<tr>");
		for (k=0;k<b.length;k++) {
			var nuevoc = "" + r[i] + g[j] + b[k];
			document.write("<td bgcolor=\"" + nuevoc + "\" align=center><font size=1 face=verdana>");
			document.write("<a href=\"javascript:actualizaPadre('" + nuevoc + "')\">");
			document.write(nuevoc);
		}
		document.write("</a></font></tr>");
	}
</script>
</table>
<center><hr><a href="javascript:SoloCerrar()">cerrar (X) </a></center>
</body>
</html>
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