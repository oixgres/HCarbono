<?php

include "dataBaseLogin.php";

$connection = mysqli_connect($host, $user, $password, $bd);

if($connection)
{
  $name = $_POST["username"];
  $pass = $_POST["userpass"];

  /*Buscamos si existe usuario*/
  $query = mysqli_query($connection, "SELECT * From Usuario WHERE Username='".$name."' and Password='".$pass."'");
  $hr = mysqli_num_rows($query);

  if($nr == 1)
  {
    header("Location: ../html/userPage.html");
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
    echo " ".$name;
    echo " ".$pass;
  }
}
else
{
  die("No hay conexion: ".mysqli_connect_error());
}
?>
