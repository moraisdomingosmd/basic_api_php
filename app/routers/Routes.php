<?php 

    namespace app\routers;

    class Routes {


        public  function routes() {


            if($_GET['url']) {
                $url = explode('/', $_GET['url']);
                
                if($url[0] === 'api') {
                    array_shift($url);
                    $controller = 'app\\controller\\'.ucfirst($url[0]).'Controller';
                    $method =  strtolower($_SERVER['REQUEST_METHOD']);
                    array_shift($url);
                    $response = call_user_func_array(array(new $controller, $method), $url);
                    return $response;
                }
            }
        }

    }