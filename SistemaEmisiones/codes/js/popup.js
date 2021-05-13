function togglePopup(deleteId){
  var popup = document.getElementById('popup-delete');
  var deleteButton = document.getElementById('popup-delete-button');

  if(deleteId.id != '1')
    deleteButton.href=deleteId.id;

  popup.classList.toggle("active");
}
