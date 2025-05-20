# Gestor de Libros - Instrucciones de Uso

## Requisitos

- PHP 7.x o superior
- Servidor web local (XAMPP, WAMP, Laragon, etc.) o servidor con soporte PHP
- Navegador web moderno

## Estructura de Archivos

- `index.php` — Página principal
- `login.php` — Inicio de sesión
- `logout.php` — Cierre de sesión
- `registrar.php` — Registro de usuarios
- `registro.php` — Registro de libros
- `consulta.php` — Consulta de libros registrados
- `panel.php` — Panel de usuario (zona protegida)
- `Usuario.php` — Clase para gestión de usuarios
- `usuarios.csv` — Archivo plano donde se almacenan los usuarios (se crea automáticamente)
- `libros.csv` — Archivo plano donde se almacenan los libros (se crea automáticamente)
- Carpeta `portadas/` — Aquí se guardan las imágenes de portada de los libros
- `estilos.css` — (Opcional) Hoja de estilos para personalizar la apariencia

## Primeros pasos

1. **Descarga o clona el proyecto** en la carpeta pública de tu servidor local (por ejemplo, `htdocs` en XAMPP).

2. **Asegúrate de que la carpeta tenga permisos de escritura**, especialmente para crear los archivos `usuarios.csv`, `libros.csv` y la carpeta `portadas`.

3. **Inicia el servidor web** y accede a `http://localhost/TopicoII/index.php` desde tu navegador.

## Uso del sistema

### 1. Registro de usuario

- Haz clic en "Iniciar sesión" y luego en "Regístrate aquí".
- Completa el formulario de registro. No se permiten comas en el nombre de usuario ni en la contraseña.
- Si el registro es exitoso, podrás iniciar sesión.

### 2. Inicio de sesión

- Ingresa tu usuario y contraseña en `login.php`.
- Si los datos son correctos, accederás al panel de usuario.

### 3. Registrar un libro

- Desde el menú, selecciona "Registrar Libro".
- Completa el formulario y sube una imagen de portada (formatos permitidos: JPG, JPEG, PNG, GIF, WEBP).
- El libro se guardará en `libros.csv` y la imagen en la carpeta `portadas`.

### 4. Consultar libros

- Desde el menú, selecciona "Consultar Libros".
- Verás una tabla con todos los libros registrados y sus portadas.

### 5. Cerrar sesión

- Haz clic en "Cerrar sesión" desde el panel o la página principal.

## Notas

- **No edites manualmente los archivos CSV** para evitar errores de formato.
- Si tienes problemas con los saltos de línea en Windows, asegúrate de que los archivos CSV no tengan líneas unidas.
- Si borras usuarios o libros, hazlo siempre desde el sistema o con mucho cuidado en el archivo CSV.

---

**¡Listo! Ya puedes gestionar usuarios y libros con portadas en tu sistema.**