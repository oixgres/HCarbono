const form = document.getElementById('form');
const username = document.getElementById('username');
const password = document.getElementById('password');
const alertMessage = document.getElementById('alert');


document.addEventListener("DOMContentLoaded", () => {
  if(alertMessage != null){
    alertMessage.style.display ="none";
  
    if(sessionStorage.getItem('error')){
      alertMessage.innerHTML = sessionStorage.getItem('error');
      alertMessage.style.display =  "block";
      sessionStorage.clear();
    }
  }  
});

form.addEventListener('submit', (e)=>{
  if(username.value === '' || password.value === '')
  {
    e.preventDefault();
  }
  else
    sessionStorage.setItem('error', '<strong> Usuario o contraseña incorrectos </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
})

