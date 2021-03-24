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
        <a class="btn btn-sm config-button-navbar "href="../../index.html">Regresar</a>
      </div>
    </nav>
    
    <section>
      <?php
        require_once "processCRUD.php";
        include "dataBaseLogin.php";
        $connection = mysqli_connect($host, $user, $password, $bd);
        $result = mysqli_query($connection, "SELECT * FROM Usuario");
      ?>
      <!-- Tabla para mostrar los usuarios registrados -->
      <!-- <div class="mx-1 d-flex justify-content-center table-responsive"> -->
      <div class="mx-1 table-responsive">
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
                $res_company = mysqli_query($connection, "SELECT Nombre FROM Empresa WHERE idEmpresa='".$row['Empresa_idEmpresa']."'");
                $res_company = $res_company->fetch_array();
                $company = $res_company[0];
              ?>
              <td><?php echo  $company?></td>
              <td>
                <!-- Redireccion a pagina para editar el usuaro -->
                <a
                  href="adminPage.php?edit=<?php echo $row['idUsuario']; ?>"
                  class="btn btn-info">Editar
                </a>
                <!-- Se elimina el usuario en automatico -->
                <!-- AGREGAR WARN ANTES DE ELIMINAR -->
                <a
                  href="adminPage.php?delete=<?php echo $row['idUsuario']; ?>"
                  class="btn btn-danger">Borrar
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
        class="btn btn-info button-small mt-5 me-5">Nuevo
      </a>
    </div>
  </body>
</html>
