<?php
// Iniciar la sesión
session_start();

// Verificar si ya hay un usuario logueado
if (isset($_SESSION['usuario'])) {
    header('Location: inicio.php');
    exit();
}

// Manejar el registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrarse'])) {
    $usuario = trim($_POST['usuario']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Guardar los datos del usuario en un archivo JSON
    $usuariosFile = 'usuarios.json';
    $usuarios = file_exists($usuariosFile) ? json_decode(file_get_contents($usuariosFile), true) : [];

    foreach ($usuarios as $u) {
        if ($u['usuario'] === $usuario) {
            $error = 'El nombre de usuario ya existe.';
            break;
        }
    }

    if (!isset($error)) {
        $usuarios[] = ['usuario' => $usuario, 'password' => $password];
        file_put_contents($usuariosFile, json_encode($usuarios));
        $mensaje = 'Usuario registrado con éxito. Ahora puedes iniciar sesión.';
    }
}

// Manejar el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['iniciar_sesion'])) {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    // Leer los usuarios del archivo JSON
    $usuariosFile = 'usuarios.json';
    $usuarios = file_exists($usuariosFile) ? json_decode(file_get_contents($usuariosFile), true) : [];

    foreach ($usuarios as $u) {
        if ($u['usuario'] === $usuario && password_verify($password, $u['password'])) {
            $_SESSION['usuario'] = $usuario;
            header('Location: inicio.php');
            exit();
        }
    }

    $error = 'Nombre de usuario o contraseña incorrectos.';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="icon" href="Imagen1-removebg-preview.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('fondes.jpg'); /* Ruta de la imagen */
            background-size: cover; /* Asegura que la imagen cubra todo el fondo */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* Fija la imagen para que no se mueva al hacer scroll */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            height: 100vh; /* Asegura que el fondo cubra toda la altura de la pantalla */
            margin: 0; /* Elimina márgenes por defecto */
            display: flex; /* Permite centrar el contenido si lo necesitas */
            justify-content: center; /* Centra el contenido horizontalmente */
            align-items: center; /* Centra el contenido verticalmente */
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px;
        }
        h1 {
            font-size: 24px;
            color: #5e4636;
        }
        form {
            display: none;
            flex-direction: column;
        }
        form.active {
            display: flex;
        }
        input {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }
        button {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #823e23;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #5e4636;
        }
        .toggle {
            color: #5e4636;
            cursor: pointer;
            font-size: 14px;
            margin-top: -10px;
        }
        .toggle:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            h1 {
                font-size: 20px;
            }
            button {
                padding: 8px;
            }
            input {
                padding: 6px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 18px;
            }
            .logo img {
                max-width: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="LOGO.jpg" alt="Logo">
        </div>
        <h1>Bienvenido</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (isset($mensaje)): ?>
            <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form id="loginForm" class="active" method="POST">
            <h2>Iniciar Sesión</h2>
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="iniciar_sesion">Ingresar</button>
            <span class="toggle" onclick="toggleForms()">¿No tienes cuenta? Regístrate</span>
        </form>

        <form id="registerForm" method="POST">
            <h2>Registrar</h2>
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="registrarse">Registrar</button>
            <span class="toggle" onclick="toggleForms()">¿Ya tienes cuenta? Inicia sesión</span>
        </form>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            loginForm.classList.toggle('active');
            registerForm.classList.toggle('active');
        }
    </script>
</body>
</html>
