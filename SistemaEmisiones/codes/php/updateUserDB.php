<?php
require_once "dataBaseLogin.php";
require_once "phpFunctions.php";

if ($connection)
{
  $id = $_POST['id'];
  $username = $_POST['user'];
  $pass = $_POST['pass'];
  $name = $_POST["name"];
  $company = $_POST["company"];
  $device = $_POST["device"];
  $city = $_POST["city"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $operation = $_POST["operation"];


  if(!empty($_POST['admitted']))
    $admitted = "Aprobado";
  else
    $admitted = "No Aprobado";

  /*Recuperamos el anterior Username del usuario*/
  $pastUsername = getFirstQueryElement($connection, "Usuario", "Username", "idUsuario", $id);
  $pastPassword = getFirstQueryElement($connection, "Usuario", "Password", "idUsuario", $id);
  $pastAdmitted = getFirstQueryElement($connection, "Usuario", "Aprobado", "idUsuario", $id);

  /* Verificamos que el username no este registrado*/
  $query = "SELECT * FROM Usuario WHERE Username='".$username."'";
  $query_result = mysqli_query($connection, $query);
  $nru = mysqli_num_rows($query_result);

  $query = "SELECT * FROM Administrador WHERE Username='".$username."'";
  $query_result = mysqli_query($connection, $query);
  $nru = $nru + mysqli_num_rows($query_result);

  /* Verificamos que la empresa a actualizar exista */
  $query = mysqli_query($connection, "SELECT * FROM Empresa WHERE Nombre='".$company."'");
  $nrc = mysqli_num_rows($query);

  /* Obtenemos el id de la empresa */
  $id_company = intval(getFirstQueryElement($connection, "Empresa", "idEmpresa", "Nombre", $company));

  /* Si el username esta registrado y si es diferente de si mismo */
  if($nru > 0 && $username != $pastUsername && $username!='')
  {
    echo "Usuario ya utilizado, ingrese otro";
  }
  else
    /* Creamos Usuario */
    if ($operation == "Crear")
    {
      /* Verificamos que no se repita la empresa */
      $query = "SELECT * FROM Empresa WHERE Nombre='".$company."'";
      $res_query = mysqli_query($connection, $query);
      $nr = mysqli_num_rows($res_query);

      /*Si no existe la empresa la registramos*/
      if($nr == 0)
      {
        /*Registramos compañia*/
        $query = "INSERT INTO Empresa(Nombre) VALUES ('$company')";
        mysqli_query($connection, $query);
      }

      /* Creamos el usuario */
      $query = "INSERT INTO Usuario(Username, Password, Nombre, Ciudad, Correo, Telefono, Aprobado, Empresa_idEmpresa) VALUES ('$username', '$pass', '$name', '$city', '$email', '$phone', '$admitted', '$id_company')";
      mysqli_query($connection, $query);

      /* Creamos el dispositivo */
      mysqli_query($connection, "INSERT INTO Dispositivo(Nombre,Usuario_idUsuario) VALUES('$device', '$id')");

      /* Enviamos correo */
      if($username != '' && $pass != '' && $admitted == "Aprobado")
      {
        $message = "Bienvenido a hcarbono \n\r\n\r";
        $message.= "Se ha creado una cuenta en hcarbono.com \n\r";
        $message.= "Su username es: ".$username."\n\r";
        $message.= "Su contraseña es: ".$pass."\n\r";

        sendMail($email, "Nueva Cuenta hcarbono", $message);
      }



      header("Location: adminPage.php");
      exit();
    }
    else
      if($nrc != 1)
      {
        echo "La compañia no existe";
      }
      else
        if($operation == "Actualizar")
        {
          /*Obtenemos el ID de la compañia */
          $query = "SELECT idEmpresa FROM Empresa WHERE Nombre = '".$company."'";
          $res_query = mysqli_query($connection, $query);
          $res_query = $res_query->fetch_array();
          $id_company = intval($res_query[0]);

          /* Actualizamos Usuario */
          $query = "UPDATE Usuario SET Username='".$username."', Password='".$pass."', Nombre='".$name."', Ciudad='".$city."', Correo='".$email."', Telefono='".$phone."', Aprobado='".$admitted."', Empresa_idEmpresa='".$id_company."' WHERE idUsuario='".$id."'";
          mysqli_query($connection, $query);

          /* Actualizamos dispositivo */
          mysqli_query($connection, "UPDATE Dispositivo SET Nombre='".$device."'");

          /* Enviamos correo cuando se cambia nombre o contraseña */
          if($username != '' && $pass != '' && $admitted == "Aprobado" && ($username!=$pastUsername || $pass != $pastPassword))
          {
            $message = "Saludos de parte de hcarbono \n\r\n\r";
            $message.= "Se han realizado modificaciones a sus datos \n\r";
            $message.= "Su username actualizado es: ".$username."\n\r";
            $message.= "Su contraseña actualizada es: ".$pass."\n\r";

            sendMail($email, "Cambio de datos hcarbono", $message);
          }
          else
            /* Enviamos correo si la cuenta es autorizada */
            if($username != '' && $pass != '' && $pastAdmitted = "No Aprobado" && $admitted=="Aprobado")
            {
              $message = "Saludos de parte de hcarbono \n\r\n\r";
              $message.= "Se han realizado modificaciones a sus datos \n\r";
              $message.= "Su username actualizado es: ".$username."\n\r";
              $message.= "Su contraseña actualizada es: ".$pass."\n\r";

              sendMail($email, "Cambio de datos hcarbono", $message);
            }

          header("Location: adminPage.php");
          exit();
        }
        else
          echo "No se pudo realizar ninguna operacion";
}
else
{
  echo "No se logro conectar al servidor";
}
 ?>
