/* Sin mensaje de error */
const errorMessage = document.getElementsByClassName('d-flex ms-5 justify-content-center');

/* Entrada sin errores */
const input = document.getElementsByClassName('form-control form-control-sm interactable');

const inputError = document.getElementsByClassName('form-control form-control-sm interactable error');

const form = document.getElementById('form');

for(let i = 0; i < input.length; i++)
{
  input[i].addEventListener('input', ()=>{
    if (input[i].value != '' && input[i].value != null){
      input[i].classList.remove("error");
      errorMessage[i+1].classList.remove("error");
    }
  })
}

form.addEventListener('submit', (e)=>{
  let errorCount = 0;

  /* Hace chequeo de que los inputs esten correctos */
  for(var i = 0; i < input.length; i++)
  {
    if (input[i].value === '' || input[i].value == null){
      input[i].classList.add("error");
      errorMessage[i+1].classList.add("error");

      errorCount++;
    }
  }

  if(errorCount> 0)
    e.preventDefault();
});
