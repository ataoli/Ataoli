<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../error.php");

} 
?>
<div id="usuarios_contenedor">
<div id="usuario_crear">
<li onclick="xajax_crear_usuario('usuarios_presentacion')" class="cursor">Crear usuario</li>
</div>
<div id="usuarios_buscador">
</div>
<div id="usuarios_presentacion"></div>

</div>