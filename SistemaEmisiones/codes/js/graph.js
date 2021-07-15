/* Se obtienen las opciones que el usuario selecciono */
var checks = document.getElementsByClassName('form-check-input');

/* Se crea una grafica vacia por default al cargar la pagina */
Plotly.newPlot('grafico', []);

function prepareGraphic(dataX, timeX, traceHum, traceTem, traceCO, traceCO2, traceO2, traceVel){
  /* Obtenemos las fechas */
  var edDate = document.getElementById('endDate').value;
  var stDate = document.getElementById('startDate').value;

  axisX = jsonContains(dataX);
  timeX = jsonContains(timeX);

  axisY = [
    jsonContains(traceHum),
    jsonContains(traceTem),
    jsonContains(traceCO),
    jsonContains(traceCO2),
    jsonContains(traceO2),
    jsonContains(traceVel)
  ];


  /* Se eliminan los datos cuyas fechas no fueron seleccionadas */
  for(var i = 0; i < axisX.length; i++)
  {
    axisX[i] = axisX[i] +" "+ timeX[i];
    if(axisX[i] < stDate)
    {
      axisX.splice(i, 1);
      timeX.splice(i, 1);

      for(var j = 0; j < axisY.length; j++)
        axisY[j].splice(i,1);

      i--;
    }
    else
      if(axisX[i] > edDate)
      {
        timeX.splice(i, 1);
        axisX.splice(i, 1);

        for(var j = 0; j < axisY.length; j++)
          axisY[j].splice(i,1);

        i--;
      }
  }
  var data1 = {
    x: axisX,
    y: axisY[0],
    name: 'Humedad',
    type: "scatter"
  };

  var data2 = {
    x: axisX,
    y: axisY[1],
    name: 'Temperatura',
    type: "scatter"
  };

  var data3 = {
    x: axisX,
    y: axisY[2],
    name: 'CO',
    type: "scatter"
  };

  var data4 = {
    x: axisX,
    y: axisY[3],
    name: 'CO2',
    type: "scatter"
  };

  var data5 = {
    x: axisX,
    y: axisY[4],
    name: 'O2',
    type: "scatter"
  };

  var data6 = {
    x: axisX,
    y: axisY[5],
    name: 'Velocidad',
    type: "scatter"
  };

  return [data1, data2, data3, data4, data5, data6];
}
