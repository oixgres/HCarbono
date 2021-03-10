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
      <?php
        include "../php/dataBaseLogin.php";
        $connection = mysqli_connect($host, $user, $password, $bd);
        $result = mysqli_query($connection, "SELECT * FROM Usuario");
      ?>

      <div class="ms-5 d-flex justify-content-center">
        <table class="table">
          <!--Cabeza de la tabla-->
          <thead>
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Contraseña</th>
              <th>Nombre</th>
              <th>Ciudad</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Empresa</th>
            </tr>
          </thead>

          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['idUsuario']; ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
    </section>
  </body>
</html>
