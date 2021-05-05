/* Los mensajes de error */
const errorMessage = document.getElementsByClassName('d-flex ms-5 justify-content-center');

/* Inputs del usuario */
const input = document.getElementsByClassName('form-control form-control-sm interactable');

const form = document.getElementById('form');

/* Agregamos eventListener a todos los input para que cuando un error sea modificado desaparezcan las señales */
for(let i = 0; i < input.length; i++)
{
  input[i].addEventListener('input', ()=>{
    if (input[i].value != '' && input[i].value != null){
      input[i].classList.remove("error");
      errorMessage[i+1].classList.remove("error");
    }
  })
}

/* Al dar click a enviar se verifica que todos los campos tengan contenido */
form.addEventListener('submit', (e)=>{
  let errorCount = 0;

  /* Hace chequeo de que los inputs tengan contenido */
  for(var i = 0; i < input.length; i++)
  {
    if (input[i].value === '' || input[i].value == null){
      input[i].classList.add("error");
      errorMessage[i+1].classList.add("error");

      errorCount++;
    }
  }

  /* Si se encontro un error se impide el enviar los datos */
  if(errorCount> 0)
    e.preventDefault();
});
