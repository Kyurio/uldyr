<?php

include __DIR__  .'/../../../app/model/Data.php';

use app\model\Data;

function handleRequest()
{
    try {
        //Validar que la solicitud sea del tipo POST
        if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
            throw new Exception('La solicitud debe ser del tipo POST');
        }

        $obj = new Data();
        $request = json_decode(file_get_contents("php://input"), true);

        // Validar que la pregunta esté presente y no sea nula
        if (!isset($request['pregunta']) || empty($request['pregunta'])) {
            http_response_code(400); // Solicitud incorrecta
            echo json_encode(['error' => 'La pregunta no puede estar vacía']);
            exit;
        }

        $pregunta = $request["pregunta"];
        $respuesta = $obj->GetQuestion($pregunta);
        echo json_encode($respuesta);
        
    } catch (\PDOException $e) {
        http_response_code(500); // Error interno del servidor
        echo json_encode(['error' => 'Error en la consulta a la base de datos: ' . $e->getMessage()]);
    } catch (\Throwable $th) {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(['error' => $th->getMessage()]);
    }
}

// Llamar a la función para manejar la solicitud
handleRequest();
?>