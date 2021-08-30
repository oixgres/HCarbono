const sessionForm = document.getElementById('form');
const username = document.getElementById('username');
const password = document.getElementById('password');
const errorSessionMessage = document.getElementsByClassName('empty-input-message');
const alertMessage = document.getElementById('alert');

username.addEventListener('input', (e) =>{
  username.classList.remove('error');
  errorSessionMessage[0].classList.remove('error');
})

password.addEventListener('input', (e)=>{
  password.classList.remove('error');
  errorSessionMessage[1].classList.remove('error');
})

document.addEventListener("DOMContentLoaded", () => {
  if(alertMessage != null){
    alertMessage.style.display ="none";
  
    if(sessionStorage.getItem('error')){
      alertMessage.innerHTML = sessionStorage.getItem('error');
      alertMessage.style.display =  "block";
      sessionStorage.clear();
    }
  }
  else
    sessionStorage.removeItem('error');
});

sessionForm.addEventListener('submit', (e)=>{
  if(username.value === '' || password.value === '')
  {
    if(sessionForm.name == "index-form"){
      sessionStorage.setItem('error', '<strong> Los campos de usuario y contraseña deben ser llenados </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');  
      e.preventDefault();
      window.location ='codes/html/login.html';
    }
    else{
      if(username.value === ""){
        username.classList.add('error')
        errorSessionMessage[0].classList.add('error');
      }
      if(password.value === ""){
        password.classList.add('error')
        errorSessionMessage[1].classList.add('error');
      }
    }  
    e.preventDefault()
  }
  else
    sessionStorage.setItem('error', '<strong> Usuario o contraseña incorrectos </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
})

