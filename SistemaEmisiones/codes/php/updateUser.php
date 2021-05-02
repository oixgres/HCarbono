<?php
session_start();

require_once "phpFunctions.php";

checkSession("../../index.html");
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sistema Emisiones (Nombre en desarrollo)</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/pageStyle.css">
    <link rel="stylesheet" href="../css/inputStyle.css">
  </head>

  <body class="background-color">
    <nav class="navbar navbar-dark config-color">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">SISTEMA</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-sm config-button-navbar "href="adminPage.php">Regresar</a>
      </div>
    </nav>

    <section>
      <h1 class="mt-5 ms-5 d-flex justify-content-center">EDITAR REGISTRO</h1>

      <div class="container-fluid  mt-5">
        <form class="" action="updateUserDB.php" method="post">

          <input type="hidden" name="id" value="<?php  echo $_SESSION['Id']; ?>">
          <input type="hidden" name="idCompany" value="<?php  echo $_SESSION['IdEmpresa']; ?>">
          <input type="hidden" name="operation" value="<?php echo $_SESSION['Button'] ?>">
          <?php
            require_once "dataBaseLogin.php";
            require_once "phpFunctions.php";

            $company = getFirstQueryElement($connection, "Empresa", "Nombre", "idEmpresa", $_SESSION['IdEmpresa']);
            $device = getFirstQueryElement($connection, "Dispositivo", "Codigo", "Usuario_idUsuario", $_SESSION['Id'])
          ?>

          <!-- Enviar Correo al usuario -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-auto col-small d-flex justify-content-end">
              <label for="sendMailSection" class="">¿Enviar correo?</label>
            </div>
            <div class="col-auto form-small">
              <input
                class="form-check-input"
                id="sendMailSection"
                type="checkbox"
                value="good"
                name="sendMail"
              >
            </div>
          </div>

          <!-- Usuario -->
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

          <!-- Contraseña -->
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
                value="<?php echo $_SESSION['Password']; ?>"
                >
            </div>
          </div>

          <!-- Nombre -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
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
            <div class="d-flex ms-5 justify-content-center" data-error="Este campo debe ser llenado" >
            </div>
          </div>

          <!-- Compañia -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="companySection" class="">Compañia:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="companySection"
                name="company"
                value="<?php echo $company; ?>"
              >
            </div>
            <div class="d-flex ms-5 justify-content-center" data-error="Este campo debe ser llenado" >
            </div>
          </div>

          <!-- Dispositivo -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="$deviceSection" class="">Dispositivo:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="deviceSection"
                name="device"
                value="<?php echo $device; ?>"
              >
            </div>
            <div class="d-flex ms-5 justify-content-center" data-error="Este campo debe ser llenado" >
            </div>
          </div>

          <!-- Ciudad -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="citySection" class="">Ciudad:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="citySection"
                name="city"
                value="<?php echo $_SESSION['Ciudad']; ?>"
              >
            </div>
            <div class="d-flex ms-5 justify-content-center" data-error="Este campo debe ser llenado" >
            </div>
          </div>

          <!-- Correo -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="emailSection" class="">Correo de contacto:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="emailSection"
                name="email"
                value="<?php echo $_SESSION['Correo']; ?>"
              >
            </div>
            <div class="d-flex ms-5 justify-content-center" data-error="Este campo debe ser llenado" >
            </div>
          </div>

          <!-- Telefono -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-small d-flex justify-content-end">
              <label for="phoneSection" class="">Telefono:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm"
                id="phoneSection"
                name="phone"
                value="<?php echo $_SESSION['Telefono']; ?>"
              >
            </div>
            <div class="d-flex ms-5 justify-content-center" data-error="Este campo debe ser llenado" >
            </div>
          </div>

          <!-- Estatus -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-4">
            <div class="col-auto col-small d-flex justify-content-end">
              <label for="statusSection" class="">Aprobado:</label>
            </div>
            <div class="col-auto form-small">
              <input
                class="form-check-input"
                type="checkbox"
                value="good"
                name="admitted"
                <?php if($_SESSION['Aprobado'] == "Aprobado"): ?>
                  checked
                <?php endif; ?>
              >
            </div>
          </div>

          <div class="mt-5 ms-5 d-flex justify-content-center">
            <button type="submit" class="btn config-button"><?php echo $_SESSION['Button']; ?></button>
          </div>
        </form>
      </div>
      <script src="../js/checkInput.js" charset="utf-8"></script>
    </section>
  </body>
</html>
