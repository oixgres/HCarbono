<?php
require_once "phpFunctions.php";

checkSession('user', "../../index.html");
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>H.Carbono | <?php echo $_COOKIE['Nombre']; ?></title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    >
    <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>
    
    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <!-- Originales -->
    <link rel="stylesheet" href="../css/pageStyle.css">
    <link rel="stylesheet" href="../css/popupStyle.css">
  </head>

  <body class="background-color">
    <?php
      require_once "dataBaseLogin.php";

      /* Se solicita la informacion de la base de datos */
      $result = mysqli_query($connection, "SELECT * FROM Estadisticas WHERE Usuario_idUsuario='".$_COOKIE["idUsuario"]."' ORDER BY Fecha, Hora");

      /* Las variables se convierten en arreglos para obtener los datos */
      $hum=array();
      $temp=array();
      $CO=array();
      $CO2=array();
      $O2=array();
      $H2=array();
      $pres=array();

      /* Se almacenan los datos obtenidos en nuestras variables */
      while($row=mysqli_fetch_assoc($result))
      {
        $date[]=$row['Fecha'];
        $time[]=$row['Hora'];
        $hum[]=$row['Humedad'];
        $temp[]=$row['Temperatura'];
        $pres[]=$row['Presion'];
        $CO[]=$row['CO'];
        $CO2[]=$row['CO2'];
        $O2[]=$row['O2'];
        $H2[]=$row['H2'];
      }

      /* Juntamos todos los arreglos en uno solo */
      $row = array($hum, $temp, $pres,$O2, $H2, $CO, $CO2);

      /* Creamos un arreglo auxiliar */
      $auxRow  = $row;

      /* Transformamos nuestros arreglos a jsons para trabajarlos mejor */
      $dataX=json_encode($date);
      $timeX = json_encode($time);
      $traceHum=json_encode($hum);
      $traceTem=json_encode($temp);
      $tracePres=json_encode($pres);
      $traceCO=json_encode($CO);
      $traceCO2=json_encode($CO2);
      $traceO2=json_encode($O2);
      $traceH2=json_encode($H2);
    ?>

    <!-- Navegador de la pagina -->
    <nav class="navbar navbar-dark config-color">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">H.CARBONO</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-sm config-button-danger nav-size-danger me-2" onclick="togglePopup('popup-delete-data')">Eliminar Registros</a>
        <a class="btn btn-sm config-button nav-size "href="logout.php">Salir</a>
      </div>
    </nav>

    <div class="row mx-5">
      <!-- Columna izquierda -->
      <div class="col-xl-6 col-md-4 col-sm-4 mt-5">
        <!-- Calendario -->
        <div>
          <div style="display: inline-block;">
            <!-- Fecha inicial -->
            <label for="startDate">Fecha Inicial: </label>
            <input
              type="date"
              id="startDate"
              class="me-2 mb-2"
              value="<?php echo $date[0]; ?>"
              min="<?php echo $date[0]; ?>"
              max="<?php echo date('Y-m-d'); ?>"
            >
          </div>
          
          <!-- Fecha final -->
          <div style="display: inline-block;">
            <label for="endDate">Fecha Final: </label>
            <input
              type="date"
              id="endDate"
              class="ms-xl-0 ms-md-2 ms-sm-0"
              value="<?php echo date('Y-m-d'); ?>"
              min="<?php echo $date[0]; ?>"
              max="<?php echo date('Y-m-d'); ?>"
            >
          </div>
        </div>
        
        <!-- Lista de checkbox -->
        <div>
          <div class="form-check mt-3">
            <!-- Checkbox Humedad -->
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              name="graph[]"
              id="hum"
            >
            <label class="form-check-label" for="hum">Humedad de las emisiones</label>
          </div>

          <div class="form-check mt-3">
            <!-- Checkbox Temperatura -->
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              name="graph[]"
              id="tem"
            >
            <label class="form-check-label" for="tem">Temperatura de las emisiones</label>
          </div>

          <div class="form-check mt-3">
            <!-- Checkbox Presion -->
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              name="graph[]"
              id="pres"
            >
            <label class="form-check-label" for="pres">Presion</label>
          </div>

          <div class="form-check mt-3">
            <!-- Checkbox O2 -->
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              name="graph[]"
              id="o2"
            >
            <label class="form-check-label" for="o2">O2</label>
          </div>

          <div class="form-check mt-3">
            <!-- Checkbox H2 -->
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              name="graph[]"
              id="h2"
            >
            <label class="form-check-label" for="h2">H2</label>
          </div>

          <div class="form-check mt-3">
            <!-- Checkbox CO -->
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              name="graph[]"
              id="co"
            >
            <label class="form-check-label" for="co">CO</label>
          </div>

          <div class="form-check mt-3">
            <!-- Checkbox CO2 -->
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              name="graph[]"
              id="co2"
            >
            <label class="form-check-label" for="co2">CO2</label>
          </div>
        </div>
        <!-- Boton para desplegar grafica -->
        <button class="displayGraph btn config-button mt-5">Graficar</button>
      </div>

      <!-- Aqui se despliega la grafica -->
      <div class="col-xl-6 col-md-8 col-sm-8 mt-2">
        <div id="grafico"></div>
      </div>
    </div>

    <!-- Descargar CSV -->
    <div class="row mt-3 me-5">
      <form
        action="export.php"
        method="post"
        class="d-flex justify-content-end"
      >
        <div>
          <!-- Fecha Inicial -->
          <input
            type="date"
            name="startDateCSV"
            value="<?php echo $date[0]; ?>"
            min="<?php echo $date[0]; ?>"
            max="<?php echo date('Y-m-d'); ?>"
            class="me-3"
          >

          <!-- Fecha Final -->
          <input
            type="date"
            name="endDateCSV"
            value="<?php echo date('Y-m-d'); ?>"
            min="<?php echo $date[0]; ?>"
            max="<?php echo date('Y-m-d'); ?>"
            class="me-3"
          >
        </div>

        <!-- Boton de exportar -->
        <input
          class="btn config-button btn-sm hide-overflow"
          type="submit" 
          name="export"
          value="Exportar"
        >
      </form>
    </div>

    <!-- Popup eliminar usuarios -->
    <div class="popup" id="popup-delete-data">
      <div class="overlay"></div>
      <div class="content">
        <div class="close-button" onclick="togglePopup('popup-delete-data')">&times;</div>
        <h1 class="danger-text">ADVERTENCIA</h1>
        <p>Una vez eliminados los registros se perderan para siempre.</p>
        <p>¿Desea continuar?</p>
        <a
          class="btn config-button-danger"
          style="min-width: 150px;"
          href="deleteData.php"
        >Eliminar datos</a>
      </div>
    </div>
    <script src="../js/popup.js"></script>

    <!-- Archivos para facilitar el despliegue de la grafica -->
    <script src="../js/jsonConvert.js"></script>
    <script src="../js/graph.js"></script>

    <script type="text/javascript">
      document.querySelector(".displayGraph").addEventListener("click",displayGraph);

      /* Funcion para desplegar la grafica */
      function displayGraph(){

        /* Preparamos los datos */ 
        var fullData = prepareGraphic(
          '<?php echo $dataX; ?>',
          '<?php echo $timeX; ?>',
          '<?php echo $traceHum; ?>',
          '<?php echo $traceTem; ?>',
          '<?php echo $tracePres; ?>',
          '<?php echo $traceO2; ?>',
          '<?php echo $traceH2; ?>',
          '<?php echo $traceCO; ?>',
          '<?php echo $traceCO2 ?>'
        );

        var data = [];

        /* Solo se muestran los datos seleccionados por el usuario */
        for(i = 0; i < checks.length; i++)
          if(checks[i].checked === true)
            data.push(fullData[i]);
          
        /* Grafica lista para desplegarse */ 
        Plotly.newPlot('grafico', data);
      }
    </script>
    <script type="text/javascript">
      sessionStorage.removeItem('error');
    </script>
  </body>
</html>
