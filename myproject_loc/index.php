<?php

spl_autoload_register();

$route = $_GET['route'] ?? '';

// echo 'route ' . $route;

$pattern = '~^hello/(.*)$~';

preg_match($pattern, $route, $matches);

if (!empty($matches)) {
    $controller = new \Src\Controllers\MainController();
    $controller->sayHello($matches[1]);
    return;
}

$pattern = "~^$~";

preg_match($pattern, $route, $matches);

if (!empty($matches)) {
    $controller = new \Src\Controllers\MainController();
    $controller->main();
    return;
}

$pattern = '~^echo/(.*)$~';

preg_match($pattern, $route, $matches);

if (!empty($matches)) {
    $controller = new \Src\Controllers\MainController();
    $controller->len($matches[1]);
    return;
}


// $controller = new \Src\Controllers\MainController();
// $controller->main();