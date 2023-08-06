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
} else {
    // echo 'Conexión exitosa a la base de datos.<br>';

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $documento = $_POST['documento'];
        $telefono = $_POST['telefono'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Realizar la validación de los datos ingresados si es necesario

        // Insertar los datos en la base de datos
        $query = "INSERT INTO users (nombre, apellido, documento, telefono, usuario, contrasena) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $documento, $telefono, $usuario, $contrasena);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "El registro se guardó correctamente en la base de datos.";
 
            // Redirigir a tabla.php después de guardar correctamente
            header("Location: tabla.php");
            exit();
        } else {
            echo "Error al guardar el registro: " . mysqli_error($conn);
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
    }
}

// Cerrar la conexión cuando hayas terminado
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Nuevo usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Formulario</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">
      </div>
      <div class="form-group">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control" name="apellido"  id="apellido" placeholder="Ingrese su apellido">
      </div>
      <div class="form-group">
        <label for="documento">Documento:</label>
        <input type="text" class="form-control" name="documento"  id="documento" placeholder="Ingrese su número de documento">
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" class="form-control" name="telefono"  id="telefono" placeholder="Ingrese su número de teléfono">
      </div>
      <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" class="form-control" name="usuario"  id="usuario" placeholder="Ingrese su nombre de usuario">
      </div>
      <div class="form-group">
        <label for="contrasena">Contraseña:</label>
        <input type="password" class="form-control" name="contrasena"  id="contrasena" placeholder="Ingrese su contraseña">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</body>
</html>
