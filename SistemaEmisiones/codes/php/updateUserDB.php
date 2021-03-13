<?php
include "dataBaseLogin.php";

$connection = mysqli_connect($host, $user, $password, $bd);

if ($connection)
{
  $id = $_POST['id'];
  $username = $_POST['user'];
  $pass = $_POST['pass'];
  $name = $_POST["name"];
  $company = $_POST["company"];
  $city = $_POST["city"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];

  if(!empty($_POST['admitted']))
    $admitted = "Aprobado";
  else
    $admitted = "No Aprobado";

  /* Verificamos que el username no este registrado*/
  $query = "SELECT * FROM Usuario WHERE Username='".$username."'";
  $query_result = mysqli_query($connection, $query);
  $nru = mysqli_num_rows($query_result) - 1;

  $query = "SELECT * FROM Administrador WHERE Username='".$username."'";
  $query_result = mysqli_query($connection, $query);
  $nru = $nru + mysqli_num_rows($query_result) - 1;

  /* Verificamos que la nueva empresa exista */
  $query = mysqli_query($connection, "SELECT * FROM Empresa WHERE Nombre='".$company."'");
  $nrc = mysqli_num_rows($query);

  if($nru > 0)
  {
    echo "Usuario ya utilizado, ingrese otro";
  }
  else
    if($nrc != 1)
    {
      echo "La compañia no existe";
    }
    else
    {
      /*Obtenemos el ID de la compañia */
      $query = "SELECT idEmpresa FROM Empresa WHERE Nombre = '".$company."'";
      $res_query = mysqli_query($connection, $query);
      $res_query = $res_query->fetch_array();
      $id_company = intval($res_query[0]);

      /*Actualizamos*/
      $query = "UPDATE Usuario SET Username='".$username."', Password='".$pass."', Nombre='".$name."', Ciudad='".$city."', Correo='".$email."', Telefono='".$phone."', Aprobado='".$admitted."', Empresa_idEmpresa='".$id_company."' WHERE idUsuario='".$id."'";
      mysqli_query($connection, $query);

      header("Location: adminPage.php");
      exit();
    }
}
else
{
  echo "No se logro conectar al servidor";
}
 ?>
