<?php
// Iniciar sesión
session_start();

// Redirigir al login si no hay sesión iniciada
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
// Manejar el cierre de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Arte - Noticias</title>
    <link rel="stylesheet" href="noti.css">
    <link rel="icon" href="Imagen1-removebg-preview.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilo del botón Cerrar Sesión (igual al de Subir Obra) */
        button {
    background-color: #8b5e3c;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.1em;
    transition: background-color 0.3s, transform 0.3s;
}

button:hover {
    background-color: #6f4d3d;
    transform: scale(1.1); /* Efecto de zoom */
}
    </style>
</head>
<body>
    <!-- Menú de Navegación -->
    <header class="header">
        <div class="logo">
            <img src="img-galeria/Log2.png" alt="Logo" class="logo-img">
        </div>
        <nav class="menu">
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="destacadas.php">Destacadas</a></li>
                <li><a href="noticias.php">Noticias</a></li>
                <li><a href="gallery.php">Galería</a></li>
                <li><a href="subirobra.php">Subir</a></li>
            </ul>
        </nav>
        <form method="POST" style="display: inline;">
        <button type="submit" name="cerrar_sesion">
            <img src="cerrar-sesion.png" alt="Cerrar Sesión" style="width: 30px; height: 30px; border: none; cursor: pointer;">
        </button>
    </form>
    </header>

    <!-- Carrusel -->
    <div class="carousel-container">
        <div class="carousel">
            <div class="carousel-item">
                <img src="img-galeria/art1.jpg" alt="Exposición 1">
                <div class="info-box">
                    <h3>Exposición 'Trazos del Tiempo'</h3>
                    <p>Los estudiantes de 3ro de Secundaria del Instituto Politénico Industrial Don Bosco, nos muestran el paso del tiempo reflejado en los trazos de los artistas.</p>
                </div>
            </div> 
            <div class="carousel-item">
                <img src="img-galeria/art2.jpg" alt="Exposición 2">
                <div class="info-box">
                    <h3>Exposición 'Muñecas sin rostro'</h3>
                    <p>Brillante exibición es presentada por los alumnos de la institución de las diversas muñecas sin rostro dominicanas.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img-galeria/art3.jpg" alt="Exposición 3">
                <div class="info-box">
                    <h3>Exposición 'Artezanias dominicanas'</h3>
                    <p>Exploración espectacular sobre las principales artezanias dominicanas presentada por los alumnos de 6to de Secundaria del Don Bosco.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img-galeria/art4.jpg" alt="Exposición 4">
                <div class="info-box">
                    <h3>Exposición 'Arte Caribeño en Tus Manos'</h3>
                    <p>Una hermosa continuación de las principales creaciones artesanales dominicanas por los estudiantes de la institución.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img-galeria/art5.jpg" alt="Exposición 5">
                <div class="info-box">
                    <h3>Exposición 'Pilón Dominicano'</h3>
                    <p>Una maravillosa exibición de los distintos pilones artezales dominicanos dirigida por los alumnos de 6to de Secundaria. </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img-galeria/art6.jpg" alt="Exposición 6">
                <div class="info-box">
                    <h3>Exposición 'Raíces y Creaciones'</h3>
                    <p>Una exposición de manualidades que conecta las tradiciones dominicanas con la innovación artística.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img-galeria/art7.jpg" alt="Exposición 7">
                <div class="info-box">
                    <h3>Exposición 'Lienzos de Quisqueya'</h3>
                    <p>Galería de pinturas que capturan la esencia y los paisajes de la República Dominicana.</p>
                </div>
            </div>
        </div>

        <!-- Flechas de Navegación -->
        <button class="prev" onclick="moveSlide(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="next" onclick="moveSlide(1)">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <script src="noti.js"></script>
    <!-- Footer -->
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
                Somos una institución educativa del nivel medio en la modalidad Técnico Profesional, perteneciente al sector oficial, dirigida por la Congregación Salesiana con la finalidad de formar íntegramente a los jóvenes            </p>
            <a href="historia.html" class="footer-link">Conoce más</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 pimcelada-art. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
