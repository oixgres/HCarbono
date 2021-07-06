const formForgetPassword = document.getElementById('forget-password-form');
const forgetInput = document.getElementById('forget-mail');
const forgetErrorMessage = document.getElementById('forget-error-message');

formForgetPassword.addEventListener('submit', (e)=>{
  if(forgetInput.value === null || forgetInput.value != '')
  {
    $.ajax({
      type: 'POST',
      url: '../php/forgetPassword.php',
      data: $(formForgetPassword).serialize(),
      success: function(response){
        alert(response);
      }
    })
  }
  else
  {
    addErrorClass(forgetInput, forgetErrorMessage, 'error');
  }
  
  e.preventDefault();
});

forgetInput.addEventListener('input', (e)=>{
  removeErrorClass(forgetInput, forgetErrorMessage, 'error');
})