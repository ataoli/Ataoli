<?php
function enviarmail($correo_mail, $id_mail, $ip_mail, $gHsiw12, $usuario){
include_once("datos.php");
$destinatario = "$correo_mail";
$asunto ="Recordatorio datos de su cuenta en $aplicacion";
$cuerpo = '
<html>
<body>
<p align=left><strong><strong>Ha solicitado el cambio de contraseña, y se ha realizado el cambio, a continuacion encontrara la informacion de acceso al sistema:</strong><br>
<br>
</strong>ID de usuario: '.$id_mail.'</p>
</strong>Usuario: '.$usuario.'</p>
</strong>Codigo de seguridad: '.$gHsiw12.'</p>

<p>Hemos recibido la notificacion de recordatorio de clave de acceso a '.$aplicacion.', esta solicitud fue realizada desde la direccion IP '.$ip_mail.', si ha sido usted quien solicito este recordatorio recuerde el ID de usuario y haga clic en el siguiente enlace:</p>

</strong>Codigo recordatorio: <a href="'.$url_aplicacion.'/suscriptores/password/cambiar_password.php?gHsiw='.$gHsiw12.'">
'.$url_aplicacion.'/suscriptores/password/cambiar_password.php?gHsiw='.$gHsiw12.'</a></p><br>

<br /><br />
Atentamente,
<p>'.$empresa.'<br>

</body>
</html>

';

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: ".$empresa." <".$correo_corporativo.">\r\n";
mail($destinatario,$asunto,$cuerpo,$headers);
}

function datos_nuevo_usuario($usuario_mail, $correo_mail, $password_mail){
include_once("datos.php");
$destinatario = "$correo_mail";
$asunto ="Datos de su cuenta en $empresa";
$cuerpo = '
<html>
<body>
<p align=left><strong><strong>Ha sido creada su cuenta de usuario en '.$cliente.'. A continuacion, encontrara los datos necesarios para que pueda iniciar sesion en <a href="'.$url_aplicacion.'">'.cliente.'</a></strong><br>
<br>
<strong>Usuario</strong>: '.$usuario_mail.'<br>
<strong>Clave o password</strong>: '.$password_mail.'<br>
<br />
Atentamente,
<p>'.$empresa.'<br>

</body>
</html>
';
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: ".$cliente." <$correo_corporativo>\r\n";
mail($destinatario,$asunto,$cuerpo,$headers);
}


function datos_editar_usuario($datos_editar_usuario){
include_once("datos.php");

$destinatario = $datos_editar_usuario["4"];
$asunto ="Se han actualizado los datos de su cuenta en $cliente";
$cuerpo = '
<html>
<body>
<p align=left><strong>Han sido editados los datos de su cuenta de usuario en '.$revista.'. A continuacion, encontrara 
los datos actuales de su cuenta en <a href="'.$url_aplicacion.'">'.$revista.'</a></strong><br>
<br>
<ul>
<li><strong>ID de suscriptor: </strong>'.$datos_editar_usuario[0].'</li>
<li><strong>Nombre de usuario: </strong>'.$datos_editar_usuario[1].'</li>
<li><strong>Nombre Completo: </strong>'.$datos_editar_usuario[15].'</li>
<li><strong>Numero de documento: </strong>'.$datos_editar_usuario[18].'</li>
<li><strong>Email: </strong>'.$datos_editar_usuario[4].'</li>
<li><strong>Pais: </strong>'.$datos_editar_usuario[25].'</li>
<li><strong>Departamento/Estado: </strong>'.$datos_editar_usuario[23].'</li>
<li><strong>Municipio: </strong>'.$datos_editar_usuario[22].'</li>
<li><strong>Direccion: </strong>'.$datos_editar_usuario[19].'</li>
<li><strong>Telefono Fijo 1: </strong>'.$datos_editar_usuario[35].'</li>
<li><strong>Telefono Movil: </strong>'.$datos_editar_usuario[34].'</li>
</ul>

<p>En caso de estar incorrectos estos datos o de desear llenar sus datos adicionales, ingrese a <a href="'.$url_aplicacion.'">'.$revista.'</a></p>
<br />
Atentamente,
<p>'.$empresa.'<br>

</body>
</html>
';
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: ".$empresa." <$correo_corporativo>\r\n";

mail($destinatario,$asunto,$cuerpo,$headers);
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