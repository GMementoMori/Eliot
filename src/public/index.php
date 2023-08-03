<?php
require __DIR__ . '/../vendor/autoload.php';
require_once(__DIR__ . "/../app/config/config.php");

$fullUrl = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$parsedUrl = parse_url($fullUrl);
$path = $parsedUrl['path'];

try {
    if (array_key_exists($path, ROUTES)) {
        [$controllerName, $methodName] = explode('Controller::', ROUTES[$path]);
        $controllerClass = 'App\Controller\\' . $controllerName . 'Controller';
        $controller = new $controllerClass();

        if ($requestMethod === 'GET') {
            if (method_exists($controller, 'get' . $methodName)) {
                $content = $controller->{'get' . $methodName}();
            } else {
                throw new Exception(ERROR_MESSAGE);
            }

        } elseif ($requestMethod === 'POST') {
            if (method_exists($controller, 'post' . $methodName)) {
                $content = $controller->{'post' . $methodName}();
            } else {
                throw new Exception(ERROR_MESSAGE);
            }
        }

        $templateFile = __DIR__ . "/../app/View/$controllerName.php";
        if (file_exists($templateFile)) {
            include($templateFile);
        } else {
            throw new Exception(ERROR_MESSAGE);
        }

    } else {
        throw new Exception(ERROR_MESSAGE);
    }

} catch (Exception $exception) {
    echo $exception->getMessage();
}
