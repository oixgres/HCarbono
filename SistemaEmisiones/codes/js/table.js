const usersTable = document.getElementById('users-table');
const headTable  = ['Usuario','Contraseña','Nombre','Ciudad','Correo','Telefono','Estado','Empresa','Dispositivo','Accion'];

// var users = [];
var users;
var sortedUsers;
var sortableButtons;

function createTable(colNames, cols){
  console.log(cols)

  let table;
  let headTableIni = '<thead><tr>', headTableEnd = '</thead></tr>';
  let bodyTableIni = '<tr>', bodyTableEnd='</tr>';
  let index = 0; 

  /* Cabeza de la tabla */
  table = headTableIni;

  colNames.forEach(name => {
    /* Arriba:&#9660; Abajo:&#9650; Derecha:&#x2BC8;*/
    if(name != 'Accion'){
      table+=(
        '<th style="vertical-align: middle;">'
        +name+
        '<button id='+name+' value=null class="btn btn-outline-dark sortable-button" onClick=sortButton(this);>&#x2BC8;</button>'+
        '</th>'
        ); 
    }
    else
      table +='<th style="vertical-align: middle;">'+name+'</th>';
  });

  table += headTableEnd;
  
  /* Cuerpo de la tabla */
  if(cols.length > 0)
    while(index < cols.length){
      table += bodyTableIni;

      /* Informacion de los usuarios */
      table += '<td>'+cols[index].Username+'</td>';
      table += '<td>'+cols[index].Password+'</td>';
      table += '<td>'+cols[index].Nombre+'</td>';
      table += '<td>'+cols[index].Ciudad+'</td>';
      table += '<td>'+cols[index].Correo+'</td>';
      table += '<td>'+cols[index].Telefono+'</td>';
      table += '<td>'+cols[index].Aprobado+'</td>';
      table += '<td>'+cols[index].Empresa+'</td>';
      table += '<td>'+cols[index].Dispositivo+'</td>';

      /* Botones */
      table+='<td><div class="d-flex justify-content-end">';

      /* Editar Usuario */
      table+='<a href="adminPage.php?edit='+cols[index].idUsuario+'" class="btn config-button">Editar</a>';
      
      /* Eliminar Usuario */
      table+='<a id="adminPage.php?delete='+cols[index].idUsuario+'" onclick="toggleDeletePopup(this)" class="btn config-button-danger mx-3">Borrar</a>';

      table +='</div></td>';
      table += bodyTableEnd;

      index++;
    }

  return table;
}
function removeTable(){
  usersTable.innerHTML = '';
}

function sortButton(button){
  let index = 0;
  
  if(button.value == "null")
    button.value = "false";
  else
    button.value = !JSON.parse(button.value)

  if(sortableButtons.length > 0)
    while(sortableButtons.length > index){
      if(sortableButtons[index].id != button.id){
        sortableButtons[index].value = null;
        sortableButtons[index].innerHTML = '&#x2BC8;';
      }
      index++;
    }
  
  JSON.parse(button.value) ? button.innerHTML='&#9650;' : button.innerHTML='&#9660;';
}

function sortRow(table, rowName, upDown){
  /* Ordenar */
  table = table.sort(function(a, b) {
    if(a[rowName] > b[rowName])
      return 1;
    else
      if(a[rowName < b[rowName]])
        return -1;
      else
        return 0;
  });
}

document.addEventListener('DOMContentLoaded', ()=>{
  $.ajax({
    type: 'POST',
    url: '../php/getUsers.php',

    success: function (response){
      users = JSON.parse(response);
      usersTable.innerHTML =  createTable(headTable, users);
    },
    error: function(){
      usersTable.innerHTML =  createTable(headTable, []);
      alert('No se logro obtener el contenido de la tabla.');
    }
  });
  sortableButtons = document.getElementsByClassName('sortable-button');

});