<?php
// config.php

// Función para obtener la URL base de la aplicación
function getBaseUrl() {
    $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    return $protocol . '://' . $host . $uri;
}

// Ruta base de la aplicación (raíz del proyecto)
define('BASE_URL', getBaseUrl());

// Rutas para estilos, scripts, imágenes, etc.
define('CSS', BASE_URL . '/assets/css/');
define('APP', BASE_URL . '/app/utils/js/');
define('IMG', BASE_URL . '/assets/img/');
define('JS', BASE_URL . '/assets/js/');

//configuraciones basicas del sitio web:
define('TITTLE', 'Uldyr');
define('MAIL', '');
define('PHONE', '');
define('WHATSAPP', '');


// csrfToken
$csrfToken = bin2hex(random_bytes(32));