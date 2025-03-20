<?php
// Incluir la configuración de la base de datos
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['gmail'], $_POST['password'])) {
        $nombre = trim($_POST['nombre']);
        $apellidos = trim($_POST['apellidos']);
        $telefono = trim($_POST['telefono']);
        $gmail = trim($_POST['gmail']);
        $contraseña = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Ahora sí encriptamos la contraseña

        // Validar que los campos no estén vacíos
        if (empty($nombre) || empty($apellidos) || empty($telefono) || empty($gmail) || empty($contraseña)) {
            die("Por favor, completa todos los campos.");
        }

        // Verificar si el correo ya está registrado
        $sql_check = "SELECT id FROM usuarios WHERE gmail = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $gmail);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            header("Location: index.html?registro=fallido");
            exit();
        }
        $stmt_check->close();

        // Insertar usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, gmail, contraseña) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellidos, $telefono, $gmail, $contraseña);

        if ($stmt->execute()) {
            header("Location: index.html?registro=exitoso");
            exit();
        } else {
            header("Location: index.html?registro=fallido");
            exit();
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else {
        die("Por favor, completa todos los campos.");
    }
}
?>
