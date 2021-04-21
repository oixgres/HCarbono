<?php
session_start();

require_once "dataBaseLogin.php";
require_once "phpFunctions.php";

if($connection)
{
  $name = $_POST["username"];
  $pass = $_POST["userpass"];

  /*Buscamos si existe usuario*/
  $query = mysqli_query($connection, "SELECT * From Usuario WHERE Username='".$name."' and Password='".$pass."'");
  $nr = mysqli_num_rows($query);

  if($nr == 1)
  {
    /* Si existe el usuario obtenemos el ID y lo guardamos*/
    $_SESSION['idUsuario'] = intval(getFirstQueryElement($connection, "Usuario", "idUsuario", "Username", $name));

    header("Location: userPage.php");
    exit();
  }

  /* Buscamos si existe admin*/
  $query = mysqli_query($connection, "SELECT * FROM Administrador WHERE Username = '".$name."' and Password = '".$pass."'");
  $nr = mysqli_num_rows($query);

  if($nr == 1)
  {
    header("Location: adminPage.php");
    exit();
  }
  else
  {
    echo "Usuario o contraseña incorrectos";
  }
}
else
{
  die("No hay conexion: ".mysqli_connect_error());
}
?>
