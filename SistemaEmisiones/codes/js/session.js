const form = document.getElementById('form');
const alertMessage = document.getElementById('alert');


document.addEventListener("DOMContentLoaded", () => {
  if(alertMessage != null){
    alertMessage.style.display ="none";
  
    if(sessionStorage.getItem('error') == 'error'){
      sessionStorage.clear();
      alertMessage.style.display =  "block";
    }
  }  
});

form.addEventListener('submit', (e)=>{
  sessionStorage.setItem('error', 'error');
})

