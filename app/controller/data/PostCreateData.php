<?php

include __DIR__  .'/../../../app/model/Data.php';

use app\model\Data;

    try {
        //Validar que la solicitud sea del tipo POST
        if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
            throw new Exception('La solicitud debe ser del tipo POST');
        }

        $obj = new Data();
        $request = json_decode(file_get_contents("php://input"), true);
        
        $pregunta = $request["pregunta"];
        $respuesta = $request["respuesta"];

        $data = [
            'pregunta' => $pregunta,
            'respuesta' => $respuesta
        ];

        if($obj->create($data)){
            echo "true";
        }else{
            echo "false";
        }

        

        
    } catch (\Throwable $th) {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(['error' => $th->getMessage()]);
    }



?>
