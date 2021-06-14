document.addEventListener('DOMContentLoaded', ()=>{
  if(!sessionStorage.getItem('new'))
    window.location = '../../index.html';
  else
    sessionStorage.clear();
});