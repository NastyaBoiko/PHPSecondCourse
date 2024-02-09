<?php

spl_autoload_register();

$route = $_GET['route'] ?? '';

$routes = require __DIR__ . '/src/config/routes.php';
// var_dump($routes);

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    echo 'Страница не найдена!';
    return;
}

// var_dump($controllerAndAction);
$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

unset($matches[0]);
$controller = new $controllerName();
$controller->$actionName(...$matches);