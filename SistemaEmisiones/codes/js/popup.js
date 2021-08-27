
function toggleDeletePopup(deleteItem){
  var deleteButton = document.getElementById('popup-delete-button');
  var popup = document.getElementById('popup-delete');
  
  if(deleteItem != 1)
    deleteButton.value=deleteItem.value;
  else
    deleteButton.value=null;


  popup.classList.toggle("active");
}

function togglePasswordPopup(){
  var popup = document.getElementById('popup-password');

  popup.classList.toggle("active");
}
