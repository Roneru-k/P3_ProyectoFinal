<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    $query = "INSERT INTO contacto (correo, nombre, asunto, comentario) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$correo, $nombre, $asunto, $comentario]);

    echo "<div class='alert alert-success'>Tu mensaje ha sido enviado exitosamente.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Librería El Saber</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="libros.php">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="autores.php">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <h2 class="mb-4">Formulario de Contacto</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" required>
            </div>
            <div class="mb-3">
                <label for="comentario" class="form-label">Comentario</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
