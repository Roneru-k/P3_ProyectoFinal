<?php
include 'config.php';


$filter = isset($_GET['filter']) ? $_GET['filter'] : '';


$queries = [
    'autores' => "SELECT * FROM autores",
    'biografias' => "SELECT * FROM biografias",
    'derechos' => "SELECT * FROM derechos",
    'tiendas' => "SELECT * FROM tiendas",
    'titulos' => "SELECT * FROM titulos",
    'publicadores' => "SELECT * FROM publicadores"
];

$results = [];
foreach ($queries as $key => $query) {
    $stmt = $pdo->prepare($query);
    if ($filter) {
        $filter_value = "%" . $filter . "%";  
        $stmt->bindParam(':filter', $filter_value, PDO::PARAM_STR); 
    }
    $stmt->execute();
    $results[$key] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$counts = array_map('count', $results);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Completo - Librería El Saber</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
                        <a class="nav-link active" aria-current="page" href="libros.php">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="autores.php">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Catálogo Completo</h2>

       
        <section class="mt-4">
            <h3>Filtrar Datos</h3>
            <form method="GET" action="">
                <input type="text" class="form-control" name="filter" placeholder="Buscar por nombre o apellido" value="<?= htmlspecialchars($filter) ?>">
                <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
            </form>
        </section>

     
        <section class="mt-4">
            <p><strong>Se encontraron <?= $counts['autores'] ?? 0 ?> autores, <?= $counts['biografias'] ?? 0 ?> biografías, <?= $counts['derechos'] ?? 0 ?> derechos, <?= $counts['tiendas'] ?? 0 ?> tiendas y <?= $counts['titulos'] ?? 0 ?> títulos.</strong></p>
        </section>


        <section>
            <h3>Autores</h3>
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
                    <?php foreach ($results['autores'] ?? [] as $autor): ?>
                        <tr>
                            <td><?= htmlspecialchars($autor['id_autor'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($autor['nombre'] ?? 'Sin nombre') ?></td>
                            <td><?= htmlspecialchars($autor['apellido'] ?? 'Sin apellido') ?></td>
                            <td><?= htmlspecialchars($autor['telefono'] ?? 'Sin teléfono') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>


        <section>
            <h3>Biografías</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Autor</th>
                        <th>Biografía</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results['biografias'] ?? [] as $biografia): ?>
                        <tr>
                            <td><?= htmlspecialchars($biografia['id_autor'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($biografia['biografia'] ?? 'Sin biografía') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>


        <section>
            <h3>Derechos</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Título</th>
                        <th>Rango Bajo</th>
                        <th>Rango Alto</th>
                        <th>Derechos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results['derechos'] ?? [] as $derecho): ?>
                        <tr>
                            <td><?= htmlspecialchars($derecho['id_titulo'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($derecho['rango_bajo'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($derecho['rango_alto'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($derecho['derechos'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>


        <section>
            <h3>Tiendas</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Tienda</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results['tiendas'] ?? [] as $tienda): ?>
                        <tr>
                            <td><?= htmlspecialchars($tienda['id_tienda'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($tienda['nombre_tienda'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($tienda['direcc_tienda'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($tienda['ciudad'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>


        <section>
            <h3>Títulos</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Título</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results['titulos'] ?? [] as $titulo): ?>
                        <tr>
                            <td><?= htmlspecialchars($titulo['id_titulo'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($titulo['titulo'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($titulo['tipo'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($titulo['precio'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>


        <section>
            <h3>Publicadores</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Publicador</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results['publicadores'] ?? [] as $publicador): ?>
                        <tr>
                            <td><?= htmlspecialchars($publicador['id_pub'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($publicador['nombre_pub'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($publicador['ciudad'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($publicador['estado'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

    </div>


    <footer class="mt-5">
        <p class="text-center">&copy; 2024 Librería El Saber. Todos los derechos reservados.</p>
    </footer>

    <?php

    $pdo = null;
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
