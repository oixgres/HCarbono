
function toggleDeletePopup(deleteItem){
  const deleteButton = document.getElementById('popup-delete-button');
  const popup = document.getElementById('popup-delete');
  
  if(deleteItem != 1)
    deleteButton.value=deleteItem.value;
  else
    deleteButton.value=null;

  popup.classList.toggle("active");
}

function togglePopup(id){
  const popup = document.getElementById(id);

  popup.classList.toggle('active');
}
