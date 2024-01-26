<?php

require_once __DIR__ . '/../utils/SessionHelper.php';


try {

    // Inicia la sesión si aún no está iniciada
    SessionHelper::startSession();
    SessionHelper::destroy();
    echo "true";
    
} catch (\Throwable $th) {
    // Captura de excepción
    $error = ['error' => $th->getMessage()];
    return json_encode($error); // Devuelve el error como un objeto JSON
}
