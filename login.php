<?php
require_once "modelo/conexion.php";
session_start(); 

$mensaje = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario = trim($_POST["usuario"] ?? '');
  $clave = trim($_POST["clave"] ?? '');

  $db = conexion::conectar();
  $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(":usuario", $usuario);
  $stmt->execute();

  if ($stmt->rowCount() == 1) {
    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($clave === $usuarioData['clave']) {
      $_SESSION['usuario'] = $usuarioData['usuario'];
      header("Location: index.php");
      exit();
    } else {
      $mensaje = "⚠️ Contraseña incorrecta";
    }
  } else {
    $mensaje = "⚠️ Usuario no encontrado";
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
<body class="d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow p-4 text-center" style="width: 350px; background-color: #0a0e1a;">
    <img src="imagenes/logo.png" alt="Logo" class="mb-3" style="max-width: 150px; margin: auto;">

    <!-- ALERTA SOLO SI HAY MENSAJE -->
    <?php if (!empty($mensaje)): ?>
      <div class="alert alert-danger py-2 mb-3 fade show" role="alert">
        <?= htmlspecialchars($mensaje) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="mt-2">
      <div class="mb-3 text-start">
        <label for="usuario" class="form-label text-light">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" required autofocus>
      </div>
      <div class="mb-3 text-start">
        <label for="clave" class="form-label text-light">Contraseña</label>
        <input type="password" id="clave" name="clave" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    </form>
  </div>

  <!-- SCRIPT OPCIONAL PARA OCULTAR ALERTA DESPUÉS DE 3 SEGUNDOS -->
  <?php if (!empty($mensaje)): ?>
  <script>
    setTimeout(() => {
      const alert = document.querySelector('.alert');
      if (alert) {
        alert.classList.remove('show');
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 500);
      }
    }, 3000);
  </script>
  <?php endif; ?>
</body>
</html>
