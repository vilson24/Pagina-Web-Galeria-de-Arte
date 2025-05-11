<?php
// Iniciar sesión
session_start();

// Redirigir al login si no hay sesión iniciada
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Leer datos del archivo JSON
$dataFile = 'data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// Manejar eliminación de obras
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_work'])) {
    $workTitle = $_POST['work_title'];
    $data = array_filter($data, function ($work) use ($workTitle) {
        return $work['nombreObra'] !== $workTitle || $work['usuario'] !== $_SESSION['usuario'];
    });

    // Guardar los datos actualizados en el archivo JSON
    file_put_contents($dataFile, json_encode(array_values($data), JSON_PRETTY_PRINT));
    header('Location: gallery.php'); // Recargar la página
    exit();
}

$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="Imagen1-removebg-preview.png" type="image/png">
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="LOGO.jpg" alt="Logo" class="logo-img">
    </div>
    <nav class="menu">
        <ul>
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="destacadas.php">Destacadas</a></li>
            <li><a href="gallery.php">Galería</a></li>
            <li><a href="noticias.php">Noticias</a></li>
            <li><a href="subirobra.php">Subir</a></li>
        </ul>
    </nav>
    <form method="POST" style="display: inline;">
        <button type="submit" name="cerrar_sesion">
            <img src="cerrar-sesion.png" alt="Cerrar Sesión" style="width: 30px; height: 30px; border: none; cursor: pointer;">
        </button>
    </form>
</header>

<?php
// Manejar el cierre de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<main class="main-content">
    <h1>Galería de Obras</h1>
    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Buscar por título..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Buscar</button>
    </form>
    <div class="gallery">
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $work): ?>
                <?php if (!$search || strpos(strtolower($work['nombreObra']), $search) !== false): ?>
                    <div class="card">
                        <!-- Enlace para ver la obra -->
                        <a href="details.php?id=<?= urlencode($work['id']) ?>">
                            <img src="uploads/<?= htmlspecialchars($work['imagen']) ?>" alt="<?= htmlspecialchars($work['nombreObra']) ?>" class="card-image">
                        </a>
                        <h2><?= htmlspecialchars($work['nombreObra']) ?></h2>
                        <p>Por: <?= htmlspecialchars($work['usuario']) ?></p>
                        <?php if ($work['usuario'] === $_SESSION['usuario']): ?>
                            <form method="POST" class="delete-form">
                                <input type="hidden" name="work_title" value="<?= htmlspecialchars($work['nombreObra']) ?>">
                                <button type="submit" name="delete_work" class="delete-button">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se han subido obras aún.</p>
        <?php endif; ?>
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <p>&copy; 2024 pimcelada-art. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
