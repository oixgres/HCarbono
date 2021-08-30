<?php
require_once 'dataBaseLogin.php';

if(isset($_POST['export']) && $connection)
{
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=data.csv');
  $output = fopen("php://output", "w");

  /* Se crea el csv */
  fputcsv($output, array(
    'Fecha', 
    'Hora',
    'Humedad',
    'Latitud',
    'Longitud',
    'Temperatura',
    'Presion',
    'CO',
    'CO2',
    'O2',
    'H2'
  ));

  /* Consulta para obtener los datos para el csv */
  $result = mysqli_query(
    $connection,
    "SELECT Fecha, 
      Hora,
      Humedad,
      Latitud,
      Longitud,
      Temperatura,
      Presion,
      CO,
      CO2,
      O2,
      H2
    FROM Estadisticas
    WHERE Usuario_idUsuario='".$_COOKIE['idUsuario']."'
    AND Fecha>='".$_POST['startDateCSV']."'
    AND Fecha<='".$_POST['endDateCSV']."'
    ORDER BY Fecha"
  );

  /* Se almacenan los datos en el csv */
  while($row = mysqli_fetch_assoc($result))
  {
    fputcsv($output, $row);
  }

  fclose($output);
}

?>
