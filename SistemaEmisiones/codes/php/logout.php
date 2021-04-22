<?php
session_start();
session_destroy();

/*  Eliminamos el contenido de las cookies */
setcookie("token", "",time()-1, "/");
setcookie("idUsuario", "", time()-1,"/");
setcookie("Nombre", "", time()-1,"/");
setcookie("Correo", "", time()-1,"/");

header("location: ../../index.html");
exit();
?>
