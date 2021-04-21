<?php

/*
$connection = la conexion
$table = el nombre de la tabla
$element = el campo que se selecciona
$where = donde se cumpla la caracteristica
$coincidence = la caracteristica
*/
function getFirstQueryElement($connection, $table, $element, $where, $coincidence){
  $query = "SELECT $element FROM $table WHERE $where='".$coincidence."'";
  $result = mysqli_query($connection, $query);
  $result = $result->fetch_array();

  return $result[0];
}
?>
