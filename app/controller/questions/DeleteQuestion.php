<?php

include __DIR__  .'/../../../app/model/Questions.php';

use app\model\Questions;

function handleRequest()
{
    try {
        //Validar que la solicitud sea del tipo GET
        if (strtolower($_SERVER['REQUEST_METHOD']) !== 'delete') {
            throw new Exception('La solicitud debe ser del tipo delete');
        }

        $obj = new Questions();
        $id = $_GET['idPregunta'];
        $respuesta = $obj->delete($id);
        if($respuesta){
            echo "true";
        }else{
            echo "false";
        }
        

    } catch (\Throwable $th) {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(['error' => $th->getMessage()]);
    }
}

// Llamar a la función para manejar la solicitud
handleRequest();
?>
