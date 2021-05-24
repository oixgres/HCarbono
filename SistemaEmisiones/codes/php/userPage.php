<?php
require_once "phpFunctions.php";

checkSession('user', "../../index.html");
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>H.Carbono | <?php echo $_COOKIE['']; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <link rel="stylesheet" href="../css/pageStyle.css">
  </head>

  <body class="background-color">
    <?php
      require_once "dataBaseLogin.php";

      $result = mysqli_query($connection, "SELECT Fecha, Hora, Humedad, Temperatura, CO, CO2, O2, Velocidad FROM Estadisticas WHERE Usuario_idUsuario='".$_COOKIE["idUsuario"]."' ORDER BY Fecha, Hora");

      $hum=array();
      $temp=array();
      $CO=array();
      $CO2=array();
      $O2=array();
      $vel=array();

      while($row=mysqli_fetch_row($result))
      {
        $date[]=$row[0];
        $time[]=$row[1];
        $hum[]=$row[2];
        $temp[]=$row[3];
        $CO[]=$row[4];
        $CO2[]=$row[5];
        $O2[]=$row[6];
        $vel[]=$row[7];
      }

      /* Usaremos este arreglo para obtener los datos */
      $row = array($hum, $temp, $CO, $CO2, $O2, $vel);
      $auxRow  = $row;

      $dataX=json_encode($date);
      $timeX = json_encode($time);
      $traceHum=json_encode($hum);
      $traceTem=json_encode($temp);
      $traceCO=json_encode($CO);
      $traceCO2=json_encode($CO2);
      $traceO2=json_encode($O2);
      $traceVel=json_encode($vel);
    ?>

    <nav class="navbar navbar-dark config-color">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">H.CARBONO</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-sm config-button-navbar "href="logout.php">Salir</a>
      </div>
    </nav>

    <div class="row mx-5">
      <div class="col-6 mt-5">
        <!-- Calendario -->
        <!-- Fecha inicial -->

        <label for="startDate">Fecha Inicial: </label>
        <input
          type="date"
          id="startDate"
          value="<?php echo $date[0]; ?>"
          min="<?php echo $date[0]; ?>"
          max="<?php echo date('Y-m-d'); ?>"
        >

        <!-- Fecha final -->
        <label class="ms-2" for="endDate">Fecha Final: </label>
        <input
          type="date"
          id="endDate"
          value="<?php echo date('Y-m-d'); ?>"
          min="<?php echo $date[0]; ?>"
          max="<?php echo date('Y-m-d'); ?>"
        >

        <!-- Lista de checkbox -->
        <div class="">
          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="hum">
            <label class="form-check-label" for="hum">Humedad de las emisiones</label>
          </div>

          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="tem">
            <label class="form-check-label" for="tem">Temperatura de las emisiones</label>
          </div>

          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="co">
            <label class="form-check-label" for="co">CO</label>
          </div>

          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="co2">
            <label class="form-check-label" for="co2">CO2</label>
          </div>

          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="o2">
            <label class="form-check-label" for="o2">O2</label>
          </div>

          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="vel">
            <label class="form-check-label" for="vel">Velocidad</label>
          </div>
        </div>
        <button class="displayGraph btn btn-primary config-button hide-overflow mt-5">Graficar</button>
      </div>

      <div class="col-6 mt-2">
        <div id="grafico"></div>
      </div>
    </div>

    <!-- Descargar CSV -->
    <div class="row mt-3 me-5">
      <form action="export.php" method="post" class="d-flex justify-content-end">
        <input
          type="date"
          name="startDateCSV"
          value="<?php echo $date[0]; ?>"
          min="<?php echo $date[0]; ?>"
          max="<?php echo date('Y-m-d'); ?>"
          class="me-3"
        >
        <input
          type="date"
          name="endDateCSV"
          value="<?php echo date('Y-m-d'); ?>"
          min="<?php echo $date[0]; ?>"
          max="<?php echo date('Y-m-d'); ?>"
          class="me-3"
        >
        <input class="btn btn-primary config-button btn-sm hide-overflow" type="submit" name="export" value="Exportar datos">
      </form>
    </div>
    <script src="../js/phpToJs.js" charset="utf-8"></script>
    <script src="../js/graph.js" charset="utf-8"></script>
    <!-- <script src="../js/session.js"></script> -->

    <script type="text/javascript">
      document.querySelector(".displayGraph").addEventListener("click",displayGraph);

      function displayGraph(){
        var fullData = prepareGraphic('<?php echo $dataX; ?>','<?php echo $timeX; ?>','<?php echo $traceHum; ?>','<?php echo $traceTem; ?>', '<?php echo $traceCO; ?>', '<?php echo $traceCO2 ?>', '<?php echo $traceO2; ?>', '<?php echo $traceVel; ?>');
        var data = [];
        var i = 0;

        /* Funcion para solo mostrar los datos seleccionados por el usuario */
        <?php for($i = 0; $i <= count($row); $i++): ?>
          <?php if(!empty($row[$i])): ?>
                  if(checks[i].checked === true)
                  {
                    data.push(fullData[i]);
                  }
          <?php endif; ?>
                i++;
        <?php endfor;
              $row = $auxRow;
        ?>

        Plotly.newPlot('grafico', data);
      }
    </script>
  </body>
</html>
