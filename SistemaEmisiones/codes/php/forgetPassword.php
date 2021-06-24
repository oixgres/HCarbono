<?php 

require_once 'dataBaseLogin.php';
require_once 'phpFunctions.php';

/* Numero telefonico o mensaje */
$identifier = $_POST['forget-id'];

/* Checamos si  es correo */
$query = "SELECT * FROM Usuario WHERE Correo='$identifier'";

if(mysqli_query($connection, $query))
{
  $username = getFirstQueryElement($connection, 'Usuario', 'Username', 'Correo', $identifier);
  $password = getFirstQueryElement($connection, 'Usuario', 'Password', 'Correo', $identifier);
}
else
{
  /* Checamos si es telefono */
  $query = "SELECT * FROM Usuario WHERE Telefono='$identifier'";

  if(mysqli_query($connection, $query)){
    $username = getFirstQueryElement($connection, 'Usuario', 'Username','Telefono', $identifier);
    $password = getFirstQueryElement($connection, 'Usuario','Password', 'Telefono', $identifier);
  }
}

?>