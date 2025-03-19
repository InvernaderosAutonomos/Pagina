<?php
// Incluir la configuración de la base de datos
include('config.php'); // Esto incluye el archivo config.php, que establece la conexión

// Iniciar sesión para usar las variables de sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos 'nombre' y 'password' están presentes en el formulario
    if (isset($_POST['nombre'], $_POST['password'])) {
        $nombre = trim($_POST['nombre']);  // Obtener el nombre de usuario o correo del formulario
        $contraseña = trim($_POST['password']); // Obtener la contraseña del formulario

        // Validar que los campos no estén vacíos
        if (empty($nombre) || empty($contraseña)) {
            die("Por favor, completa todos los campos.");
        }

        // Consultar al usuario en la base de datos (buscar por nombre o correo electrónico)
        $sql = "SELECT id, contraseña FROM usuarios WHERE gmail = ? OR nombre = ?";
        $stmt = $conn->prepare($sql); // Preparar la consulta para evitar inyecciones SQL
        $stmt->bind_param("ss", $nombre, $nombre); // Vinculamos los parámetros a la consulta
        $stmt->execute(); // Ejecutamos la consulta
        $stmt->store_result(); // Almacenamos el resultado de la consulta

        if ($stmt->num_rows > 0) {
            // Si encontramos un usuario, obtenemos los resultados
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch(); // Recuperamos los datos del usuario

            // Verificamos si la contraseña ingresada es correcta
            if (password_verify($contraseña, $hashed_password)) {
                // Si la contraseña es correcta, iniciamos la sesión
                $_SESSION['user_id'] = $id;  // Guardamos el id del usuario en la sesión

                // Establecemos el estado de login exitoso
                $_SESSION['login_status'] = 'exitoso';

                // Redirigimos a la página 'pollito.html'
                header("Location: PAGINAFUNCIONAL/index.html");
                exit();
            } else {
                // Si la contraseña no es correcta, establecemos el estado de login fallido
                $_SESSION['login_status'] = 'fallido';

                // Redirigimos de vuelta a la página de login
                header("Location: index.html");
                exit();
            }
        } else {
            // Si no encontramos al usuario, establecemos el estado de login fallido
            $_SESSION['login_status'] = 'fallido';

            // Redirigimos de vuelta a la página de login
            header("Location: index.html");
            exit();
        }

        $stmt->close(); // Cerramos la consulta
        $conn->close(); // Cerramos la conexión con la base de datos
    } else {
        die("Por favor, completa todos los campos.");
    }
}
?>
