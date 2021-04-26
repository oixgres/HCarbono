var checks = document.getElementsByClassName('form-check-input');
Plotly.newPlot('grafico', []);

function prepareGraphic(dataX, traceHum, traceTem, traceCO, traceCO2, traceO2, traceVel){
  axisX = createJSString(dataX);
  axisY1 = createJSString(traceHum);
  axisY2 = createJSString(traceTem);
  axisY3 = createJSString(traceCO);
  axisY4 = createJSString(traceCO2);
  axisY5 = createJSString(traceO2);
  axisY6 = createJSString(traceVel);

  for(var i = 0; i < axisX.length; i++)
  {
    if(axisX[i] < stDate)
    {
      axisX.splice(i, 1);
      axisY1.splice(i, 1);
      axisY2.splice(i, 1);
      axisY3.splice(i, 1);
      axisY4.splice(i, 1);
      axisY5.splice(i, 1);
      axisY6.splice(i, 1);
    }
    else
      if(axisX[i] > edDate)
      {
        axisX.splice(i, 1);
        axisY1.splice(i, 1);
        axisY2.splice(i, 1);
        axisY3.splice(i, 1);
        axisY4.splice(i, 1);
        axisY5.splice(i, 1);
        axisY6.splice(i, 1);
      }
  }
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

  return [data1, data2, data3, data4, data5, data6];
}
