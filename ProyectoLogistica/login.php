<?php
require_once "modelo/conexion.php";
session_start(); 
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $usuario=$_POST["usuario"] ?? '';
  $clave=$_POST["clave"] ?? '';

  $db=conexion::conectar();
  $sql="SELECT * FROM usuarios WHERE usuario = :usuario";
  $stmt= $db -> prepare($sql);
  $stmt -> bindParam(":usuario",$usuario);
  $stmt -> execute();
  if($stmt ->rowCount() == 1){
    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);
    if($clave ==$usuarioData['clave']){
      $_SESSION['usuario'] = $usuarioData['usuario'];
      header("Location: index.php");
      exit();
    }else{
      echo "Contraseña Incorrecta";
    }
  }else{
    echo "Usuario no encontrado";
  }
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Login - Logística</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo/login.css">
  </head>
  <body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 350px;">
      <img src="imagenes/logo.png" alt="">

      <form method="POST" action="login.php">
        <div class="mb-3">
          <input type="text" id="usuario" name="usuario" class="form-control" required>
          <label for="usuario" class="form-label">Usuario</label>
        </div>
        <div class="mb-3">
          <input type="password" id="clave" name="clave" class="form-control" required>
          <label for="clave" class="form-label">Contraseña</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Iniciar Sesion</button>
      </form>
    </div>

  </body>
</html>
