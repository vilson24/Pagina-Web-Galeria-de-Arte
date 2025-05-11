<?php
// Iniciar sesión
session_start();

// Redirigir al login si no hay sesión iniciada
if (!isset($_SESSION['usuario'])) {
    header('Location: ../PHP/login.php');
    exit();
}

// Leer datos del archivo JSON
$dataFile = '../JSON/data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// Manejar eliminación de obras
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_work'])) {
    $workTitle = $_POST['work_title'];
    $data = array_filter($data, function ($work) use ($workTitle) {
        return $work['nombreObra'] !== $workTitle || $work['usuario'] !== $_SESSION['usuario'];
    });

    // Guardar los datos actualizados en el archivo JSON
    file_put_contents($dataFile, json_encode(array_values($data), JSON_PRETTY_PRINT));
    header('Location: ../PHP/gallery.php'); // Recargar la página
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
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../imgs/Imagen1-removebg-preview.png" type="image/png">
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="../imgs/LOGO.jpg" alt="Logo" class="logo-img">
    </div>
    <nav class="menu">
        <ul>
            <li><a href="../PHP/inicio.php">Inicio</a></li>
            <li><a href="../PHP/destacadas.php">Destacadas</a></li>
            <li><a href="../PHP/gallery.php">Galería</a></li>
            <li><a href="../PHP/noticias.php">Noticias</a></li>
            <li><a href="../PHP/subirobra.php">Subir</a></li>
        </ul>
    </nav>
    <form method="POST" style="display: inline;">
        <button type="submit" name="cerrar_sesion">
            <img src="../imgs/cerrar-sesion.png" alt="Cerrar Sesión" style="width: 30px; height: 30px; border: none; cursor: pointer;">
        </button>
    </form>
</header>

<?php
// Manejar el cierre de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header('Location: ../PHP/login.php');
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
                        <a href="../PHP/details.php?id=<?= urlencode($work['id']) ?>">
                            <img src="../uploads/<?= htmlspecialchars($work['imagen']) ?>" alt="<?= htmlspecialchars($work['nombreObra']) ?>" class="card-image">
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
      <!-- Footer -->
<footer class="footer">
  <div class="footer-container">
      <!-- Ubicación -->
      <div class="footer-about">
          <h3>Ubicación</h3>
          <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8354345073313!2d144.95565131568256!3d-37.8173136797516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xb1a5aa2116a5870!2sYour+Institute!5e0!3m2!1sen!2sus!4v1638157607722!5m2!1sen!2sus" 
              width="90%" 
              height="150" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy">
          </iframe>
      </div>

      <!-- Redes Sociales -->
      <div class="footer-social-media">
          <h3>Redes Sociales</h3>
          <div class="social-media-links">
              <a href="https://www.instagram.com/" target="_blank">
                  <i class="fab fa-instagram"></i> Instagram
              </a>
              <a href="https://www.facebook.com/" target="_blank">
                  <i class="fab fa-facebook-f"></i> Facebook
              </a>
          </div>
      </div>

      <!-- Contáctanos -->
      <div class="footer-contact">
          <h3>Contáctanos</h3>
          <p><i class="fas fa-phone-alt"></i> Teléfono: <a href="tel:+8092336082">(809) 233 6082</a></p>
          <p><i class="fas fa-envelope"></i> Email: <a href="mailto:info@instituto.com">info@instituto.com</a></p>
      </div>

      <!-- Más sobre nosotros -->
      <div class="footer-more-about">
          <h3>Más sobre nosotros</h3>
          <p>
              Somos una institución educativa del nivel medio en la modalidad Técnico Profesional, perteneciente al sector oficial, dirigida por la Congregación Salesiana con la finalidad de formar íntegramente a los jóvenes </p>
      </div>
  </div>
  <div class="footer-bottom">
      <p>&copy; 2024 pincelada-art. Todos los derechos reservados.</p>
  </div>
</footer>
</body>
</html>
