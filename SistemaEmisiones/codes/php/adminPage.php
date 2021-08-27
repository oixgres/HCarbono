<?php
require_once 'phpFunctions.php';

checkSession('admin', '../../index.html');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>H. Carbono | Administrador</title>

    <link rel="stylesheet" href="">

    <!-- Bootstrap -->
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    >
    <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>

    <!-- jquery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <!-- Originales -->
    <link rel="stylesheet" href="../css/pageStyle.css">
    <link rel="stylesheet" href="../css/searchStyle.css">
    <link rel="stylesheet" href="../css/popupStyle.css">
  </head>

  <body>
    <!-- Buscador de usuarios -->
    <div class="searchbox-config">
      <div class="input-group">
        <input id="search-input" type="text" placeholder="Buscar Usuario" class="form-control">
        <!-- <button class="btn config-button" id="search-button" style="z-index:0;">
          <img src="../../images/search-white.svg" alt="">
        </button> -->
        <div class="dropdown">
          <button 
            class="btn dropdown-toggle config-button-search"
            type="button"
            id="search-button"
            data-bs-toggle="dropdown"
            aria-expanded="false">
          Nombre</button>
        <ul class="dropdown-menu" aria-labelledby="search-button">
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Usuario</button></li>
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Contraseña</button></li>
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Nombre</button></li>
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Ciudad</button></li>
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Correo</button></li>
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Telefono</button></li>
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Empresa</button></li>
          <li><button class="dropdown-item" onclick="changeSearch(this);" type="button">Dispositivo</button></li>
        </ul>
</div>
      </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="mx-5 mt-5 table-responsive">
      <table id="users-table" class="table"></table>
    </div>

    <!-- Boton para crear usuarios -->
    <div class="d-flex justify-content-end">
      <button
        class="btn config-button mt-5 me-5 mb-5"
        onclick="updateButton(false)"
      >Nuevo</button>
    </div>

    <!-- Popup eliminar usuarios -->
    <div class="popup" id="popup-delete">
      <div class="overlay"></div>
      <div class="content">
        <div class="close-button" onclick="toggleDeletePopup(1)">&times;</div>
        <h1 class="danger-text">ADVERTENCIA</h1>
        <p>Una vez eliminado este usuario sus datos se perderan para siempre.</p>
        <p>¿Desea continuar?</p>
        <button
          id="popup-delete-button"
          class="btn config-button-danger"
          value="null"
        >Borrar</button>
      </div>
    </div>
    <script src="../js/popup.js"></script>

    <!-- Archivos para realizar la busqueda -->
    <script src="../js/table.js"></script>
    <script src="../js/search.js"></script>
    <script type="text/javascript">
      sessionStorage.removeItem('error');
    </script>
  </body>
</html>