<?php 
require_once 'dataBaseLogin.php';

$query = "DELETE FROM Estadisticas WHERE Usuario_idUsuario='".$_COOKIE['idUsuario']."'";
mysqli_query($connection,$query);

header("location: userPage.php");
exit();
?>