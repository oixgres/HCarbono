document.querySelector(".addParam").addEventListener("click",addParam);
document.querySelector(".showResults").addEventListener("click",showResults);
/*Ayuda js
https://www.youtube.com/watch?v=xHbmHY9lJu4&ab_channel=FacultadAutodidacta
https://www.youtube.com/watch?v=4biDfBztNGc&ab_channel=SoyDalto
*/
var param = [];
var values = [];

function addParam()
{
    let html = document.querySelector(".container").innerHTML;
    let newHTML = '<div><input type="text" class="parametro" placeholder="parametro"><input type="number" class="valor" placeholder="valor"></div>';
    document.querySelector(".container").innerHTML = html + newHTML;
}

function showResults()
{
  for(var i = document.querySelectorAll('.parametro').lenght - 1; i >= 0; i--){
    param.push(document.querySelectorAll('.parametro')[i].value);
    values.push(parseInt(document.querySelectorAll('.valor')[i].value));
  }

  var data = [{
    x: ['pepe','paco','ulises','juan'],
    y: [1,2,3,4],
    type: "scatter"
  }];

  Plotly.newPlot('grafico', data);
}
