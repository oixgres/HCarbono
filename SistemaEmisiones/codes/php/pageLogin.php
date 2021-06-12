<?php
session_start();

require_once "dataBaseLogin.php";
require_once "phpFunctions.php";

$name = $_POST["username"];
$pass = $_POST["userpass"];

/*Buscamos si existe usuario*/
$query = mysqli_query($connection, "SELECT * From Usuario WHERE Username='".$name."' and Password='".$pass."'");
$nr = mysqli_num_rows($query);

if(strlen(trim($name)) == 0 || strlen(trim($pass)) == 0)
{
  header("Location: ../html/login.html");
  exit();
}
else
{
  if($nr == 1)
  {
    /* Obtenemos el id del usuario */
    $id = intval(getFirstQueryElement($connection, "Usuario", "idUsuario", "Username", $name));
    
    /* Si el usuario existe creamos cookies y token de sesion */
    $token = createToken();
    
    $_SESSION["token"] = $token;
    setcookie("token", $token, time()+(60*60*24*15), "/");
    setcookie("idUsuario", $id, time()+(60*60*24*15), "/");
    setcookie('userType', 'user', time()+(60*60*24*15), "/");
    setcookie("Nombre", getFirstQueryElement($connection, "Usuario", "Nombre", "Username", $name), time()+(60*60*24*15), "/");
    setcookie("Correo", getFirstQueryElement($connection, "Usuario", "Correo", "Username", $name), time()+(60*60*24*15), "/");
    setcookie('Device', getFirstQueryElement($connection, "Dispositivo", "Codigo", "Usuario_idUsuario", $id), time()+(60*60*24*15), "/");
    
    header("Location: userPage.php");
    exit();
  }
  
  /* Buscamos si existe admin*/
  $query = mysqli_query($connection, "SELECT * FROM Administrador WHERE Username = '".$name."' and Password = '".$pass."'");
  $nr = mysqli_num_rows($query);
  
  if($nr == 1)
  {
    /* Si el admin existe creamos cookies y token de sesion */
    $token = createToken();
    
    $_SESSION["token"] = $token;
    setcookie("token", $token, time()+(60*60*24*15), "/");
    setcookie('userType', 'admin', time()+(60*60*24*15), "/");
    setcookie("idUsuario",intval(getFirstQueryElement($connection, "Administrador", "idAdministrador", "Username", $name)) , time()+(60*60*24*15), "/");
    header("Location: adminPage.php");
    exit();
  }
  else
  {
    header("Location: ../html/login.html");
    exit();
  }
}
?>
