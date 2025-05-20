<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
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
        <a href="logout.php">Cerrar sesión</a>
    </nav>

    <section>
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
        <p>Has iniciado sesión correctamente.</p>
    </section>

    <footer>
        <p>© 2025 Gestor de Libros. Todos los derechos reservados.</p>
    </footer>
</body>
</html>