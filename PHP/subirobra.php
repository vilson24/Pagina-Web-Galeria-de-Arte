<?php
// Iniciar sesión
session_start();

// Redirigir al login si no hay sesión iniciada
if (!isset($_SESSION['usuario'])) {
    header('Location: ../PHP/login.php');
    exit();
}

// Configuración de la carpeta de uploads
$uploadsDir = '../uploads/';
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cerrar_sesion'])) {
        // Manejar el cierre de sesión
        session_destroy();
        header('Location: ../PHP/login.php');
        exit();
    }

    $usuario = $_SESSION['usuario'];
    $taller = htmlspecialchars($_POST['taller']);
    $nombreObra = htmlspecialchars($_POST['nombreObra']);
    $descripcion = htmlspecialchars($_POST['descripcion']);

    // Subir imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagen']['tmp_name'];
        $originalFileName = basename($_FILES['imagen']['name']);
        $uniqueFileName = uniqid() . '_' . $originalFileName; // Generar un nombre único
        $fileDestination = $uploadsDir . $uniqueFileName;

        if (move_uploaded_file($fileTmpPath, $fileDestination)) {
            // Guardar datos en JSON
            $dataFile = '../JSON/data.json';
            $data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

            // Generar un ID único
            $new_id = count($data) > 0 ? end($data)['id'] + 1 : 1;

            $data[] = [
                'id' => $new_id, // Agregar el nuevo ID único
                'usuario' => $usuario,
                'taller' => $taller,
                'nombreObra' => $nombreObra,
                'descripcion' => $descripcion,
                'imagen' => $uniqueFileName // Guardar el nombre único en el JSON
            ];

            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
            header('Location: ../PHP/subirobra.php'); // Recargar la página
            exit();
        } else {
            $error = "Error al mover el archivo subido.";
        }
    } else {
        $error = "Error al subir la imagen.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Nueva Obra</title>
    <link rel="stylesheet" href="../CSS/estilosubir.css">
    <link rel="icon" href="Imagen1-removebg-preview.png" type="image/png">
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="../img-galeria/Log2.png" alt="Logo" class="logo-img">
    </div>
    <nav class="menu">
        <ul>
            <li><a href="../PHP/inicio.php">Inicio</a></li>
            <li><a href="../PHP/destacadas.php">Destacadas</a></li>
            <li><a href="../PHP/subirobra.php">Subir</a></li>
            <li><a href="../PHP/noticias.php">Noticias</a></li>
            <li><a href="../PHP/gallery.php">Galería</a></li>
        </ul>
    </nav>
    <form method="POST" style="display: inline;">
        <button type="submit" name="cerrar_sesion">
            <img src="../imgs/cerrar-sesion.png" alt="Cerrar Sesión" style="width: 30px; height: 30px; border: none; cursor: pointer;">
        </button>
    </form>
</header>

<div class="container">
    <h1>Subir Nueva Obra</h1>
    <p>Complete los campos para añadir su obra a la galería.</p>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="usuario">Usuario Actual:</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($_SESSION['usuario']) ?>" readonly>

        <label for="taller">Taller:</label>
        <input type="text" id="taller" name="taller" required>

        <label for="nombreObra">Nombre de la Obra:</label>
        <input type="text" id="nombreObra" name="nombreObra" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" required>

        <button type="submit">Subir Obra</button>
    </form>
</div>

<footer class="footer">
    <div class="footer-container">
        <!-- Ubicación -->
        <div class="footer-about">
            <h3>Ubicación</h3>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8354345073313!2d144.95565131568256!3d-37.8173136797516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xb1a5aa2116a5870!2sYour+Institute!5e0!3m2!1sen!2sus!4v1638157607722!5m2!1sen!2sus" 
                width="90%" 
                height="200" 
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
                Somos una institución educativa del nivel medio en la modalidad Técnico Profesional, perteneciente al sector oficial, dirigida por la Congregación Salesiana con la finalidad de formar íntegramente a los jóvenes.            
            </p>
            <a href="historia.html" class="footer-link">Conoce más</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 pimcelada-art. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
