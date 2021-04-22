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
        <a class="navbar-brand" href="../../index.html">SISTEMA</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-sm config-button-navbar "href="logout.php">Salir</a>
      </div>
    </nav>

    <section>
      <?php
        require_once "dataBaseLogin.php";
        require_once "processCRUD.php";
        require_once "phpFunctions.php";

        $result = mysqli_query($connection, "SELECT * FROM Usuario");
      ?>
      <!-- Tabla para mostrar los usuarios registrados -->
      <!-- <div class="mx-1 d-flex justify-content-center table-responsive"> -->
      <div class="mx-5 mt-5 table-responsive">
        <table class="table">
          <!--Cabeza de la tabla-->
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Contraseña</th>
              <th>Nombre</th>
              <th>Ciudad</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Empresa</th>
              <th>Accion</th>
            </tr>
          </thead>

          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['Username']; ?></td>
              <td><?php echo $row['Password']; ?></td>
              <td><?php echo $row['Nombre']; ?></td>
              <td><?php echo $row['Ciudad']; ?></td>
              <td><?php echo $row['Correo']; ?></td>
              <td><?php echo $row['Telefono']; ?></td>
              <td><?php echo $row['Aprobado']; ?></td>

              <!-- Obtenemos el nombre de la empresa -->
              <?php
                $company = getFirstQueryElement($connection, "Empresa", "Nombre", "idEmpresa", $row['Empresa_idEmpresa']);
              ?>

              <td><?php echo  $company?></td>
              <td>
                <!-- Redireccion a pagina para editar el usuaro -->
                <a
                  href="adminPage.php?edit=<?php echo $row['idUsuario']; ?>"
                  class="btn config-button">Editar
                </a>
                <!-- Se elimina el usuario en automatico -->
                <!-- AGREGAR WARN ANTES DE ELIMINAR -->
                <a
                  href="adminPage.php?delete=<?php echo $row['idUsuario']; ?>"
                  class="btn config-button-danger">Borrar
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
    </section>

    <!-- Boton para crear usuarios -->
    <div class="d-grid d-md-flex justify-content-md-end">
      <a
        href="adminPage.php?create=<?php echo $row['idUsuario']; ?>"
        class="btn config-button mt-5 me-5 mb-5">Nuevo
      </a>
    </div>
  </body>
</html>
