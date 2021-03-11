<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sistema Emisiones (Nombre en desarrollo)</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
  </head>

  <body class="page-settings">
    <nav class="navbar navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">SISTEMA</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-primary btn-sm button-settings "href="../../index.html">Regresar</a>
      </div>
    </nav>

    <section>
      <h1 class="mt-5 ms-5 d-flex justify-content-center">EDITAR REGISTRO</h1>

      <div class="container-fluid  mt-5">
        <form class="" action="../php/registration.php" method="post">
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-auto col-small d-flex justify-content-end">
              <label for="userSection" class="">Usuario:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="userSection"
                name="user"
                value="<?php  echo $_SESSION['Username']; ?>"
              >
            </div>
          </div>

          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-auto col-small d-flex justify-content-end">
              <label for="passSection" class="">Contraseña:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="passSection"
                name="pass"
                value="Chinocochino"
                >
            </div>
          </div>


          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-auto col-small d-flex justify-content-end">
              <label for="nameSection" class="">Nombre Completo:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="nameSection"
                name="name"
                value="<?php  echo $_SESSION['Nombre']; ?>"
              >
            </div>
          </div>

          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="companySection" class="">Compañia:</label>
            </div>
            <div class="col-auto form-small">
              <input type="text" class="form-control form-control-sm" id="companySection" name="company">
            </div>
          </div>

          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="citySection" class="">Ciudad:</label>
            </div>
            <div class="col-auto form-small">
              <input type="text" class="form-control form-control-sm" id="citySection" name="city">
            </div>
          </div>

          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="emailSection" class="">Correo de contacto:</label>
            </div>
            <div class="col-auto form-small">
              <input type="text" class="form-control form-control-sm" id="emailSection" name="email">
            </div>
          </div>

          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="phoneSection" class="">Telefono:</label>
            </div>
            <div class="col-auto form-small">
              <input type="text" class="form-control form-control-sm" id="phoneSection" name="phone">
            </div>
          </div>

          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-auto col-small d-flex justify-content-end">
              <label for="statusSection" class="">Estado:</label>
            </div>
            <div class="col-auto form-small">
              <!--<input type="text" class="form-control form-control-sm" id="statusSection" name="name">-->
              <div class="input-group-text">
                  <input class="form-check-input mt-0" type="checkbox">
              </div>
            </div>
          </div>

          <div class="mt-5 ms-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Registrar</button>
          </div>
        </form>
      </div>
    </section>
  </body>
</html>
