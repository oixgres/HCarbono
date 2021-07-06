<?php 

require_once 'dataBaseLogin.php';
require_once 'phpFunctions.php';

/* Numero telefonico o mensaje */
$identifier = $_POST['mail'];

/* Checamos si existe correo */
$query = "SELECT * FROM Usuario WHERE Correo='$identifier'";

if(mysqli_query($connection, $query))
{
  $username = getFirstQueryElement($connection, 'Usuario', 'Username', 'Correo', $identifier);
  $password = getFirstQueryElement($connection, 'Usuario', 'Password', 'Correo', $identifier);
  
  $message = "Saludos desde H.Carbono!!"."\n\r"."Se ha solicitado el reenvio de su usuario y contraseña."."\n\r"."Su usuario es: '$username'"."Su contraseña es: '$password'";

  sendMail($identifier, "Recuperacion de contraseña", $message);

  echo "Sus datos han sido enviados con exito al correo ".$identifier;
}
else
{
  echo "No existe ningun usuario registrado con el correo ".$identifier;
}

?>