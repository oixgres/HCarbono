function toggleDeletePopup(deleteId){
  var popup = document.getElementById('popup-delete');
  var deleteButton = document.getElementById('popup-delete-button');

  if(deleteId != 1)
    deleteButton.href=deleteId.id;

  popup.classList.toggle("active");
}

function togglePasswordPopup(){
  var popup = document.getElementById('popup-password');

  popup.classList.toggle("active");
}
