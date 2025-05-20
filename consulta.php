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
  <title>Consulta de Libros</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>

  <header>
    <h1>Consulta de Libros Registrados</h1>
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
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Autor</th>
          <th>Año</th>
          <th>Género</th>
          <th>Portada</th>
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
                // Mostrar imagen si existe la ruta
                if (isset($datos[4]) && file_exists($datos[4])) {
                    echo "<td><img src='" . htmlspecialchars($datos[4]) . "' alt='Portada' style='max-width:80px;max-height:100px;'></td>";
                } else {
                    echo "<td>Sin imagen</td>";
                }
                echo "</tr>";
                $id++;
            }
            fclose($fp);
        } else {
            echo '<tr><td colspan="6">No hay libros registrados.</td></tr>';
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
