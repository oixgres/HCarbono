<?php

include "dataBaseLogin.php";

$connection = mysqli_connect($host, $user, $password, $bd);

if ($connection)
{
  $name = $_POST["name"];
  $company = $_POST["company"];
  $city = $_POST["city"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];

  if(!empty($name) || !empty($company) || !empty($city) || !empty($email) || !empty($phone))
  {
    /*Verificamos que no se repita la empresa*/
    $query = "SELECT * FROM Empresa WHERE Nombre = '".$company."'";
    $res_query = mysqli_connect($connection, $query);
    $nr = mysqli_num_rows($res_query);

    /*Si no existe la empresa la registramos*/
    if($nr == 0)
    {
      /*Registramos compañia*/
      $query = "INSERT INTO Empresa(Nombre) VALUES ('$company')";
      mysqli_query($connection, $query);
    }

    /*Obtenemos el ID de la compañia */
    $query = "SELECT idEmpresa FROM Empresa WHERE Nombre = '".$company."'";
    $res_query = mysqli_query($connection, $query);
    $res_query = $res_query->fetch_array();
    $id_company = intval($res_query[0]);

    /*Registramos al usuario*/
    $query = "INSERT INTO Usuario(Nombre, Ciudad, Correo, Telefono, Empresa_idEmpresa) VALUES ('$name', '$city', '$email', '$phone', '$id_company')";
    mysqli_query($connection, $query);


    echo "Registro completo";
  }
  else
  {
    echo "Rellena todos los campos";
  }
}
else
{
  echo "No se logro conectar al servidor";
}


?>
