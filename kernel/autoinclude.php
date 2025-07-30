<?php
include_once __DIR__ . '/kernel.php';

function autoincludeCss()
{
    global $cssFiles;  // обязательно указать глобальную переменную

    if (!isset($cssFiles) || !is_array($cssFiles)) {
        echo "<!-- CSS конфигурация не найдена -->";
        return;
    }

    usort($cssFiles, function ($a, $b) {
        $priorityA = isset($a['priority']) ? $a['priority'] : 100;
        $priorityB = isset($b['priority']) ? $b['priority'] : 100;
        // Убрал вывод echo отсюда, чтобы не мешать сортировке
        return ($priorityA < $priorityB) ? -1 : 1;
    });

    foreach ($cssFiles as $css) {
        if (!isset($css['path'])) {
            echo "<!-- Путь не указан -->";
            continue;
        }

        $path = $css['path'];
        $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $path;

        if (!file_exists($absolutePath)) {
            echo "<!-- CSS файл не найден: $path -->";
            continue;
        }

        echo '<link rel="stylesheet" href="' . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    }
}
?>