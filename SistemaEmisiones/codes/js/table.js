const usersTable = document.getElementById('users-table');
const deleteButton = document.getElementById('popup-delete-button');
const headTable  = ['Usuario','Contraseña','Nombre','Ciudad','Correo','Telefono','Estado','Empresa','Dispositivo','Accion'];

var users;
var filteredUsers;
var rows;
var sortableButtons;

/* Funcion para crear los renglones de la tabla */
function createRows(cols){
  let table; 
  let bodyTableIni = '<tbody id="rows">', bodyTableEnd='</tbody>';

  table = bodyTableIni;

  /* Informacion de los usuarios */
  if(cols.length > 0)
    cols.forEach(user =>{

      table += '<tr>';
      
      /* Chequeo de que los datos no esten vacios */
      if(user.Usuario)
        table += '<td>'+user.Usuario+'</td>';
      else
        table += '<td>-</td>';

      if(user.Contraseña)
        table += '<td>'+user.Contraseña+'</td>';
      else
        table += '<td>-</td>';

      table += '<td>'+user.Nombre+'</td>';
      table += '<td>'+user.Ciudad+'</td>';
      table += '<td>'+user.Correo+'</td>';
      table += '<td>'+user.Telefono+'</td>';
      table += '<td>'+user.Estado+'</td>';
      table += '<td>'+user.Empresa+'</td>';
      
      if(user.Dispositivo)
        table += '<td>'+user.Dispositivo+'</td>';
      else
        table += '<td>-</td>';
      
      /* Botones */
      table+='<td><div class="d-flex justify-content-end">'; 
      /* Editar Usuario */
      table+='<button value="'+user.idUsuario+'" onclick="updateButton(this)" class="btn config-button">Editar</a>';
      /* Eliminar Usuario */
      table+='<button value="'+user.idUsuario+'" onclick="toggleDeletePopup(this)" class="btn config-button-danger mx-3">Borrar</button>';
      
      table +='</div></td>';
      table += '</tr>';
    });

    table += bodyTableEnd;

  return table; 
}

/* Funcion para crear la tabla */
function createTable(colNames, cols){
  let table;
  let headTableIni = '<thead><tr>', headTableEnd = '</thead></tr>';

  /* Cabeza de la tabla */
  table = headTableIni;

  colNames.forEach(name => {
    /* Arriba:&#9660; Abajo:&#9650; Derecha:&#x2BC8;*/
    if(name != 'Accion'){
      table+=(
        '<th>'+
        '<div style="display:flex;">'+
        '<span>'+name+'</span>'+
        '<button id='+name+' value=null class="sortable-button" onClick=sortButton(this);>&#x2BC8;</button>'+
        '</div>'+
        '</th>'
        ); 
    }
    else
      table +='<th style="vertical-align: middle;">'+name+'</th>';
  });

  table += headTableEnd;
  
  /* Cuerpo de la tabla */
  table+=createRows(cols);
  
  return table;
}

/* Funcion para el boton de editar y crear usuarios */
function updateButton(button){
  /* Checamos si crearemos o editaremos usuarios */
  if(button){
    /* Se crea cookie donde  se almacena el id del usuario a editar */
    document.cookie =  "Id="+button.value;
    document.cookie = "Button=Editar";
  }
  else{
    /* Remover cookie */
    document.cookie = "Id=0";
    document.cookie = "Button=Crear";
  }
  
  window.location = '../php/updateUser.php';
}

/* Funcion para que al precionar un boton los renglones se ordenen */
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
  
  filteredUsers = sortRow(filteredUsers, button.id, JSON.parse(button.value) ? -1 : 1);
  rows.innerHTML = '';
  rows.innerHTML = createRows(filteredUsers);
  JSON.parse(button.value) ? button.innerHTML='&#9650;' : button.innerHTML='&#9660;';
}

/* Funcion para ordenar renglones */
function sortRow(table, rowName, upDown){
  return table.sort(function(a, b) {
    if(a[rowName] === null || b[rowName] === null)
      if(a[rowName] != null)
        return 1*upDown;
      else
        return -1*upDown;
    else
      if(a[rowName].toUpperCase() > b[rowName].toUpperCase())
        return 1*upDown;
      else
        if(a[rowName].toUpperCase() < b[rowName].toUpperCase())
          return -1*upDown;
        else
          return 0;
  });
}

/* Acciones antes de mostrar la pagina */
document.addEventListener('DOMContentLoaded', ()=>{
  $.ajax({
    type: 'POST',
    url: '../php/getUsers.php',

    success: function (response){
      users = JSON.parse(response);
      filteredUsers = users;
      usersTable.innerHTML =  createTable(headTable, users);
      rows = document.getElementById('rows');
    },
    error: function(){
      usersTable.innerHTML =  createTable(headTable, []);
      alert('No se logro obtener el contenido de la tabla.');
    }
  });
  sortableButtons = document.getElementsByClassName('sortable-button');
});

deleteButton.addEventListener('click', () =>{
  $.ajax({
    type: 'POST',
    url: '../php/deleteUser.php',
    data: {'deleteUser': deleteButton.value},
    success: function (response){
      let res = JSON.parse(response);

      if(res.exito)
        location.reload();
      else
        alert(res.error);
    }
  })
});