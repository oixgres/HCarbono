<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <title>Sistema Emisiones (Nombre en desarrollo)</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <link rel="stylesheet" href="../css/pageStyle.css">
  </head>

  <body class="page-settings">
    <?php
      include "dataBaseLogin.php";
        /* https://www.youtube.com/watch?v=xHbmHY9lJu4&t=71s&ab_channel=FacultadAutodidacta 3:43*/
      $connection = mysqli_connect($host, $user, $password, $bd);

      $result = mysqli_query($connection, "SELECT Fecha, Humedad, Temperatura, CO, CO2, O2, Velocidad FROM Estadisticas WHERE Usuario_idUsuario='".$_SESSION['idUsuario']."' ORDER BY Fecha");

      $date=array();
      $hum=array();
      $temp=array();
      $CO=array();
      $CO2=array();
      $O2=array();
      $vel=array();

      while($row=mysqli_fetch_row($result))
      {
        $date[]=$row[0];
        $hum[]=$row[1];
        $temp[]=$row[2];
        $CO[]=$row[3];
        $CO2[]=$row[4];
        $O2[]=$row[5];
        $vel[]=$row[6];
      }

      /* Usaremos este arreglo para obtener los datos */
      $row = array($hum, $temp, $CO, $CO2, $O2, $vel);
      $auxRow  = $row;

      $dataX=json_encode($date);
      $traceHum=json_encode($hum);
      $traceTem=json_encode($temp);
      $traceCO=json_encode($CO);
      $traceCO2=json_encode($CO2);
      $traceO2=json_encode($O2);
      $traceVel=json_encode($vel);
    ?>

    <nav class="navbar navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">SISTEMA</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-primary btn-sm button-settings "href="../../index.html">Salir</a>
      </div>
    </nav>

    <div class="row mt-5 mx-5">
      <div class="col">
        <!-- Lista de checkbox -->
        <form class="" action="" method="post">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="hum">
            <label class="form-check-label" for="hum">Humedad de las emisiones</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="tem">
            <label class="form-check-label" for="tem">Temperatura de las emisiones</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="co">
            <label class="form-check-label" for="co">CO</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="co2">
            <label class="form-check-label" for="co2">CO2</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="o2">
            <label class="form-check-label" for="o2">O2</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="graph[]" id="vel">
            <label class="form-check-label" for="vel">Velocidad</label>
          </div>
        </form>

        <button class="showGraphic" name="submitGraph">Graficar</button>
      </div>

      <div class="col">
        <div id="grafico"></div>
      </div>
    </div>

    <script type="text/javascript">
      function createJSString(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for(var x in parsed){
          arr.push(parsed[x]);
        }
        return arr;
      }
    </script>

    <script type="text/javascript">

      document.querySelector(".showGraphic").addEventListener("click",showGraphic);
      var checks = document.getElementsByClassName('form-check-input');

      function showGraphic()
      {
        axisX = createJSString('<?php echo $dataX ?>');
        axisY1 = createJSString('<?php echo $traceHum ?>');
        axisY2 = createJSString('<?php echo $traceTem ?>');
        axisY3 = createJSString('<?php echo $traceCO ?>');
        axisY4 = createJSString('<?php echo $traceCO2 ?>');
        axisY5 = createJSString('<?php echo $traceO2 ?>');
        axisY6 = createJSString('<?php echo $traceVel ?>');

        var data1 = {
          x: axisX,
          y: axisY1,
          name: 'Humedad',
          type: "scatter"
        };

        var data2 = {
          x: axisX,
          y: axisY2,
          name: 'Temperatura',
          type: "scatter"
        };

        var data3 = {
          x: axisX,
          y: axisY3,
          name: 'CO',
          type: "scatter"
        };

        var data4 = {
          x: axisX,
          y: axisY4,
          name: 'CO2',
          type: "scatter"
        };

        var data5 = {
          x: axisX,
          y: axisY5,
          name: 'O2',
          type: "scatter"
        };

        var data6 = {
          x: axisX,
          y: axisY6,
          name: 'Velocidad',
          type: "scatter"
        };

        var fullData = [data1, data2, data3, data4, data5, data6];
        var data = [];
        var i = 0;


        <?php for($i = 0; $i <= count($row); $i++): ?>
          <?php if(!empty($row[$i])): ?>
                  if(checks[i].checked === true){
                    data.push(fullData[i]);
                  }
          <?php endif; ?>
                i++;
        <?php endfor;
              $row = $auxRow;
        ?>

        //var data = [data1, data2, data3, data4, data5, data6];

      Plotly.newPlot('grafico', data);

    }
    </script>

  <!--  <script src="../js/graph.js"></script> -->
  </body>
</html>
