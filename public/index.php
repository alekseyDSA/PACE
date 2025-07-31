<?php
/*
 * Copyright (c) 2025 Алексей
 * Licensed under the MIT License.
 */
?>


<?php
include __DIR__ . '/../kernel/kernel.php';
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($route === '') {
    $route = '/';
}
$routes = include __DIR__ . '/../config/routes.config.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Мой сайт</title>
    <?php autoincludeCss();?>
</head>
<body>
<?php handleRoute($route, $routes);?>
</body>
</html>

