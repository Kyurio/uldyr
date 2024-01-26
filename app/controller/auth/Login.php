<?php

require_once __DIR__ . '/../model/Login.php';
require_once __DIR__ . '/../utils/SessionHelper.php';

use app\model\Login;


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Error en los datos JSON']);
        exit;
    }

    $username = filter_var($data["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($data["password"], FILTER_SANITIZE_STRING);
    
    if (empty($username) || empty($password)) {
        echo json_encode(['error' => 'Datos incompletos']);
        exit;
    }

    $loginModel = new Login();

    $user = $loginModel->login($username, $password);
    
    if ($user) {
        SessionHelper::startSession();
        SessionHelper::set('csrf_token', bin2hex(random_bytes(32)));
        SessionHelper::set('user_id', $user['idUsuario']);
        SessionHelper::set('username', $user['Nombres']);
        SessionHelper::set('tipo_usuario', $user['Tipo_Usuario']);
        SessionHelper::set('sucursal', $user['Sucursal']);
       
        echo "true";        
    } else {
        echo "false";
    }
    
    
} catch (\Throwable $th) {
    // Captura de excepción
    error_log('Error en el script de inicio de sesión: ' . $th->getMessage());
    echo json_encode(['error' => 'Error interno']);
}


?>