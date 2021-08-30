<?php 
require_once 'dataBaseLogin.php';

$user = $_POST['deleteUser'];

$query = "DELETE FROM Usuario WHERE idUsuario='".$user."'";

if(mysqli_query($connection, $query)){
  /* Si se logro la consulta se retorna un mensaje de exito */
  echo json_encode(array(
    'exito' =>"Usuario eliminado con exito $user"
  ));
}
else{
  echo json_encode(array(
    'error' => 'No se pudo eliminar usuario'
  ));
}
?>