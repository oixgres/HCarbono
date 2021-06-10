<?php
session_start();

require_once "phpFunctions.php";

checkSession('admin',"../../index.html");
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>H.Carbono | <?php echo  $_SESSION['Button'];?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../css/pageStyle.css">
    <link rel="stylesheet" href="../css/inputStyle.css">
  </head>

  <body class="background-color">
    <nav class="navbar navbar-dark config-color">
      <div class="container-fluid">
        <a class="navbar-brand" href="../../index.html">H.CARBONO</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-sm config-button-navbar "href="adminPage.php">Regresar</a>
      </div>
    </nav>

    <section>
      <h1 class="mt-5 ms-5 d-flex justify-content-center">EDITAR REGISTRO</h1>

      <div class="container-fluid d-flex justify-content-center mt-5">
        <!-- <form id="register-form" action="updateUserDB.php" method="post"> -->
        <form id="register-form">
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
              <label for="sendMailSection">¿Enviar correo?</label>
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
          <div class="row g-3 align-items-center d-flex justify-content-center">
            <div class="col-small d-flex justify-content-end">
              <label for="userSection">Usuario:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm required-for-mail"
                id="userSection"
                name="user"
                placeholder="Ingresar usuario"
                value="<?php  echo $_SESSION['Username']; ?>"
              >
            </div>
          </div>
          <!-- Mensaje de error para Usuario -->
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="user"
              class="col-auto form-small d-flex required-for-mail-message"
              data-error="Campo requerido para enviar correo">
            </div>
          </div>

          <!-- Contraseña -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-small d-flex justify-content-end">
              <label for="passSection">Contraseña:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm required-for-mail"
                id="passSection"
                name="pass"
                placeholder="Ingresar contraseña"
                value="<?php echo $_SESSION['Password']; ?>"
                >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="pass"
              class="col-auto form-small d-flex required-for-mail-message"
              data-error="Campo requerido para enviar correo">
            </div>
          </div>

          <!-- Nombre -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-small d-flex justify-content-end">
              <label for="nameSection">Nombre Completo:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm no-empty-input"
                id="nameSection"
                name="name"
                placeholder="Ingresar nombre completo"
                value="<?php  echo $_SESSION['Nombre']; ?>"
              >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="name"
              class="col-auto form-small d-flex empty-input-message"
              data-error="Este campo debe ser llenado">
            </div>
          </div>

          <!-- Compañia -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-small d-flex justify-content-end">
              <label for="companySection">Compañia:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm no-empty-input"
                id="companySection"
                name="company"
                placeholder="Ingresar compañia"
                value="<?php echo $company; ?>"
              >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="company"
              class="col-auto form-small d-flex empty-input-message"
              data-error="Este campo debe ser llenado">
            </div>
          </div>

          <!-- Dispositivo -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-small d-flex justify-content-end">
              <label for="deviceSection">Dispositivo:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm no-empty-input"
                id="deviceSection"
                name="device"
                placeholder="Ingresar dispositivo"
                value="<?php echo $device; ?>"
              >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="device"
              class="col-auto form-small d-flex empty-input-message"
              data-error="Este campo debe ser llenado">
            </div>
          </div>

          <!-- Ciudad -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-small d-flex justify-content-end">
              <label for="citySection">Ciudad:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm no-empty-input"
                id="citySection"
                name="city"
                placeholder="Ingresar ciudad"
                value="<?php echo $_SESSION['Ciudad']; ?>"
              >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="city"
              class="col-auto form-small d-flex empty-input-message"
              data-error="Este campo debe ser llenado">
            </div>
          </div>

          <!-- Correo -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-small d-flex justify-content-end">
              <label for="emailSection">Correo de contacto:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm no-empty-input"
                id="emailSection"
                name="email"
                placeholder="Ingresar correo electronico"
                value="<?php echo $_SESSION['Correo']; ?>"
              >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="email"
              class="col-auto form-small d-flex empty-input-message"
              data-error="Este campo debe ser llenado">
            </div>
          </div>

          <!-- Telefono -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-small d-flex justify-content-end">
              <label for="phoneSection">Telefono:</label>
            </div>
            <div class="col-auto form-small">
              <input
                type="text"
                class="form-control form-control-sm no-empty-input"
                id="phoneSection"
                name="phone"
                placeholder="Ingresar numero telefonico"
                value="<?php echo $_SESSION['Telefono']; ?>"
              >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="phone"
              class="col-auto form-small d-flex empty-input-message"
              data-error="Este campo debe ser llenado">
            </div>
          </div>

          <!-- Estatus -->
          <div class="row g-3 align-items-center d-flex justify-content-center mt-1">
            <div class="col-auto col-small d-flex justify-content-end">
              <label for="statusSection">Aprobado:</label>
            </div>
            <div class="col-auto form-small">
              <input
                class="form-check-input required-for-mail"
                type="checkbox"
                value="good"
                name="admitted"
                <?php if($_SESSION['Aprobado'] == "Aprobado"): ?>
                  checked
                <?php endif; ?>
              >
            </div>
          </div>
          <div class="row g-3 align-items-center d-flex justify-content-center mb-3">
            <div class="col-small"></div>
            <div
              name="admitted"
              class="col-auto form-small d-flex required-for-mail-message"
              data-error="Campo requerido para enviar correo">
            </div>
          </div>

          <div class="mt-5 ms-5 d-flex justify-content-center">
            <button type="submit" class="btn config-button"><?php echo $_SESSION['Button']; ?></button>
          </div>
        </form>
      </div>
      <script src="../js/checkInput.js" charset="utf-8"></script>
      <script src="../js/updateUser.js" charset="utf-8"></script>
    </section>
  </body>
</html>

