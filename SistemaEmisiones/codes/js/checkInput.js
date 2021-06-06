
const form = document.getElementById('register-form');
/* Los mensajes de error */
const errorMessage = document.getElementsByClassName('empty-input-message');
/* Inputs del usuario */
const input = document.getElementsByClassName('no-empty-input');

/* Inputs necesarias para enviar correo */
const sendMail = document.getElementById('sendMailSection');
const mailRequirements = document.getElementsByClassName('required-for-mail');
const errorMailMessage = document.getElementsByClassName('required-for-mail-message');

/*  Expresiones */
const expressions = {
	user: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	name: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	mail: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	phone: /^[\+]?\d{7,14}$/, // 7 a 14 numeros.
}

function removeErroClass(component, message, removeItem){
  component.classList.remove(removeItem);
  message.classList.remove(removeItem);
}

function addErrorClass(component, message, removeItem){
  component.classList.add(removeItem);
  message.classList.add(removeItem);
}

function validateInputs(component, message){
  switch(component.name){
    case 'name':
      if(!expressions.name.test(component.value)){
        message.setAttribute('data-error', 'No caracteres numericos, ni especiales');
        addErrorClass(component, message, 'error');
      }
      else
        removeErroClass(component, message, 'error');
    break;

    case 'company':
      if(component.value.includes(";")){
        message.setAttribute('data-error', 'Compañia invalda');
        addErrorClass(component, message, 'error');
      }
      else{
        removeErroClass(component,message, 'error');
      }
    break;
    case 'city':
      if(!expressions.name.test(component.value)){
        message.setAttribute('data-error', 'No caracteres numericos, ni especiales');
        addErrorClass(component, message, 'error');
      }
      else
        removeErroClass(component, message, 'error');
    break;
    
    case 'email':
      if(!expressions.mail.test(component.value)){
        message.setAttribute('data-error', 'Correo invalido');
        addErrorClass(component, message, 'error');
      }
      else
        removeErroClass(component, message, 'error');
    break;

    case 'phone':
      if(!expressions.phone.test(component.value)){
        message.setAttribute('data-error', 'Numero telefonico invalido');
        addErrorClass(component, message, 'error');
      }
      else
        removeErroClass(component, message, 'error');
    break;
  }

  //message.setAttribute('data-error', previousMessage);
}


/* Agregamos eventListener a todos los input para que cuando un error sea modificado desaparezcan las señales de error */
for(let i = 0; i < input.length; i++)
{
  input[i].addEventListener('input', ()=>{
    if (input[i].value != '' && input[i].value != null){
      validateInputs(input[i],errorMessage[i]);
    }
    else{
      removeErroClass(input[i], errorMessage[i], 'error')
    }
  })
}

/* Al ingresar datos se eliminan los mensajes de error */
for(let i = 0; i < mailRequirements.length; i++)
{
  mailRequirements[i].addEventListener('input', ()=>{
    if(mailRequirements[i].value != '' && mailRequirements[i].value != null){
      removeErroClass(mailRequirements[i], errorMailMessage[i], 'error');
    }
  })
}

if(sendMail){
  sendMail.addEventListener('click', (e)=>{
    let errorCount = 0;
    
    for(var i = 0; i < mailRequirements.length; i++)
    {
      if(mailRequirements[i].value  === '' || mailRequirements[i].value == null || (mailRequirements[i].type == "checkbox" && mailRequirements[i].checked == false)){
        addErrorClass(mailRequirements[i], errorMailMessage[i], 'error')
        
        errorCount++;
      }
    }
    
    if(errorCount > 0)
      sendMail.checked = null;
  });
}

/* Al dar click a enviar se verifica que todos los campos tengan contenido */
form.addEventListener('submit', (e)=>{
  let errorCount = 0;

  /* Hace chequeo de que los inputs tengan contenido */
  for(var i = 0; i < input.length; i++)
  {
    if (input[i].value === '' || input[i].value == null){
      errorMessage[i].setAttribute('data-error', 'Esta campo debe ser llenado');
      addErrorClass(input[i], errorMessage[i], 'error');
    }
    else{
      validateInputs(input[i], errorMessage[i]);
    }
      
    if(input[i].classList.contains('error')){
      errorCount++;
    }
  }

  /* Si se selecciono enviar correo verificamos que los campos username y password esten completos */
  if(sendMail){
    if(sendMail.checked){
      for(var i = 0; i < mailRequirements.length; i++)
      {
        if(mailRequirements[i].value  === '' || mailRequirements[i].value == null ||(mailRequirements[i].type == "checkbox" && mailRequirements[i].checked == false)){
          addErrorClass(mailRequirements[i], errorMailMessage[i], 'error')
          
          sendMail.checked = false;
          e.preventDefault();
        }
      } 
    }  
  }
  /* Si se encontro un error se impide el enviar los datos */
  if(errorCount> 0)
    e.preventDefault();
});