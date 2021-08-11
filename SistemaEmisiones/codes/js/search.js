const searchForm = document.getElementById('search-form');

searchForm.addEventListener('submit', (e)=>{
  console.log($(searchForm).serialize());

  e.preventDefault();
});