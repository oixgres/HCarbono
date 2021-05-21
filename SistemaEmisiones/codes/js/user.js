const alertMessage = document.getElementById('alert')

document.addEventListener('DOMContentLoaded', ()=>{
  let device = getCookie('Device');
  
  if(sessionStorage.getItem('error')){
    sessionStorage.removeItem('error');
  }

  if(alertMessage != null && device != null){
  }
})