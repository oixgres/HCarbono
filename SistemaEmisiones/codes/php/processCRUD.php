<?php
session_start();
include "dataBaseLogin.php";

$connection = mysqli_connect($host, $user, $password, $bd);

if($connection)
{
  if(isset($_GET['delete']))
  {
    $id = $_GET['delete'];
    mysqli_query($connection, "DELETE FROM Usuario WHERE idUsuario='".$id."'");
  }

  if(isset($_GET['edit']))
  {
    $id = $_GET['edit'];
    $result = mysqli_query($connection, "SELECT * FROM Usuario WHERE idUsuario='".$id."'");

    if(count($result) == 1)
    {
      $row = $result->fetch_array();
      $_SESSION['Id']=$row['idUsuario'];
      $_SESSION['Username']=$row['Username'];
      $_SESSION['Password']=$row['Password'];
      $_SESSION['Nombre']=$row['Nombre'];
      $_SESSION['Ciudad']=$row['Ciudad'];
      $_SESSION['Correo']=$row['Correo'];
      $_SESSION['Telefono']=$row['Telefono'];
      $_SESSION['Aprobado']=$row['Aprobado'];
      $_SESSION['Empresa']=$row['Empresa_idEmpresa'];
      header("Location: updateUser.php");
      exit();
    }
  }
}
else
{
  die("No hay conexion: ".mysqli_connect_error());
}
?>
