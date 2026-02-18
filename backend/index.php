<?php
header("Access-Control-allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

require_once "core/Router.php";
$router = new Router();
$router->dispatch();
?>