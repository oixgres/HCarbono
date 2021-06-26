<?php 

require_once 'dataBaseLogin.php';
require_once 'phpFunctions.php';

/* Numero telefonico o mensaje */
$identifier = $_POST['forget-mail'];

/* Checamos si existe correo */
$query = "SELECT * FROM Usuario WHERE Correo='$identifier'";

if(mysqli_query($connection, $query))
{
  $username = getFirstQueryElement($connection, 'Usuario', 'Username', 'Correo', $identifier);
  $password = getFirstQueryElement($connection, 'Usuario', 'Password', 'Correo', $identifier);
  
  $message = "Saludos desde H.Carbono!! \n\n\rSe ha solicitado la recuperación de contraseña. \n\rUsuario='$username'\n\rContraseña='$password'";

  sendMail($identifier, "Recuperacion de contraseña", $message);

  echo "Mensaje enviado con exito al correo ".$identifier;
}
else
{
  echo "No existe ningun usuario registrado con el correo ".$identifier;
}

?>