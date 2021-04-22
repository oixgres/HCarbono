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
    //$_SESSION['idUsuario'] = intval(getFirstQueryElement($connection, "Usuario", "idUsuario", "Username", $name));

    /* Si el id existe creamos cookies y token de sesion */
    $token = createToken();

    $_SESSION["token"] = $token;
    setcookie("token", $token, time()+(60*60*24*15), "/");
    setcookie("idUsuario",intval(getFirstQueryElement($connection, "Usuario", "idUsuario", "Username", $name)) , time()+(60*60*24*15), "/");
    setcookie("Nombre", getFirstQueryElement($connection, "Usuario", "Nombre", "Username", $name), time()+(60*60*24*15), "/");
    setcookie("Correo", getFirstQueryElement($connection, "Usuario", "Correo", "Username", $name), time()+(60*60*24*15), "/");

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
