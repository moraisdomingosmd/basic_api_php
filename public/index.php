<?php 

    header('Content-Type: application/json');
    require '../vendor/autoload.php';
    use app\routers\Routes;


    $routes = new Routes();
    
    try {
    
            http_response_code(200);
            echo json_encode(array('status' => 'sucess', 'data' => $routes->routes()));
            exit;

    } catch (\Throwable $th) {
        http_response_code(404);
        echo json_encode(array('status' => 'error', 'data' => $th->getMessage()), JSON_UNESCAPED_UNICODE);
        exit;
    }
    