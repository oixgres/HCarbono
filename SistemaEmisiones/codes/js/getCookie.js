function getCookie(cookie){
  let cookies = document.cookie.split(";");

  for(let i = 0; 0 < cookies; i++){
    let cookieContent = cookies[i].split('=');

    if(cookie == cookieContent[0].trim())
      return decodeURIComponent(cookieContent[1])
  }

  return null;
}