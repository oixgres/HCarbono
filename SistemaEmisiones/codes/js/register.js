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
  
  /* Si se encontro un error se impide el enviar los datos */
  if(errorCount> 0)
    e.preventDefault();
  else{
    /* Si no hay errores enviamos datos y recibimos respuesta */
    $.ajax({
      type: 'POST',
      url: '../php/newUser.php',
      data: $(form).serialize(),
      success: function(response){
        if(response == 'CORREO UTILIZADO'){
          console.log(response);
          errorMessage.namedItem('email').setAttribute('data-error', 'Este correo ya ha sido registrado')
          addErrorClass(input.namedItem('email'), errorMessage.namedItem('email'), 'error');
        }
        else
          window.location = response;
      }
    })
    e.preventDefault();
  }
});