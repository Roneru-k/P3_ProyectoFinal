<?php
include 'config.php';


$query = "SELECT * FROM autores";
$stmt = $pdo->prepare($query);
$stmt->execute();
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Autores</title>
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
                        <a class="nav-link active" href="autores.php">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <h2 class="mb-4">Listado de Autores</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Autor</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?= htmlspecialchars($autor['id_autor']) ?></td>
                        <td><?= htmlspecialchars($autor['nombre']) ?></td>
                        <td><?= htmlspecialchars($autor['apellido']) ?></td>
                        <td><?= htmlspecialchars($autor['telefono']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
