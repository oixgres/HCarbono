<?php 
require_once 'dataBaseLogin.php';
require_once 'phpFunctions.php';

/* Numero telefonico o mensaje */
$identifier = $_POST['mail'];

/* Checamos si existe correo */
$query = "SELECT * FROM Usuario WHERE Correo='$identifier'";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) > 0)
{
  $username = getFirstQueryElement(
    $connection,
    'Usuario',
    'Username',
    'Correo',
    $identifier
  );
  
  $password = getFirstQueryElement(
    $connection,
    'Usuario',
    'Password',
    'Correo',
    $identifier
  );
  
  /* Mensaje de reenvio de datos al usuario */
  $message="Saludos desde H.Carbono!!"."\n\r";
  $message.="Se ha solicitado el reenvio de su usuario y contraseña."."\n\r";
  $message.="Su usuario es: $username"."\n"."Su contraseña es: $password";
  sendMail($identifier, "Recuperación de contraseña hcarbono", $message);

  echo json_encode(array(
    'result' => true,
    'message' => "Sus datos han sido enviados con exito al correo ".$identifier
  ));
}
else
{
  echo json_encode(array(
    'message' => "No existe ningun usuario registrado con el correo ".$identifier
  ));
}
?>