<?php

require_once "dataBaseLogin.php";
require_once "phpFunctions.php";

$name = $_POST["name"];
$company = $_POST["company"];
$city = $_POST["city"];
$email = $_POST["email"];
$phone = $_POST["phone"];

/* Verificamos que el correo no se encuentre ya registrado */
$checkmail = mysqli_query($connection, "SELECT * FROM Usuario WHERE Correo='".$email."'");

if(mysqli_num_rows($checkmail) == 0)
{
  /*Verificamos que no se repita la empresa*/
  $query = mysqli_query($connection, "SELECT * FROM Empresa WHERE Nombre='".$company."'");
  $nr = mysqli_num_rows($query);

  /*Si no existe la empresa la registramos*/
  if($nr == 0)
    mysqli_query($connection, "INSERT INTO Empresa(Nombre) VALUES ('$company')");

  /* Obtenemos el ID de la compañia */
  $id_company = getFirstQueryElement($connection, "Empresa", "idEmpresa", "Nombre", $company);

  /* Registramos al usuario */
  $query = "INSERT INTO Usuario(Nombre, Ciudad, Correo, Telefono, Empresa_idEmpresa) VALUES ('$name', '$city', '$email', '$phone', '$id_company')";
  mysqli_query($connection, $query);

  /* Obtenemos el id del Usuario */
  $id_user = getFirstQueryElement($connection, "Usuario", "idUsuario", "Correo", $email);

  /* Registramos el dispositivo */
  $query = "INSERT INTO Dispositivo(Codigo,Usuario_idUsuario) VALUES (NULL, '$id_user')";
  mysqli_query($connection, $query);

  echo 'registerResult.html';
}
else
{
  echo 'CORREO UTILIZADO';
}
?>
