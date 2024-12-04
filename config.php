<?php
$dsn = 'mysql:host=localhost;dbname=if0_37767491_libreria_db;charset=utf8';
$username = 'root';
$password = ''; // Asegúrate de colocar tu contraseña de la base de datos, si la tienes

try {
    // Crear una instancia de PDO
    $pdo = new PDO($dsn, $username, $password);
    // Establecer el modo de error de PDO a excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si ocurre un error, se captura y se muestra un mensaje
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
