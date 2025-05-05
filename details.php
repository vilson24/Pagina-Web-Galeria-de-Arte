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

// Obtener el ID de la obra de la URL
$obraId = isset($_GET['id']) ? $_GET['id'] : null;

// Buscar la obra en el archivo JSON
$obraSeleccionada = null;
if ($obraId) {
    foreach ($data as $index => $obra) {
        if ($obra['id'] == $obraId) {
            $obraSeleccionada = &$data[$index];
            break;
        }
    }
}

// Si no se encuentra la obra, redirigir a la galería
if (!$obraSeleccionada) {
    header('Location: gallery.php');
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
    <title>Detalles de la Obra</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="detallesestilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="Imagen1-removebg-preview.png" type="image/png">
    <style>
        .comentarios-section {
            margin-top: 20px;
            padding: 10px;
            background-color: transparent;
        }
        .comentario-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .comentario-usuario {
            font-weight: bold;
            color: #704b30; /* Marrón */
        }
        .comentario-texto {
            margin: 5px 0;
            font-size: 1em;
            line-height: 1.5;
            color: #5e4631; /* Marrón oscuro */
        }
        .comentario-fecha {
            font-size: 0.85em;
            color: #888;
        }
        .comentario-form textarea {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: 2px solid #b68d6c;
            border-radius: 5px;
            resize: none;
        }
        .comentario-form button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #704b30; /* Marrón */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .comentario-form button:hover {
            background-color: #5e4631; /* Marrón oscuro */
        }
    </style>
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

<main>
    <h1 class="obra-detalles-titulo"><?= htmlspecialchars($obraSeleccionada['nombreObra']) ?></h1>
    <div class="obra-detalles-contenedor">
        <div class="obra-detalles-imagen">
            <img src="uploads/<?= htmlspecialchars($obraSeleccionada['imagen']) ?>" alt="<?= htmlspecialchars($obraSeleccionada['nombreObra']) ?>">
        </div>
        <div class="obra-detalles-info">
            <p><strong>Autor:</strong> <?= htmlspecialchars($obraSeleccionada['usuario']) ?></p>
            <p><strong>Taller:</strong> <?= htmlspecialchars($obraSeleccionada['taller']) ?></p>
            <p><strong>Descripción:</strong> <?= htmlspecialchars($obraSeleccionada['descripcion']) ?></p>
        </div>
        <a href="gallery.php" class="button-back">Volver a la galería</a>
    </div>

    <div class="comentarios-section">
    <h2>Comentarios</h2>
    <div id="comentarios-lista" class="comentarios-lista"></div>
    <button id="toggle-comentarios" class="toggle-btn">Mostrar comentarios</button>
    <form id="comentario-form">
        <input type="hidden" id="obraId" value="<?= htmlspecialchars($obraSeleccionada['id']) ?>">
        <textarea id="comentario" placeholder="Escribe tu comentario..." required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>

</main>

<footer class="footer">
    <!-- Tu código del footer original se mantiene aquí -->
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const comentariosLista = document.getElementById('comentarios-lista');
    const toggleComentariosBtn = document.getElementById('toggle-comentarios');
    const comentarioForm = document.getElementById('comentario-form');
    const comentarioInput = document.getElementById('comentario');
    const obraIdInput = document.getElementById('obraId');
    const obraId = obraIdInput.value;

    let usuarioActual = '<?= htmlspecialchars($_SESSION['usuario']) ?>'; // Usuario autenticado

    // Alternar visibilidad de comentarios
    toggleComentariosBtn.addEventListener('click', function () {
        comentariosLista.classList.toggle('mostrar');
        toggleComentariosBtn.textContent = comentariosLista.classList.contains('mostrar')
            ? 'Ocultar comentarios'
            : 'Mostrar comentarios';
    });

    // Cargar comentarios al iniciar
    fetch(`procesar_comentario.php?obraId=${encodeURIComponent(obraId)}`)
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) {
                data.forEach(comentario => agregarComentarioDOM(comentario));
            }
        });

    // Manejar envío del formulario
    comentarioForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const comentarioTexto = comentarioInput.value.trim();
        if (!comentarioTexto) return;

        // Enviar comentario al servidor
        fetch('procesar_comentario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `obraId=${encodeURIComponent(obraId)}&comentario=${encodeURIComponent(comentarioTexto)}`,
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Error: ' + data.error);
                } else {
                    agregarComentarioDOM(data);
                    comentarioInput.value = ''; // Limpiar textarea
                }
            });
    });

    // Agregar comentario al DOM
    function agregarComentarioDOM(comentario) {
        const comentarioDiv = document.createElement('div');
        comentarioDiv.classList.add('comentario-item');
        comentarioDiv.innerHTML = `
            <span class="comentario-usuario">${comentario.usuario}</span>
            <p class="comentario-texto">${comentario.comentario}</p>
            <span class="comentario-fecha">${comentario.fecha}</span>
        `;

        if (comentario.usuario === usuarioActual) {
            const editarBtn = document.createElement('button');
            editarBtn.textContent = 'Editar';
            editarBtn.classList.add('editar-btn');
            editarBtn.addEventListener('click', function () {
                iniciarEdicionComentario(comentarioDiv, comentario);
            });
            comentarioDiv.appendChild(editarBtn);
        }

        comentariosLista.appendChild(comentarioDiv);
    }

    // Iniciar edición de comentario
    function iniciarEdicionComentario(comentarioDiv, comentario) {
        const textoOriginal = comentario.comentario;
        comentarioDiv.innerHTML = `
            <textarea class="editar-textarea">${textoOriginal}</textarea>
            <button class="guardar-btn">Guardar</button>
            <button class="cancelar-btn">Cancelar</button>
        `;

        comentarioDiv.querySelector('.guardar-btn').addEventListener('click', function () {
            const nuevoTexto = comentarioDiv.querySelector('.editar-textarea').value.trim();
            if (!nuevoTexto) return;

            // Enviar cambios al servidor
            fetch('procesar_comentario.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${encodeURIComponent(comentario.id)}&comentario=${encodeURIComponent(nuevoTexto)}&accion=editar`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error: ' + data.error);
                    } else {
                        comentario.comentario = nuevoTexto;
                        agregarComentarioDOM(comentario);
                        comentarioDiv.remove();
                    }
                });
        });

        comentarioDiv.querySelector('.cancelar-btn').addEventListener('click', function () {
            agregarComentarioDOM(comentario);
            comentarioDiv.remove();
        });
    }
});
</script>
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
