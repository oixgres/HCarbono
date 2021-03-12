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

//  $query = "UPDATE Usuario SET (Username, Password, Nombre, Ciudad, Correo, Telefono, Aprobado, Empresa_idEmpresa) VALUES('$username','$pass','$name','$city','$email','$phone','$admitted','$company') WHERE idUsuario='".$id."'";
  $query = "UPDATE Usuario SET Username='".$username."', Password='".$pass."', Nombre='".$name."', Ciudad='".$city."', Correo='".$email."', Telefono='".$phone."', Aprobado='".$admitted."' WHERE idUsuario='".$id."'";
  mysqli_query($connection, $query);
  echo "actualizacion completa";
  echo $id;
}
else
{
  echo "No se logro conectar al servidor";
}

 ?>
