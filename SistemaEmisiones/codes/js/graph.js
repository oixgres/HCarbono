//document.querySelector(".addParam").addEventListener("click",addParam);
//document.querySelector(".showResults").addEventListener("click",showResults);
/*Ayuda js
https://www.youtube.com/watch?v=xHbmHY9lJu4&ab_channel=FacultadAutodidacta
https://www.youtube.com/watch?v=4biDfBztNGc&ab_channel=SoyDalto
*/
var param = [];
var values = [];

/*
function addParam()
{
    let html = document.querySelector(".container").innerHTML;
    let newHTML = '<div><input type="text" class="parametro" placeholder="parametro"><input type="number" class="valor" placeholder="valor"></div>';
    document.querySelector(".container").innerHTML = html + newHTML;
}
*/

/*https://www.youtube.com/watch?v=xHbmHY9lJu4&t=71s&ab_channel=FacultadAutodidacta 8:14*/

function createJSString(json){
  var parsed = JSON.parse(json);
  var arr = [];
  for(var x in parsed){
    arr.push(parsed[x]);
  }
  return arr;
}

function showResults(date, hum, tem, co, co2, o2, vel)
{
/*
  axisX = createJSString(date);
  axisY1 = createJSString(hum);
  axisY2 = createJSString(tem);
  axisY3 = createJSString(co);
  axisY4 = createJSString(co2);
  axisY5 = createJSString(o2);
  axisY6 = createJSString(vel);

*/
  /*
  for(var i = document.querySelectorAll('.parametro').lenght - 1; i >= 0; i--){
    param.push(document.querySelectorAll('.parametro')[i].value);
    values.push(parseInt(document.querySelectorAll('.valor')[i].value));
  }*/

/*
  var data1 = {
    x: axisX,
    y: axisY1,
    type: "scatter"
  };

  var data2 = {
    x: axisX,
    y: axisY2,
    type: "scatter"
  };

  var data3 = {
    x: axisX,
    y: axisY3,
    type: "scatter"
  };

  var data4 = {
    x: axisX,
    y: axisY4,
    type: "scatter"
  };

  var data5 = {
    x: axisX,
    y: axisY5,
    type: "scatter"
  };

  var data6 = {
    x: axisX,
    y: axisY6,
    type: "scatter"
  };

  var data7 = {
    x: ["a", "b", "c", "d"],
    y: [1,2,3,4],
    type: "scatter"
  };

  var data = [data1, data2, data3, data4, data5, data6, data7];


  Plotly.newPlot('grafico', data);
}
