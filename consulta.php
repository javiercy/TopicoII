<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Consulta de Libros</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>

  <header>
    <h1>Consulta de Libros Registrados</h1>
  </header>

  <nav>
    <a href="index.html">Inicio</a>
    <a href="registro.php">Registrar Libro</a>
    <a href="consulta.php">Consultar Libros</a>
  </nav>

  <section>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Autor</th>
          <th>Año</th>
          <th>Género</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $archivo = "libros.csv";
        if (file_exists($archivo)) {
            $fp = fopen($archivo, "r");
            $id = 1;
            while (($datos = fgetcsv($fp, 1000, ",")) !== false) {
                // Elimina comillas dobles de los datos
                $datos = array_map(function($campo) {
                    return trim($campo, "\"");
                }, $datos);
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>" . htmlspecialchars($datos[0]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[1]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[2]) . "</td>";
                echo "<td>" . htmlspecialchars($datos[3]) . "</td>";
                echo "</tr>";
                $id++;
            }
            fclose($fp);
        } else {
            echo '<tr><td colspan="5">No hay libros registrados.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </section>

  <footer>
    <p>© 2025 Gestor de Libros. Todos los derechos reservados.</p>
  </footer>

</body>
</html>
