<?php

/* Funcion para obtener un unico elemento de una consulta */
function getFirstQueryElement($connection, $table, $element, $where, $coincidence)
{
  $query = "SELECT $element FROM $table WHERE $where='".$coincidence."'";
  $result = mysqli_query($connection, $query);
  $result = $result->fetch_array();

  return $result[0];
}

/* Funcion para enviar correo */
function sendMail($email, $issue, $message)
{
  $header = "FROM: noreply@hcarbono.com"."\r\n";
  $header.= "Reply-To: noreply@hcarbono.com"."\r\n";
  $header.= "X-Mailer: PHP/".phpversion();

  mail($email, $issue, $message, $header);
}

/* Funcion para crear token */
function createToken()
{
  return sha1(uniqid(rand(10000000,99999999), true));
}

/* Funcion para validar la sesion antes de cargar la pagina */ 
function checkSession($userType, $redirectPage)
{
  session_start();
  if(
    ($_COOKIE["token"] != $_SESSION["token"]) || (!isset($_SESSION["token"]) && !isset($_COOKIE['id'])) || $_COOKIE['userType'] != $userType)
  {
    header("Location: ".$redirectPage);
    exit();
  }
}
?>
