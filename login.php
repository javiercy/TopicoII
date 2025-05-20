<?php
session_start();
require_once 'Usuario.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';

    $usuarioObj = Usuario::autenticar($usuario, $clave, 'usuarios.csv');

    if ($usuarioObj) {
        $_SESSION['usuario'] = $usuarioObj->getNombre();
        header('Location: panel.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

  <header>
    <h1>Gestor de Libros</h1>
    <p>Bienvenido al sistema de gestión de libros</p>
  </header>

  <nav>
    <a href="index.php">Inicio</a>
    <a href="registro.php">Registrar Libro</a>
    <a href="consulta.php">Consultar Libros</a>
  </nav>

  <section>
    <h2>Iniciar Sesión</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Usuario: <input type="text" name="usuario" required></label><br>
        <label>Contraseña: <input type="password" name="clave" required></label><br>
        <button type="submit">Entrar</button>
    </form>

    <p>¿No tienes cuenta? <a href="registrar.php">Regístrate aquí</a></p>
  </section>

  <footer>
    <p>© 2025 Gestor de Libros. Todos los derechos reservados.</p>
  </footer>

</body>
</html>