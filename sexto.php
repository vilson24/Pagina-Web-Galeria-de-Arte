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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Arte</title>
    <link rel="stylesheet" href="sexto.css">
    <link rel="icon" href="Imagen1-removebg-preview.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <!-- imágen -->
  <!-- imágen -->
  <section class="slider">
    <div class="slide">
        <h1 class="titulo">
            <span class="linea-1">Bienvenidos a</span><br>
            <span class="linea-2">SEXTO DE SECUNDARIA</span>
        </h1>
        <img src="img-galeria/art3.jpg" alt="Obra de arte">
    </div>
</section>

    <!-- Frases Inspiradoras -->
    <section class="frases-tarjetas">
        <div class="tarjeta">
            <p>“El arte está ligado a lo que todavía no se crea.” Eduardo Chillida. </p>
        </div>
        <div class="tarjeta">
            <p>“No hay arte sin transformación.” Robert Bresson</p>
        </div>
        <div class="tarjeta">
            <p>“El arte no cambia nada, el arte te cambia a ti.” David Lynch</p>
        </div>
    </section>

    <!-- Invitación -->
    <section class="invitacion">
        <h2>Conoce nuestras 10 Obras más destacadas</h2>
        <p>Descubre una colección única de 10 obras que evocan emociones, ideas y creatividad.</p>
    </section>

    <!-- Galería de Obras -->
    <div class="container">
        <!-- Tarjeta 1 -->
        <div class="card">
          <img src="img-galeria/6TO JONH LT.jpg" alt="Imagen 1">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Cuchara de Madera</h3>
            <p>Esta es la representación de una cuchara de madera que tiene pintado un paisaje dominicano, desarrollado por John Kerry un alumno de 6to LT.</p>
          </div>
        </div>
        <!-- Tarjeta 2 -->
        <div class="card">
          <img src="img-galeria/6TO DAAI LAURA.jpg" alt="Imagen 2">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Maracas de higueros</h3>
            <p>Esta es la representación de dos maracas hechas con higuero y pintadas con un paisaje dominicano, desarrolladas por Laura Nova una alumna de 6to DAAI.</p>
          </div>
        </div>
        <!-- Tarjeta 3 -->
        <div class="card">
          <img src="img-galeria/6TO LT ELIZABETH.jpg" alt="Imagen 3">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Maceta con un girasol</h3>
            <p>Esta es la representación de una maceta de barro que tiene una pintura de un paisaje dominicano, desarrollado por Elizabeth Domínguez una alumna de 6to LT. </p>
          </div>
        </div>
        <!-- Tarjeta 4 -->
        <div class="card">
          <img src="img-galeria/6TO  DAAI ARIS.jpg" alt="Imagen 4">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Limpiabotas</h3>
            <p>Esta es la representación de un limpiabotas de madera que tiene pintado un paisaje dominicano, desarrollado por Arisleidy Holguin una alumna de 6to DAAI.</p>
          </div>
        </div>
        <!-- Tarjeta 5 -->
        <div class="card">
          <img src="img-galeria/6TO EE.jpg" alt="Imagen 5">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Pintura paisajista sobre una botella</h3>
            <p>Esta es la representación de una pintura de un paisaje dominicano en una botella con una ténica de oleo sobre cristal, desarrollada por un alumno de 6to EE.</p>
          </div>
        </div>
        <!-- Tarjeta 6 -->
        <div class="card">
          <img src="img-galeria/6TO MG.jpg" alt="Imagen 6">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Retrato pintado sobre yeso.</h3>
            <p>Esta es la representación de una pintura de un retrato con una ténica oleo sobre lienzo, desarrollada por una alumna de 6to MG.</p>
          </div>
        </div>
        <!-- Tarjeta 7 -->
        <div class="card">
          <img src="img-galeria/6TO MEC.jpg" alt="Imagen 7">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Pilón de metal</h3>
            <p>Esta es la representación de un pilón realizado con el material de metal, desarrollado por un alumno de 6to MEC.</p>
          </div>
        </div>
        <!-- Tarjeta 8 -->
        <div class="card">
          <img src="img-galeria/6TO EE (2).jpg" alt="Imagen 8">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Muñeca sin rostro</h3>
            <p>Esta es la representación de una Muñeca sin rostro vestida de los colorea patrios dominicanos, desarrollada por una alumna de 6to EE.</p>
          </div>
        </div>
        <!-- Tarjeta 9 -->
        <div class="card">
          <img src="img-galeria/6TO DAAI YULIANDRY.jpg" alt="Imagen 9">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Casa de cartón</h3>
            <p>Esta es la representación de una casa de cartón típica dominicana, desarrolladapo la alumna Yuliandry Estrella de 6to DAAI.</p>
          </div>
        </div>
        <!-- Tarjeta 10 -->
        <div class="card">
          <img src="img-galeria/6TO DAAI RUTH (2).jpg" alt="Imagen 10">
          <div class="info">
            <div class="iconos">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h3>Maceta con un girasol</h3>
            <p>Esta es la representación de una maceta de barro que tiene una pintura de un paisaje dominicano, desarrollada por Ruth Mercado una alumna de 6to DAAI</p>
          </div>
        </div>
      </div>
</body>
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
</html>
