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
  <title>Registrar Libro</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>

  <header>
    <h1>Registrar Nuevo Libro</h1>
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
    <?php
    $mensaje = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = trim($_POST["titulo"] ?? "");
        $autor = trim($_POST["autor"] ?? "");
        $anio = trim($_POST["anio"] ?? "");
        $genero = trim($_POST["genero"] ?? "");

        // Validar campos
        if (empty($titulo) || empty($autor) || empty($anio) || empty($genero)) {
            $error = "Error: Todos los campos son obligatorios.";
        } elseif (!isset($_FILES['portada']) || $_FILES['portada']['error'] == UPLOAD_ERR_NO_FILE) {
            $error = "Error: Debes seleccionar una imagen de portada.";
        } else {
            // Procesar imagen
            $carpeta = "portadas";
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $nombreArchivo = basename($_FILES["portada"]["name"]);
            $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($extension, $permitidas)) {
                $error = "Error: Solo se permiten imágenes JPG, JPEG, PNG, GIF o WEBP.";
            } else {
                // Nombre único para la imagen
                $nombreUnico = uniqid('portada_', true) . '.' . $extension;
                $rutaDestino = $carpeta . "/" . $nombreUnico;
                if (move_uploaded_file($_FILES["portada"]["tmp_name"], $rutaDestino)) {
                    // Guardar en archivo CSV (incluye ruta de portada)
                    $linea = "\"$titulo\",\"$autor\",\"$anio\",\"$genero\",\"$rutaDestino\"\n";
                    $archivo = fopen("libros.csv", "a");
                    fwrite($archivo, $linea);
                    fclose($archivo);

                    $mensaje = "Libro '$titulo' registrado exitosamente con autor $autor, publicado en $anio, género: $genero.";
                } else {
                    $error = "Error al subir la imagen de portada.";
                }
            }
        }
    }
    ?>

    <?php if (!empty($error)): ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif (!empty($mensaje)): ?>
      <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <!-- Formulario -->
    <form method="POST" action="registro.php" enctype="multipart/form-data">
      <label for="titulo">Título del libro:</label>
      <input type="text" id="titulo" name="titulo" placeholder="Ej. Luna de Plutón">

      <label for="autor">Autor:</label>
      <input type="text" id="autor" name="autor" placeholder="Ej. Ángel David Revilla">

      <label for="anio">Año de publicación:</label>
      <input type="number" id="anio" name="anio" placeholder="Ej. 2015">

      <label for="genero">Género:</label>
      <input type="text" id="genero" name="genero" placeholder="Ej. Novela">

      <label for="portada">Imagen de portada:</label>
      <input type="file" id="portada" name="portada" accept="image/*" required>
      
      <p style="font-size: 0.8em; color: lightgray;">* Formatos permitidos: JPG, JPEG, PNG, GIF, WEBP</p>

      <br>

      <input type="submit" value="Guardar Libro" style="margin-top: 15px;">
    </form>
  </section>

  <footer>
    <p>© 2025 Gestor de Libros. Todos los derechos reservados.</p>
  </footer>

</body>
</html>
