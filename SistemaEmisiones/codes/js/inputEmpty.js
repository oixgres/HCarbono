
const error = document.getElementsByClassName('d-flex ms-5 justify-content-center error');
var input = document.getElementsByClassName('form-control form-control-sm error');
const form = document.getElementById('form');

form.addEventListener('submit', (e)=>{
    let messages=[];

    if(input[1].value ==- ''){
      input[1].classList.remove("error");
      messages.push('puta');
    }

    if(messages.length > 0)
      e.preventDefault();
})
/*const form = document.getElementById("form").addEventListener('submit', verification);

function verification(e){
  for(var x in input)
  {
    if(x.value === '' || x.value==null){
      x.classList.remove("error");
      e.preventDefault();
    }
  }
}
*/
