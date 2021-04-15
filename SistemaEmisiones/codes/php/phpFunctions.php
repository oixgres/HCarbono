<?php

/*
$connection = la conexion
$table = el nombre de la tabla
$selected = el campo que se selecciona
$where = donde se cumpla la caracteristica
$id = la caracteristica
*/
function getFromTable($connection, $table, $selected, $where, $id){
  $query = "SELECT $selected FROM $table WHERE $where='".$id."'";
  $result = mysqli_query($connection, $query);
  $result = $result->fetch_array();

  return $result[0];
}
?>
