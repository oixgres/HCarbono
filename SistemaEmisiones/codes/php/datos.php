<?php
require_once 'dataBaseLogin.php';
require_once 'phpFunctions.php';

$idCompany =$_POST["id"]; // id de la empresa
$vLat =$_POST["vLat"]; // valor de la coordenada latitud
$vLon =$_POST["vLon"]; //valor de la coordenada longitud
$vTem =$_POST["vTem"];  // valor de la temperatura
$vPres =$_POST["vPres"]; // valor de la presion admosferica 
$vO2 =$_POST["v02"]; //  valor de Oxígeno O2 
$vH2 =$_POST["vH2"];// valor de hidrógeno H2
$vCO =$_POST["vCO"];  // valor de Monóxido de carbono CO
$vCO2 =$_POST["vCO2"]; // valor de dióxido de carbono CO2

/* Obtenemos el id del usuario */
$idUser = getFirstQueryElement(
  $connection,
  'Usuario',
  'idUsuario',
  'Empresa_idEmpresa',
  $idCompany
);

/* Obtenemos el id del dispositivo */
$idDevice = getFirstQueryElement(
  $connection,
  'Dispositivo',
  'idDispositivo',
  'Usuario_idUsuario',
  $idUser
);

/* Obtenemos la fecha  y hora de la emision */
$date = date("Y-m-d");
$time = date("H:i:s");

/* Solicitud para insertar los datos */
$query = "INSERT INTO Estadisticas(
  Fecha,
  Hora,
  Humedad,
  Latitud,
  Longitud,
  Temperatura,
  Presion,
  O2,
  H2,
  CO,
  CO2,
  Usuario_idUsuario,
  Empresa_idEmpresa,
  Dispositivo_idDispositivo
) 
VALUES (
  '$date',
  '$time',
  0,
  '$vLat',
  '$vLon',
  '$vTem',
  '$vPres',
  '$vO2',
  '$vH2',
  '$vCO',
  '$vCO2',
  '$idUser',
  '$idCompany',
  '$idDevice'
)";

mysqli_query($connection,$query);

/* Retornamos respuesta */
echo json_encode(
  array(
    'prueba' => "'$date',
      '$time',
      0,
      '$vLat',
      '$vLon',
      '$vTem',
      '$vPres',
      '$vO2',
      '$vH2',
      '$vCO',
      '$vCO2',
      '$idUser',
      '$idCompany',
      '$idDevice'"
  )
);
?>