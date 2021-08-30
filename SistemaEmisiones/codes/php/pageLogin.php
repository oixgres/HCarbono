<?php
session_start();

require_once "dataBaseLogin.php";
require_once "phpFunctions.php";

$userName = $_POST["username"];
$pass = $_POST["password"];

/*Buscamos si existe usuario*/
$query = "SELECT * From Usuario WHERE Username='".$userName."' and Password='".$pass."'";
$nr = mysqli_query($connection,$query);

/* Si existe intentamos ingresar */
if(mysqli_num_rows($nr) == 1)
{
  /* Obtenemos los datos del usuario */
  $id = intval(getFirstQueryElement(
    $connection,
    "Usuario",
    "idUsuario",
    "Username",
    $userName
  ));

  $name = getFirstQueryElement(
    $connection,
    "Usuario",
    "Nombre",
    "Username",
    $userName
  );

  $mail = getFirstQueryElement(
    $connection,
    "Usuario",
    "Correo",
    "Username",
    $userName
  );

  $device = getFirstQueryElement(
    $connection,
    "Dispositivo",
    "Codigo",
    "Usuario_idUsuario",
    $id
  );
  
  /* Si el usuario existe creamos cookies y token de sesion */
  $token = createToken();
  
  $_SESSION["token"] = $token;
  setcookie("token", $token, time()+(60*60*24*15), "/");
  setcookie("idUsuario", $id, time()+(60*60*24*15), "/");
  setcookie('userType', 'user', time()+(60*60*24*15), "/");
  setcookie("Nombre", $userName, time()+(60*60*24*15),"/");
  setcookie("Correo", $mail, time()+(60*60*24*15), "/");
  setcookie('Device', $device, time()+(60*60*24*15), "/");
  
  header("Location: userPage.php");
  exit();
}

/* Buscamos si existe admin*/
$query = "SELECT * FROM Administrador WHERE Username = '".$userName."' and Password = '".$pass."'";
$nr= mysqli_query($connection, $query);

if(mysqli_num_rows($nr) == 1)
{
  $idAdmin = intval(getFirstQueryElement(
    $connection,
    "Administrador",
    "idAdministrador",
    "Username",
    $userName
  ));

  /* Si el admin existe creamos cookies y token de sesion */
  $token = createToken();
  
  $_SESSION["token"] = $token;
  setcookie("token", $token, time()+(60*60*24*15), "/");
  setcookie('userType', 'admin', time()+(60*60*24*15), "/");
  setcookie("idAdmin", $idAdmin , time()+(60*60*24*15), "/");
  header("Location: adminPage.php");
  exit();
}
else
{
  header("Location: ../html/login.html");
  exit();
}
?>
