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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Arte</title>
    <link rel="stylesheet" href="../CSS/inicio.css">
    <link rel="icon" href="../imgs/Imagen1-removebg-preview.png" type="image/png">
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
            <img src="../imgs/LOGO.jpg" alt="Logo" class="logo-img">
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


      <!-- bienvenida -->
    <section class="bienvenida">
        <div class="texto">
            <h1 class="titulo">Bienvenido a Pinceladas Art</h1>
            <p class="descripcion">Explora el arte, creatividad y pasión en cada obra. Nuestra página está diseñada para conectarte con la inspiración.</p>
            <a href="gallery.php" class="boton">Explorar ahora</a>
        </div>
        <div class="fondo">
            <img src="../img-galeria/art2.jpg" alt="Arte 1">
            <img src="../img-galeria/art6.jpg" alt="Arte 2">
            <img src="../img-galeria/art7.jpg" alt="Arte 3">
        </div>
    </section>

<!-- Sección Misión, Visión y Valores -->
<section class="mision-vision-valores">
    <h2 class="seccion-titulo">Sobre Nosotros</h2>
    <div class="contenedor-tarjetas">
        <div class="tarjeta">
            <img src="../imgs/mision2.avif" alt="Misión" class="imagen-tarjeta">
            <h3 class="titulo-tarjeta">Misión</h3>
            <p class="contenido-tarjeta">Nuestra misión es promover el arte y la cultura, brindando un espacio donde los artistas puedan compartir su creatividad y los visitantes encuentren inspiración en cada obra.</p>
        </div>
        <div class="tarjeta">
            <img src="../imgs/vision.jpg" alt="Visión" class="imagen-tarjeta">
            <h3 class="titulo-tarjeta">Visión</h3>
            <p class="contenido-tarjeta">Ser una galería reconocida internacionalmente por su innovación, calidad y diversidad artística, conectando a personas con el poder transformador del arte.</p>
        </div>
        <div class="tarjeta">
            <img src="../imgs/valores.png" alt="Valores" class="imagen-tarjeta">
            <h3 class="titulo-tarjeta">Valores</h3>
            <p class="contenido-tarjeta">Honestidad, creatividad, inclusión y pasión son los valores que nos guían para garantizar una experiencia enriquecedora para artistas y visitantes.</p>
        </div>
    </div>
  </div>
        </div>
    </section>
     
    <!-- Sección carusel -->
    <div class="seccion-carrusel">
        <h2 class="titulo-carrusel">Descubre Nuestra Inspiración</h2>
        <div class="carrusel">
          <div class="carrusel-contenido">
            <div class="slide">
              <img src="../img-galeria/6TO  DAAI ARIS.jpg" alt="Foto 1">
              <div class="texto-slide">
                <h3>Limpiabotas</h3>
                <p>Esta es la representación de un limpiabotas de madera que tiene pintado un paisaje dominicano, desarrollado por Arisleidy Holguin una alumna de 6to DAAI.</p>
              </div>
            </div>
            <div class="slide">
              <img src="../img-galeria/6TO LT LIZ.jpg" alt="Foto 2">
              <div class="texto-slide">
                <h3>Pintura</h3>
                <p>Una pintura monocromática que muestra rostros en blanco y negro, destacando detalles emocionales a través del contraste de luces y sombras.</p>
              </div>
            </div>
            <div class="slide">
              <img src="../img-galeria/6TO DAAI RUTH.jpg" alt="Foto 3">
              <div class="texto-slide">
                <h3>Pintura Neoplastisismo</h3>
                <p>Una composición abstracta con formas geométricas simples, líneas negras gruesas que delimitan rectángulos, y una paleta limitada a colores primarios (rojo, azul, amarillo) junto con blanco y negro, reflejando equilibrio y armonía.</p>
              </div>
            </div>
            <div class="slide">
              <img src="../img-galeria/4TO EEM (3).jpg" alt="Foto 4">
              <div class="texto-slide">
                <h3> Pintura Natural y Orgánico</h3>
                <p>Una pintura serena de una tortuga marina nadando en aguas cristalinas, rodeada de destellos de luz que atraviesan la superficie y revelan la riqueza de colores y texturas del océano.</p>
              </div>
            </div>
          </div>
          <button class="btn-prev">&#10094;</button>
          <button class="btn-next">&#10095;</button>
        </div>
      </div>
     <!-- Sección creadores --> 
     <section class="creadores">
        <h2>Conoce a Nuestros Creadores</h2>
        <div class="tarjetas-creadores">
          <!-- Tarjeta de Creador 1 -->
          <div class="tarjeta">
            <div class="imagen-container">
              <img src="../imgs/ashlyfoto.jpg" alt="Creador 1">
            </div>
            <div class="contenido-tarjeta">
              <h3>Ashly Abreu</h3>
              <p>Estudiante de Desarrollo de Sofware del Instituto Politécnico Industrial Don Bosco.</p>
              <button><a href="https://web.whatsapp.com/" target="_blank">Contactar por WhatsApp</a></button>
            </div>
          </div>
          <!-- Tarjeta de Creador 2 -->
          <div class="tarjeta">
            <div class="imagen-container">
              <img src="../imgs/vilsonfoto.jpg" alt="Creador 2">
            </div>
            <div class="contenido-tarjeta">
              <h3>Vilson Castillo</h3>
              <p>Estudiante de Desarrollo de Sofware del Instituto Politécnico Industrial Don Bosco.</p>
              <button><a href="https://web.whatsapp.com/" target="_blank">Contactar por WhatsApp</a></button>
            </div>
          </div>
          <!-- Tarjeta de Creador 3 -->
          <div class="tarjeta">
            <div class="imagen-container">
              <img src="../imgs/ruthiefoto.jpg" alt="Creador 3">
            </div>
            <div class="contenido-tarjeta">
              <h3>Ruth Mercado</h3>
              <p>Estudiante de Desarrollo de Sofware del Instituto Politécnico Industrial Don Bosco.</p>
              <button><a href="https://web.whatsapp.com/" target="_blank">Contactar por WhatsApp</a></button>
            </div>
          </div>
        </div>
      </section>
      
          </div>
          <!-- Agregar más tarjetas según sea necesario -->
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
          <p>
              Somos una institución educativa del nivel medio en la modalidad Técnico Profesional, perteneciente al sector oficial, dirigida por la Congregación Salesiana con la finalidad de formar íntegramente a los jóvenes </p>
      </div>
  </div>
  <div class="footer-bottom">
      <p>&copy; 2024 pincelada-art. Todos los derechos reservados.</p>
  </div>
</footer>
      <script src="../JS/inicio.js"></script>

</body>
</html>