
const form = document.getElementById('form');
/* Los mensajes de error */
const errorMessage = document.getElementsByClassName('empty-input-message');
/* Inputs del usuario */
const input = document.getElementsByClassName('no-empty-input');

const sendMail = document.getElementById('sendMailSection');
const mailRequirements = document.getElementsByClassName('required-for-mail');
const errorMailMessage = document.getElementsByClassName('en-espera')

/* Agregamos eventListener a todos los input para que cuando un error sea modificado desaparezcan las señales */
for(let i = 0; i < input.length; i++)
{
  input[i].addEventListener('input', ()=>{
    if (input[i].value != '' && input[i].value != null){
      input[i].classList.remove("error");
      errorMessage[i].classList.remove("error");
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
      errorMessage[i].classList.add("error");

      errorCount++;
    }
  }

  /**/
  if(sendMail.checked){
    for(var i = 0; i < mailRequirements.length; i++)
    {
      if(mailRequirements[i].value  === '' || mailRequirements[i].value == null){
        mailRequirements[i].classList.add("error");
  
        sendMail.checked = false;
        e.preventDefault();
      }
    }
  
  }

  /* Si se encontro un error se impide el enviar los datos */
  if(errorCount> 0)
    e.preventDefault();
});

sendMail.addEventListener('click', (e)=>{
  let errorCount = 0;

  for(var i = 0; i < mailRequirements.length; i++)
  {
    if(mailRequirements[i].value  === '' || mailRequirements[i].value == null){
      mailRequirements[i].classList.add("error");

      errorCount++;
    }
  }

  if(errorCount > 0)
    sendMail.checked = null;
});