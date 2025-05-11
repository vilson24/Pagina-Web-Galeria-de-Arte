<?php
// Iniciar sesión
session_start();

// Redirigir al login si no hay sesión iniciada
if (!isset($_SESSION['usuario'])) {
    header('Location: ../PHP/login.php');
    exit();
}
// Manejar el cierre de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header('Location: ../PHP/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras Destacadas</title>
    <link rel="icon" href="../imgs/Imagen1-removebg-preview.png" type="image/png">
    <link rel="stylesheet" href="../CSS/estilos.css">
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
    <!-- Menú -->
    <header class="header">
        <div class="logo">
            <img src="../img-galeria/Log2.png" alt="Logo">
        </div>
        <nav class="menu">
            <ul>
                <li><a href="../PHP/inicio.php">Inicio</a></li>
                <li><a href="../PHP/destacadas.php">Destacadas</a></li>
                <li><a href="../PHP/noticias.php">Noticias</a></li>
                <li><a href="../PHP/gallery.php">Galería</a></li>
                <li><a href="../PHP/subirobra.php">Subir</a></li>
            </ul>
        </nav>
        <form method="POST" style="display: inline;">
        <button type="submit" name="cerrar_sesion">
            <img src="../imgs/cerrar-sesion.png" alt="Cerrar Sesión" style="width: 30px; height: 30px; border: none; cursor: pointer;">
        </button>
    </form>
    </header>

    <!------------- Galeria -------------------->
    <section class="servicios" id="servicios">
        <h2>ELIGE UNA CATEGORÍA</h2>
        <div class="servicios-contenedor">
            <div class="tarjeta-servicio">
                <img src="../img-galeria/jj.png" alt="Tercero">
                <h3><a href="../PHP/tercero.php">Tercero</a></h3>
            </div>
            <div class="tarjeta-servicio">
                <img src="../img-galeria/uu.png" alt="Cuarto">
                <h3><a href="../PHP/Cuarto.php">Cuarto</a></h3>
            </div>
            <div class="tarjeta-servicio">
                <img src="../img-galeria/mm.png" alt="Quinto">
                <h3><a href="../PHP/quinto.php">Quinto</a></h3>
            </div>
            <div class="tarjeta-servicio">
                <img src="../img-galeria/oo.jpg" alt="Sexto">
                <h3><a href="./PHP/sexto.php">Sexto</a></h3>
            </div>
        </div>
    </section>

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
                <p>Somos una institución educativa del nivel medio en la modalidad Técnico Profesional, perteneciente al sector oficial, dirigida por la Congregación Salesiana con la finalidad de formar íntegramente a los jóvenes.</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 pincelada-art. Todos los derechos reservados.</p>
        </div>
      </footer>
</body>
</html>
