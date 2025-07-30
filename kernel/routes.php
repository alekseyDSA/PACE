<?php
/*
 * Copyright (c) 2025 Алексей
 * Licensed under the MIT License.
 */
?>

<?php
require_once __DIR__ . '/kernel.php';

function handleRoute($path, $routes) {
    global $defaultTemplate;
    if (!isset($routes[$path])) {
        http_response_code(404);
        include __DIR__ . '/../public/template/404.template.php';
        return;
    }
    $route = $routes[$path];
    $template = isset($route['template']) ? $route['template'] : $GLOBALS['defaultTemplate'];

    $componentsPath = isset($route['content']) ? $route['content'] : null;


    if (!$componentsPath) {
        http_response_code(500);
        echo "Не указан путь к компонентам";
        return;
    }
    $GLOBALS['componentsPath'] = $componentsPath;

    include __DIR__ . "/../public/template/{$template}.template.php";
}


