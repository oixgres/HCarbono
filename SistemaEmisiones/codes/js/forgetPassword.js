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
        let json = JSON.parse(response);

        if(json.result){
          alert(json.message)
          window.location = '../../index.html'
        }
        else{
          forgetErrorMessage.setAttribute('data-error', json.message);
          addClass(forgetInput, forgetErrorMessage, 'error');
        }
      }
    })
  }
  else
  {
    addClass(forgetInput, forgetErrorMessage, 'error');
  }
  
  e.preventDefault();
});

forgetInput.addEventListener('input', (e)=>{
  removeClass(forgetInput, forgetErrorMessage, 'error');
})