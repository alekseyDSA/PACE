<?php
function autoincludeCss() {
    global $cssFiles;

    if (!isset($cssFiles) || !is_array($cssFiles)) {
        echo "<!-- CSS конфигурация не найдена -->";
        return;
    }

    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    usort($cssFiles, function ($a, $b) {
        $priorityA = $a['priority'] ?? 100;
        $priorityB = $b['priority'] ?? 100;
        return $priorityA < $priorityB ? -1 : 1;
    });

    foreach ($cssFiles as $css) {
        if (!isset($css['path'])) {
            echo "<!-- Путь не указан -->";
            continue;
        }

        // Читаем include и exclude
        $includes = $css['include'] ?? ['*'];
        $excludes = $css['exclude'] ?? [];

        // Проверка исключений — если совпал, пропускаем
        if (matchesPatterns($currentPath, $excludes)) {
            continue;
        }

        // Проверка включений — если не совпал ни с одним шаблоном, пропускаем
        if (!matchesPatterns($currentPath, $includes)) {
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

function matchesPatterns(string $path, array $patterns): bool {
    foreach ($patterns as $pattern) {
        // Простая поддержка '*'
        if ($pattern === '*') {
            return true;
        }

        // Поддержка префикса с '*', например '/admin/*'
        if (substr($pattern, -1) === '*') {
            $prefix = rtrim($pattern, '*');
            if (strpos($path, $prefix) === 0) {
                return true;
            }
        } else {
            // Точное совпадение
            if ($path === $pattern) {
                return true;
            }
        }
    }
    return false;
}

