const formForgetPassword = document.getElementById('forget-password-form');
const forgetInput = document.getElementById('number-mail');
const forgetErrorMessage = document.getElementById('forget-error-message');

formForgetPassword.addEventListener('submit', (e)=>{
  if(forgetInput.value === null || forgetInput.value != '')
  {
    $.ajax({
      type: 'POST',
      url: '../php/forgetPassword.php',
      data: {forgetInput},
      success: function(response){
        console.log(response);
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