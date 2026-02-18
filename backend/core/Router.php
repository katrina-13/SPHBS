<?php
class Router {
    public function dispatch(){
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = explode('/', $url);
        if($url[0] === 'api'){

            $controllerName = ucfirst($url[1]) . 'Controller';
            require_once "controllers/$controllerName.php";

            $controller = new $controllerName();
            $method = $url[2] ?? 'index';

            $controller->$method();
        } 
        else {
            echo json_encode(["message" => "API running"]);
        }
    }
}
?>
