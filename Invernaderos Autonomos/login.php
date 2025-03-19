<?php
session_start(); // Inicia la sesión

// Incluir la configuración de la base de datos
include('config.php'); // Asegúrate de que este archivo contenga la conexión a la base de datos

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre'], $_POST['password'])) {
        $nombre = trim($_POST['nombre']);
        $password = trim($_POST['password']);

        // Validar que los campos no estén vacíos
        if (empty($nombre) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos.']);
            exit();
        }

        // Consultar al usuario en la base de datos (buscar por nombre o correo electrónico)
        $sql = "SELECT id, nombre, apellidos, gmail, telefono, contraseña FROM usuarios WHERE gmail = ? OR nombre = ?";
        $stmt = $conn->prepare($sql); // Preparar la consulta para evitar inyecciones SQL
        $stmt->bind_param("ss", $nombre, $nombre); // Vinculamos los parámetros
        $stmt->execute(); // Ejecutamos la consulta
        $stmt->store_result(); // Almacenamos el resultado

        if ($stmt->num_rows > 0) {
            // Si encontramos al usuario, obtenemos los resultados
            $stmt->bind_result($id, $nombre_usuario, $apellidos, $correo, $telefono, $hashed_password);
            $stmt->fetch(); // Recuperamos los datos del usuario

            // Verificar si la contraseña ingresada es correcta
            if (password_verify($password, $hashed_password)) {
                // Guardamos los datos del usuario en la sesión
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                $_SESSION['apellidos'] = $apellidos;
                $_SESSION['correo'] = $correo;
                $_SESSION['telefono'] = $telefono;

                // Redirigir al usuario a index.html
                header("Location: PAGINAFUNCIONAL/index.php");
                exit(); // Asegúrate de detener el script después de la redirección
            } else {
                // Si la contraseña no es correcta
                echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
            }
        } else {
            // Si no encontramos al usuario
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }

        $stmt->close(); // Cerramos la consulta
        $conn->close(); // Cerramos la conexión con la base de datos
    } else {
        // Si no se envían los datos correctamente
        echo json_encode(['success' => false, 'message' => 'Datos del formulario incompletos']);
    }
}
?>

























/*
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


// Incluir la configuración de la base de datos
include('config.php'); // Asegúrate de que este archivo contenga la conexión a la base de datos

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobamos si las credenciales fueron enviadas
    if (isset($_POST['nombre'], $_POST['password'])) {
        $nombre = trim($_POST['nombre']);
        $password = trim($_POST['password']);

        // Validar que los campos no estén vacíos
        if (empty($nombre) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos.']);
            exit();
        }

        // Consultar al usuario en la base de datos (buscar por nombre o correo electrónico)
        $sql = "SELECT id, nombre, apellidos, gmail, telefono, contraseña FROM usuarios WHERE gmail = ? OR nombre = ?";
        $stmt = $conn->prepare($sql); // Preparar la consulta para evitar inyecciones SQL
        $stmt->bind_param("ss", $nombre, $nombre); // Vinculamos los parámetros
        $stmt->execute(); // Ejecutamos la consulta
        $stmt->store_result(); // Almacenamos el resultado

        if ($stmt->num_rows > 0) {
            // Si encontramos al usuario, obtenemos los resultados
            $stmt->bind_result($id, $nombre_usuario, $apellidos, $correo, $telefono, $hashed_password);
            $stmt->fetch(); // Recuperamos los datos del usuario

            // Verificar si la contraseña ingresada es correcta
            if (password_verify($password, $hashed_password)) {
                // Si la contraseña es correcta, devolver los datos del usuario
                echo json_encode([
                    'success' => true,
                    'nombre' => $nombre_usuario,
                    'apellidos' => $apellidos,
                    'correo' => $correo,
                    'telefono' => $telefono
                ]);
            } else {
                // Si la contraseña no es correcta
                echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
            }
        } else {
            // Si no encontramos al usuario
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }

        $stmt->close(); // Cerramos la consulta
        $conn->close(); // Cerramos la conexión con la base de datos
    } else {
        // Si no se envían los datos correctamente
        echo json_encode(['success' => false, 'message' => 'Datos del formulario incompletos']);
    }
}

*/
?>
