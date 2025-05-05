<?php
session_start();
header('Content-Type: application/json');

$comentariosFile = 'comentarios.json';
$comentarios = file_exists($comentariosFile) ? json_decode(file_get_contents($comentariosFile), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obraId = $_POST['obraId'] ?? null;
    $comentario = trim($_POST['comentario'] ?? '');

    if (!$obraId || !$comentario) {
        echo json_encode(['error' => 'Datos incompletos']);
        exit();
    }

    $nuevoComentario = [
        'obraId' => $obraId,
        'usuario' => $_SESSION['usuario'] ?? 'Anónimo',
        'comentario' => $comentario,
        'fecha' => date('Y-m-d H:i:s'),
    ];

    $comentarios[] = $nuevoComentario;
    file_put_contents($comentariosFile, json_encode($comentarios, JSON_PRETTY_PRINT));

    echo json_encode($nuevoComentario);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $obraId = $_GET['obraId'] ?? null;

    if (!$obraId) {
        echo json_encode([]);
        exit();
    }

    $comentariosFiltrados = array_filter($comentarios, function ($comentario) use ($obraId) {
        return $comentario['obraId'] === $obraId;
    });

    echo json_encode(array_values($comentariosFiltrados));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'editar') {
    $idComentario = $_POST['id'];
    $nuevoTexto = $_POST['comentario'];

    // Buscar y actualizar el comentario en la base de datos o archivo JSON
    foreach ($data as &$obra) {
        foreach ($obra['comentarios'] as &$comentario) {
            if ($comentario['id'] == $idComentario) {
                $comentario['comentario'] = $nuevoTexto;
                file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));
                echo json_encode(['success' => true]);
                exit();
            }
        }
    }
    echo json_encode(['error' => 'Comentario no encontrado']);
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'editar') {
    $idComentario = $_POST['id'];
    $nuevoTexto = $_POST['comentario'];
    $usuarioActual = $_SESSION['usuario'];

    foreach ($data as &$obra) {
        foreach ($obra['comentarios'] as &$comentario) {
            if ($comentario['id'] == $idComentario && $comentario['usuario'] === $usuarioActual) {
                $comentario['comentario'] = $nuevoTexto;
                file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));
                echo json_encode(['success' => true]);
                exit();
            }
        }
    }
    echo json_encode(['error' => 'Comentario no encontrado o sin permiso']);
    exit();
}
