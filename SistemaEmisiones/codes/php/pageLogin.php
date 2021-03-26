<?php
session_start();

require_once "dataBaseLogin.php";

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
    $query = "SELECT idUsuario FROM Usuario WHERE Username = '".$name."'";
    $res_query = mysqli_query($connection, $query);
    $res_query = $res_query->fetch_array();
    $_SESSION['idUsuario'] = intval($res_query[0]);

    header("Location: userPage");
    exit();
  }

  /* Buscamos si existe admin*/
  $query = mysqli_query($connection, "SELECT * FROM Administrador WHERE Username = '".$name."' and Password = '".$pass."'");
  $nr = mysqli_num_rows($query);

  if($nr == 1)
  {
    header("Location: adminPage");
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
