const searchElement = document.getElementById('search-input');
const searchButton = document.getElementById('search-button');

function changeSearch(button){
  searchButton.innerText = button.innerText;
}

searchElement.addEventListener('input', ()=>{
  filteredUsers = []

  if(searchElement.value !== null && searchElement.value !== "")
    if(users)
      users.forEach(user => {
        if(user[searchButton.innerText] !== null)
          if(user[searchButton.innerText].toLowerCase().includes(searchElement.value.toLowerCase()))
            filteredUsers.push(user);
      });
    else
      alert('No hay usuarios para realizar una busqueda');
  else
    filteredUsers = users;
  
  rows.innerHTML = '';
  rows.innerHTML = createRows(filteredUsers);
});
