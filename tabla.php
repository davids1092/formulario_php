<!DOCTYPE html>
<html>
<head>
  <title>usuarios</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Usuarios</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Documento</th>
          <th>Teléfono</th>
          <th>Usuario</th>
          <th>contrasena</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>

      <button class="btn btn-primary" onclick="window.location.href = 'index.php'">Agregar nuevo</button>

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

            // Verificar si se ha enviado una solicitud de eliminación
            if (isset($_GET['eliminar']) && $_GET['eliminar'] == 'true') {
                // Obtener el ID del registro a eliminar
                $idEliminar = $_GET['id'];

                // Consulta SQL para eliminar el registro correspondiente
                $queryEliminar = "DELETE FROM users WHERE id = $idEliminar";
                $resultEliminar = mysqli_query($conn, $queryEliminar);

            
            }

            // Consulta SQL para seleccionar todos los registros de la tabla users
            $query = "SELECT * FROM users";

            // Ejecutar la consulta
            $result = mysqli_query($conn, $query);

            // Verificar si la consulta fue exitosa
            if ($result && mysqli_num_rows($result) > 0) {
                // Imprimir los datos de cada registro en filas de la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['apellido'] . '</td>';
                    echo '<td>' . $row['documento'] . '</td>';
                    echo '<td>' . $row['telefono'] . '</td>';
                    echo '<td>' . $row['usuario'] . '</td>';
                    echo '<td>' . $row['contrasena'] . '</td>';
                    echo '<td>';
                    echo '<a class="btn btn-primary" href="edicion.php?id=' . $row['id'] . '">Editar</a>';
                    echo '<a class="btn btn-danger" href="?eliminar=true&id=' . $row['id'] . '">Eliminar</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo 'No se encontraron registros en la tabla users.';
            }
        }

        // Cerrar la conexión cuando hayas terminado
        mysqli_close($conn);

        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
