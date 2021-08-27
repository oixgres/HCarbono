<?php
require_once "phpFunctions.php";

checkSession('admin', "../../index.html");
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>H. Carbono | Administrador</title>

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

    <!-- Originales -->
    <link rel="stylesheet" href="../css/pageStyle.css">
    <link rel="stylesheet" href="../css/popupStyle.css">
  </head>

  <body class="background-color">
    
    <!-- Navegador de la pagina -->
    <nav class="navbar navbar-dark config-color">
      <div class="container-fluid">
        <a class="navbar-brand" href="../../index.html">H.CARBONO</a>
        <ul class="navbar-nav me-auto justify-content-end">
        </ul>
        <a class="btn btn-sm config-button-navbar "href="logout.php">Salir</a>
      </div>
    </nav>

    <?php
      require_once "dataBaseLogin.php";

      /* Funciones CRUD */
      require_once "processCRUD.php";

      /* Obtenemos los usuarios */
      $result = mysqli_query($connection, "SELECT * FROM Usuario");
    ?>

    <!-- Tabla para mostrar los usuarios registrados -->
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
            <th>Dispositivo</th>
            <th>Accion</th>
          </tr>
        </thead>

        <!-- Renglones de la tabla -->
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
              $company = getFirstQueryElement(
                $connection,
                "Empresa",
                "Nombre",
                "idEmpresa",
                $row['Empresa_idEmpresa']
              );
            ?>
            <td><?php echo  $company; ?></td>

            <!-- Obtenemos el codigo del dispositivo -->
            <?php
              $device = getFirstQueryElement(
                $connection,
                "Dispositivo",
                "Codigo",
                "Usuario_idUsuario",
                $row['idUsuario']
              );
            ?>
            <td><?php echo $device; ?></td>

            <!-- Botones del renglon -->
            <td>
              <div class="d-flex justify-content-end">
                <!-- Editar usuaro -->
                <a
                  href="adminPage.php?edit=<?php echo $row['idUsuario']; ?>"
                  class="btn config-button"
                >Editar</a>

                <!-- Eliminar Usuario -->
                <a
                  id="adminPage.php?delete=<?php echo $row['idUsuario']; ?>"
                  onclick="toggleDeletePopup(this)"
                  class="btn config-button-danger mx-3"
                >Borrar</a>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <!-- Boton para crear usuarios -->
    <div class="d-flex justify-content-end">
      <a
        href="adminPage.php?create=<?php echo $row['idUsuario']; ?>"
        class="btn config-button mt-5 me-5 mb-5">Nuevo
      </a>
    </div>

    <!-- Popup eliminar usuarios -->
    <div class="popup" id="popup-delete">
      <div class="overlay"></div>
      <div class="content">
        <div class="close-button" onclick="toggleDeletePopup(1)">&times;</div>
        <h1 class="danger-text">ADVERTENCIA</h1>
        <p>Una vez eliminado este usuario sus datos se perderan para siempre.</p>
        <p>¿Desea continuar?</p>
        <a
          id="popup-delete-button"
          class="btn config-button-danger"
        >Borrar</a>
      </div>
    </div>
    <script src="../js/popup.js"></script>
    <script type="text/javascript">
      sessionStorage.removeItem('error');
    </script>
  </body>
</html>
