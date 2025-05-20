<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - Gestor de Libros</title>
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
    <?php if (isset($_SESSION['usuario'])): ?>
      <a href="panel.php">Panel</a>
    <?php endif; ?>
  </nav>

  <section>
    <article>
      <h2>¿Qué puedes hacer con este sistema?</h2>
      <p>Registrar libros, consultar la lista de libros almacenados y gestionar la información básica.</p>
      <?php if (isset($_SESSION['usuario'])): ?>
        <form action="logout.php" method="post" style="display:inline;">
          <button type="submit">Cerrar sesión (<?php echo htmlspecialchars($_SESSION['usuario']); ?>)</button>
        </form>
      <?php else: ?>
        <a href="login.php"><button>Iniciar sesión</button></a>
      <?php endif; ?>
    </article>
  </section>

  <footer>
    <p>© 2025 Gestor de Libros. Todos los derechos reservados.</p>
  </footer>

</body>
</html>
