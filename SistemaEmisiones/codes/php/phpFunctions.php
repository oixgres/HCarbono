<?php

/*
$connection = la conexion
$table = el nombre de la tabla
$element = el campo que se selecciona
$where = donde se cumpla la caracteristica
$coincidence = la caracteristica
*/
function getFirstQueryElement($connection, $table, $element, $where, $coincidence)
{
  $query = "SELECT $element FROM $table WHERE $where='".$coincidence."'";
  $result = mysqli_query($connection, $query);
  $result = $result->fetch_array();

  return $result[0];
}

function sendMail($email, $issue, $message)
{
  $header = "FROM: noreply@hcarbono.com"."\r\n";
  $header.= "Reply-To: noreply@hcarbono.com"."\r\n";
  $header.= "X-Mailer: PHP/".phpversion();

  @mail($email, $issue, $message, $header);
}

function createToken()
{
  return sha1(uniqid(rand(10000000,99999999), true));
}

function checkSession($redirecPage)
{
  if($_COOKIE["token"] != $_SESSION["token"] || !isset($_SESSION["token"]))
  {
    header("Location: ".$redirecPage);
    exit();
  }
}
?>
