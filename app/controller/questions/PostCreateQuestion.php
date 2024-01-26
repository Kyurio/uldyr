<?php

include __DIR__  .'/../../../app/model/Client.php';
include __DIR__  .'/../../../app/model/Questions.php';
use app\model\Questions;
use app\model\Client;


try {
    
    if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
        throw new Exception('La solicitud debe ser del tipo POST');
    }

    $obj = new Client();
    $qst = new Questions();
    $request = json_decode(file_get_contents("php://input"), true);

    if ($request === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Error al decodificar JSON');
    }
    $id = $obj->getLastInsertedId();
    $data = [
        'id_cliente' => $id,
        'pregunta' => $request["pregunta"],
    ];

    if ($qst->create($data)) {
        echo "true";
    } else {
        echo "false";
    }

} catch (Exception $ex) {
    // Manejar excepciones
    echo json_encode(['error' => true, 'message' => $ex->getMessage()]);
}
