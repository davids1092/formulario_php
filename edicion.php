<!DOCTYPE html>
<html>
<head>
  <title>Edición</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<body>
  <div class="container">
    <h1>Edición de Datos</h1>
    
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "users_php";

    // Establecer la conexión a la base de datos
    $conn = mysqli_connect($host, $username, $password, $database);

    // Verificar si hay errores de conexión
    if (!$conn) {
        die('Error de conexión: ' . mysqli_connect_error());
    }

    // Verificar si se ha enviado el formulario
    if (isset($_POST['submit'])) {
        // Obtener el ID del registro
        $id = $_GET['id'];

        // Obtener los valores del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $documento = $_POST['documento'];
        $telefono = $_POST['telefono'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Actualizar los datos en la base de datos
        $query = "UPDATE users SET nombre = '$nombre', apellido = '$apellido', documento = '$documento', telefono = '$telefono', usuario = '$usuario', contrasena = '$contrasena' WHERE id = $id";
        $result = mysqli_query($conn, $query);

       
    }

    // Obtener el ID del registro de la URL
    $id = $_GET['id'];

    // Consultar el registro correspondiente al ID
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Verificar si se encontró el registro
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Mostrar el formulario de edición con los datos del registro
        echo '
        <form action="" method="POST">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="' . $row['nombre'] . '">
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="' . $row['apellido'] . '">
          </div>
          <div class="form-group">
            <label for="documento">Documento</label>
            <input type="text" class="form-control" id="documento" name="documento" value="' . $row['documento'] . '">
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="' . $row['telefono'] . '">
          </div>
          <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="' . $row['usuario'] . '">
          </div>
          <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="text" class="form-control" id="contrasena" name="contrasena" value="' . $row['contrasena'] . '">
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Guardar Cambios</button>
        </form>
        ';
    } else {
        echo 'No se encontró el registro.';
    }

    // Cerrar la conexión cuando hayas terminado
    mysqli_close($conn);
    ?>
    
  </div>
</body>
</html>
