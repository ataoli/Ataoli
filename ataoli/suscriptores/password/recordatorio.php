<?
function enviarmail($correo_mail, $id_mail, $ip_mail, $gHsiw12){
$destinatario = "$correo_mail";
$asunto ="Recordatorio datos de su cuenta en El Malpensante";
$cuerpo = '
<html>
<body>
<p align=left><strong><strong>Ha solicitado el cambio de contraseña, y se ha realizado el cambio, a continuacion encontrara la informacion de acceso al sistema:</strong><br>
<br>
</strong>ID de usuario: '.$id_mail.'</p>
</strong>Codigo de seguridad: '.$gHsiw12.'</p>

<p>Hemos recibido la notificacion de recordatorio de clave de acceso a El Malpensante, esta solicitud fue realizada desde la direccion IP '.$ip_mail.', si ha sido usted quien solicito este recordatorio recuerde el ID de usuario y haga clic en el siguiente enlace:</p>

</strong>Codigo recordatorio: <a href="http://elmalpensante.net/jeffton/suscriptores/password/cambiar_password.php?gHsiw='.$gHsiw12.'">
http://elmalpensante.net/jeffton/suscriptores/password/cambiar_password.php?gHsiw='.$gHsiw12.'</a></p><br>

<br /><br />
Atentamente,
<p>El Malpensante<br>

</body>
</html>

';

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: Amigos de El Malpensante <amigos@elmalpensante.net>\r\n";
mail($destinatario,$asunto,$cuerpo,$headers);
}

function datos_nuevo_usuario($usuario_mail, $correo_mail, $password_mail){

$destinatario = "$correo_mail";
$asunto ="Datos de su cuenta en El Malpensante";
$cuerpo = '
<html>
<body>
<p align=left><strong><strong>Ha sido creada su cuenta de usuario en El Malpensante. A continuacion, encontrara los datos necesarios para que pueda iniciar sesion en <a href="http://elmalpensante.net">El Malpensante</a></strong><br>
<br>
<strong>Usuario</strong>: '.$usuario_mail.'<br>
<strong>Clave o password</strong>: '.$password_mail.'<br>
<br />
Atentamente,
<p>El Malpensante<br>

</body>
</html>
';
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: Amigos de El Malpensante <amigos@elmalpensante.net>\r\n";
mail($destinatario,$asunto,$cuerpo,$headers);
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