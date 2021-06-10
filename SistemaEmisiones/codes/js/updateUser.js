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
  else{
    $.ajax({
      type: 'POST',
      url: '../php/updateUserDB.php',
      data: $(form).serialize(),
      success: function(response){
        console.log(response);

        let json = JSON.parse(response);

        if(json.location)
          window.location = json.location;
        else{
          if(json.type == 'input_error'){
            errorMessage.namedItem(json.input).setAttribute('data-error', json.error);
            addErrorClass(input.namedItem(json.input), errorMessage.namedItem(json.input), 'error');
          }
          else{
            //aplicar lo mismo pero para correo
          }
        }

        // if(response == 'CORREO UTILIZADO' || 'USUARIO UTILIZADO')
        //   console.log(response);
        // else
        //   window.location = response;
      }
    })
  }
});