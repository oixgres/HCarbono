<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sistema Emisiones (Nombre en desarrollo)</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/pageStyle.css">
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
            include "dataBaseLogin.php";

            $connection = mysqli_connect($host, $user, $password, $bd);
            $query = mysqli_query($connection, "SELECT Nombre FROM Empresa WHERE idEmpresa='".$_SESSION['IdEmpresa']."'");
            $query = $query->fetch_array();
            $company = $query[0];
          ?>

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
                value="<?php echo $_SESSION['Password']; ?>"
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
              <input
                type="text"
                class="form-control form-control-sm"
                id="companySection"
                name="company"
                value="<?php echo $company; ?>"
              >
            </div>
          </div>

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
          </div>

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
          </div>

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
          </div>

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
    </section>
  </body>
</html>
