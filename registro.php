<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Libro</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>

  <header>
    <h1>Registrar Nuevo Libro</h1>
  </header>

  <nav>
    <a href="index.html">Inicio</a>
    <a href="registro.php">Registrar Libro</a>
    <a href="consulta.php">Consultar Libros</a>
  </nav>

  <section>
    <?php
    // Inicializamos variables para los mensajes
    $mensaje = "";
    $error = "";

    // Validamos si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Capturamos los datos del formulario
        $titulo = trim($_POST["titulo"] ?? "");
        $autor = trim($_POST["autor"] ?? "");
        $anio = trim($_POST["anio"] ?? "");
        $genero = trim($_POST["genero"] ?? "");

        // Validamos que ningún campo esté vacío
        if (empty($titulo) || empty($autor) || empty($anio) || empty($genero)) {
            $error = "Error: Todos los campos son obligatorios.";
        } else {
            // Guardar en archivo CSV
            $linea = "\"$titulo\",\"$autor\",\"$anio\",\"$genero\"\n";
            $archivo = fopen("libros.csv", "a");
            fwrite($archivo, $linea);
            fclose($archivo);

            // Mensaje de confirmación
            $mensaje = "Libro '$titulo' registrado exitosamente con autor $autor, publicado en $anio, género: $genero.";
        }
    }
    ?>

    <!-- Mostramos mensajes de error o confirmación -->
    <?php if (!empty($error)): ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif (!empty($mensaje)): ?>
      <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <!-- Formulario -->
    <form method="POST" action="registro.php">
      <label for="titulo">Título del libro:</label>
      <input type="text" id="titulo" name="titulo" placeholder="Ej. Luna de Plutón">

      <label for="autor">Autor:</label>
      <input type="text" id="autor" name="autor" placeholder="Ej. Ángel David Revilla">

      <label for="anio">Año de publicación:</label>
      <input type="number" id="anio" name="anio" placeholder="Ej. 2015">

      <label for="genero">Género:</label>
      <input type="text" id="genero" name="genero" placeholder="Ej. Novela">

      <input type="submit" value="Guardar Libro" style="margin-top: 15px;">
    </form>
  </section>

  <footer>
    <p>© 2025 Gestor de Libros. Todos los derechos reservados.</p>
  </footer>

</body>
</html>
