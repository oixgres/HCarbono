var users;
const usersTable = document.getElementById('users-table');
const headTable  = ['Usuario','Contraseña','Nombre','Ciudad','Correo','Telefono','Estado','Empresa','Dispositivo','Accion'];

function createTable(colNames, cols){
  console.log(cols)

  let table;
  let headTableIni = '<thead><tr>', headTableEnd = '</thead></tr>';
  let bodyTableIni = '<tr>', bodyTableEnd='</tr>';
  let index = cols.length-1; 

  /* Cabeza de la tabla */
  table = headTableIni;

  colNames.forEach(name => {
    table += '<th>'+name+' </th>'; 
  });

  table += headTableEnd;
  
  /* Cuerpo de la tabla */
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

document.addEventListener('DOMContentLoaded', ()=>{
  $.ajax({
    type: 'POST',
    url: '../php/getUsers.php',

    success: function (response){
      users = JSON.parse(response);
      usersTable.innerHTML =  createTable(headTable, users);
    }
  });
});