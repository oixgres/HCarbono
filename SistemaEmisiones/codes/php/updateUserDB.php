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
  $operation = $_POST["operation"];

  if(!empty($_POST['admitted']))
    $admitted = "Aprobado";
  else
    $admitted = "No Aprobado";

  /*Recuperamos el anterior Username del usuario*/
  $query = mysqli_query($connection, "SELECT Username FROM Usuario WHERE idUsuario='".$id."'");
  $query = $query->fetch_array();
  $selfUser = $query[0];

  /* Verificamos que el username no este registrado*/
  $query = "SELECT * FROM Usuario WHERE Username='".$username."'";
  $query_result = mysqli_query($connection, $query);
  $nru = mysqli_num_rows($query_result);

  $query = "SELECT * FROM Administrador WHERE Username='".$username."'";
  $query_result = mysqli_query($connection, $query);
  $nru = $nru + mysqli_num_rows($query_result);

  /* Verificamos que la nueva empresa exista */
  $query = mysqli_query($connection, "SELECT * FROM Empresa WHERE Nombre='".$company."'");
  $nrc = mysqli_num_rows($query);

  /*Si el username no esta registrado y si es diferente de si mismo*/
  if($nru > 0 && $username != $selfUser)
  {
    echo "Usuario ya utilizado, ingrese otro";
  }
  else
    if ($operation == "Create")
    {
      /*Verificamos que no se repita la empresa*/
      $query = "SELECT * FROM Empresa WHERE Nombre='".$company."'";
      $res_query = mysqli_query($connection, $query);
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

      $query = "INSERT INTO Usuario(Username, Password, Nombre, Ciudad, Correo, Telefono, Aprobado, Empresa_idEmpresa) VALUES ('$username', '$pass', '$name', '$city', '$email', '$phone', '$admitted', '$id_company')";
      mysqli_query($connection, $query);

      header("Location: adminPage.php");
      exit();
    }
    else
      if($nrc != 1)
      {
        echo "La compañia no existe";
      }
      else
        if($operation == "Update")
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
        else
          echo "No se hizo ni papas";
}
else
{
  echo "No se logro conectar al servidor";
}
 ?>
