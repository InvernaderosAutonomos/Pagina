<?php
// Configuración de la base de datos
$host = 'localhost';       // Host de la base de datos (generalmente 'localhost' si está en el mismo servidor)
$usuario = 'root';         // Usuario de la base de datos
$contraseña = '';          // Contraseña de la base de datos (en blanco si no tiene)
$nombre_db = 'registro';   // Nombre de la base de datos que estás utilizando

// Crear la conexión
$conn = new mysqli($host, $usuario, $contraseña, $nombre_db);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error); // Si hay un error de conexión, muestra un mensaje y termina el script
}

