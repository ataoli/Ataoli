<?php 
// Motor autentificaci�n usuarios.

// Cargar datos conexion y otras variables.
require ("config.php");


// chequear p�gina que lo llama para devolver errores a dicha p�gina.

$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
// chequear si se llama directo al script.
if ($_SERVER['HTTP_REFERER'] == ""){header ("Location: index.php");
exit;
}


// Chequeamos si se est� autentificandose un usuario por medio del formulario
if (isset($_POST['user']) && isset($_POST['pass'])) {

// Conexi�n base de datos.
// si no se puede conectar a la BD salimos del scrip con error 0 y
// redireccionamos a la pagina de error.
$db_conexion= mysql_connect("$Servidor", "$Usuario", "$Password") or die(header ("Location:  $redir?error_login=0"));
mysql_select_db("$BaseDeDatos");

// realizamos la consulta a la BD para chequear datos del Usuario.
$usuario_consulta = mysql_query("SELECT * FROM $sql_tabla WHERE User_Name='".$_POST['user']."'") or die(header ("Location:  $redir?error_login=1"));

 // miramos el total de resultado de la consulta (si es distinto de 0 es que existe el usuario)
 if (mysql_num_rows($usuario_consulta) != 0) {

    // eliminamos barras invertidas y dobles en sencillas
    $login = stripslashes($_POST['user']);
    // encriptamos el password en formato md5 irreversible.
     $password = md5($_POST['pass']);
    //$password = $_POST['pass'];

    // almacenamos datos del Usuario en un array para empezar a chequear.
 	$usuario_datos = mysql_fetch_array($usuario_consulta);
  
    // liberamos la memoria usada por la consulta, ya que tenemos estos datos en el Array.
    mysql_free_result($usuario_consulta);
    // cerramos la Base de dtos.
    mysql_close($db_conexion);
    
    // chequeamos el nombre del usuario otra vez contrastandolo con la BD
    // esta vez sin barras invertidas, etc ...
    // si no es correcto, salimos del script con error 4 y redireccionamos a la
    // p�gina de error.
    if ($login != $usuario_datos['User_Name']) {
       	Header ("Location: $redir?error_login=4");
		exit;}

    // si el password no es correcto ..
    // salimos del script con error 3 y redireccinamos hacia la p�gina de error
    if ($password != $usuario_datos['Password']) {
        Header ("Location: $redir?error_login=3");
	    exit;}

    // Paranoia: destruimos las variables login y password usadas
    unset($login);
    unset ($password);

    // En este punto, el usuario ya esta validado.
    // Grabamos los datos del usuario en una sesion.
    
     // le damos un Nobre a la sesion.
    session_name($usuarios_sesion);
     // incia sessiones
    session_start();

    // Paranoia: decimos al navegador que no "cachee" esta p�gina.
    session_cache_limiter('nocache,private');
    
    // Asignamos variables de sesi�n con datos del Usuario para el uso en el
    // resto de p�ginas autentificadas.

    // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
    $_SESSION['usuario_id']=$usuario_datos['ID_Funcionario'];
    
    // definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_nivel']=$usuario_datos['Nivel_Acceso'];
    
    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_login']=$usuario_datos['User_Name'];
    $_SESSION['Funcionario']=$usuario_datos['User_Name'];

    //definimos usuario_password con el password del usuario de la sesi�n actual (formato md5 encriptado)
    $_SESSION['Primer_Nombre_Funcionario']=$usuario_datos['Primer_Nombre_Funcionario'];
	$_SESSION['Segundo_Nombre_Funcionario']=$usuario_datos['Segundo_Nombre_Funcionario'];
	$_SESSION['Primer_Apellido_Funcionario']=$usuario_datos['Primer_Apellido_Funcionario'];
	$_SESSION['Segundo_Apellido_Funcionario']=$usuario_datos['Segundo_Apellido_Funcionario'];
$_SESSION['Especialidad_Funcionario']=$usuario_datos['Especialidad_Funcionario'];
$_SESSION['Universidad']=$usuario_datos['Universidad'];
    $_SESSION['usuario_password']=$usuario_datos['Password']; 
    $_SESSION['grupo']=$usuario_datos['Grupo'];
    $_SESSION['usuario']=$usuario_datos['User_Name'];
    $_SESSION['Slogan']=$usuario_datos['Slogan'];
    
    
    $_SESSION['descripcion_funcionario']=$usuario_datos['Primer_Nombre']." ".$usuario_datos['Primer_Apellido']."  ".$usuario_datos['Segundo_Apellido']." / ".$usuario_datos['Especialidad'];


    // Hacemos una llamada a si mismo (scritp) para que queden disponibles
    // las variables de session en el array asociado $HTTP_...
    $pag=$_SERVER['PHP_SELF'];
    Header ("Location: $pag?");
    exit;
    
   } else {
      // si no esta el nombre de usuario en la BD o el password ..
      // se devuelve a pagina q lo llamo con error
      Header ("Location: $redir?error_login=2");
      exit;}
} else {

// -------- Chequear sesi�n existe -------

// usamos la sesion de nombre definido.
session_name($usuarios_sesion);
// Iniciamos el uso de sesiones
@session_start();

// Chequeamos si estan creadas las variables de sesi�n de identificaci�n del usuario,
// El caso mas comun es el de una vez "matado" la sesion se intenta volver hacia atras
// con el navegador.

if (!isset($_SESSION['usuario_login']) && !isset($_SESSION['usuario_password'])){
// Borramos la sesion creada por el inicio de session anterior
session_destroy();
die ("Error cod.: 2 - Acceso incorrecto!");
exit;
}
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