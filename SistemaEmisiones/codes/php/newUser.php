<?php

require_once "dataBaseLogin.php";
require_once "phpFunctions.php";

if ($connection)
{
  $name = $_POST["name"];
  $company = $_POST["company"];
  $city = $_POST["city"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $device = $_POST["device"];

  /* Verificamos que el correo no se encuentre ya registrado */
  $checkmail = mysqli_query($connection, "SELECT * FROM Usuario WHERE Correo='".$email."'");

  if(mysqli_num_rows($connection, $checkmail) > 0)
  {

    /*Verificamos que no se repita la empresa*/
    $query = mysqli_query($connection, "SELECT * FROM Empresa WHERE Nombre='".$company."'");
    $nr = mysqli_num_rows($query);

    /*Si no existe la empresa la registramos*/
    if($nr == 0)
      mysqli_query($connection, "INSERT INTO Empresa(Nombre) VALUES ('$company')");

    /* Obtenemos el ID de la compañia */
    /*
    $query = "SELECT idEmpresa FROM Empresa WHERE Nombre = '".$company."'";
    $res_query = mysqli_query($connection, $query);
    $res_query = $res_query->fetch_array();
    $id_company = intval($res_query[0]);
    */
    $id_company = getFirstQueryElement($connection, "Empresa", "idEmpresa", "Nombre", $company);

    /* Registramos al usuario */
    $query = "INSERT INTO Usuario(Nombre, Ciudad, Correo, Telefono, Empresa_idEmpresa) VALUES ('$name', '$city', '$email', '$phone', '$id_company')";
    mysqli_query($connection, $query);

    /* Obtenemos el id del Usuario */
    $id_user = getFirstQueryElement($connection, "Usuario", "idUsuario", "Correo", $email);

    /* Registramos el dispositivo */
    $query = "INSERT INTO Dispositivo(Nombre,Usuario_idUsuario) VALUES ('$device', '$id_user')";

    header("Location: ../html/registerResult.html");
    exit();
  }
}
else
{
  echo "No se logro conectar al servidor";
}

?>
