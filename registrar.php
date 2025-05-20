<?php
require_once 'Usuario.php';
session_start();

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave = trim($_POST['clave'] ?? '');
    $clave2 = trim($_POST['clave2'] ?? '');

    if (empty($usuario) || empty($clave) || empty($clave2)) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($clave !== $clave2) {
        $error = "Las contraseñas no coinciden.";
    } else {
        if (Usuario::registrar($usuario, $clave, 'usuarios.csv')) {
            $mensaje = "Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a>";
        } else {
            $error = "El usuario ya existe.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
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
        <a href="login.php">Iniciar sesión</a>
    </nav>

    <section>
        <h2>Registrar Usuario</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php elseif ($mensaje): ?>
            <p style="color:green;"><?php echo $mensaje; ?></p>
        <?php endif; ?>
        <form method="post" action="registrar.php">
            <label>Usuario: <input type="text" name="usuario" required></label><br>
            <label>Contraseña: <input type="password" name="clave" required></label><br>
            <label>Repetir contraseña: <input type="password" name="clave2" required></label><br>
            <button type="submit">Registrar</button>
        </form>
    </section>

    <footer>
        <p>© 2025 Gestor de Libros. Todos los derechos reservados.</p>
    </footer>
</body>
</html>