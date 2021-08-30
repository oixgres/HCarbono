<?php 

require_once 'dataBaseLogin.php';
require_once 'phpFunctions.php';

$users = mysqli_query($connection, "SELECT * FROM Usuario");

/* La lista de usuarios la transformamos en un arreglo para recibirlo*/
while($row = mysqli_fetch_assoc($users))
{
  $company = getFirstQueryElement(
    $connection,
    "Empresa",
    "Nombre",
    "idEmpresa",
    $row['Empresa_idEmpresa']
  );
  
  $device = getFirstQueryElement(
    $connection,
    "Dispositivo",
    "Codigo",
    "Usuario_idUsuario",
    $row['idUsuario']
  );

  $usersArray[]=array(
    'idUsuario'=>$row['idUsuario'],
    'Usuario'=>$row['Username'],
    'Contraseña'=>$row['Password'],
    'Nombre'=>$row['Nombre'],
    'Ciudad'=>$row['Ciudad'], 
    'Correo'=>$row['Correo'],
    'Telefono'=>$row['Telefono'],
    'Estado'=>$row['Aprobado'],
    'idEmpresa'=>$row['Empresa_idEmpresa'],
    'Empresa'=>$company,
    'Dispositivo'=>$device
  );
}

echo json_encode($usersArray);
?>