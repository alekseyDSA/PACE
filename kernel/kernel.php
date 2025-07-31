<?php
/*
 * Copyright (c) 2025 Алексей
 * Licensed under the MIT License.
 */
$config = include __DIR__ . '/../config/database.config.php';
include_once __DIR__ . '/logger.php';
logger_config([
    'env' => $configPage['env'] ?? 'prod',
    'debugger' => $configPage['debugger'] ?? false,
]);

logger_config([
    'env' => $configPage['env'] ?? 'prod',
    'debugger' => $configPage['debugger'] ?? false,
]);
log_info("[INFO] Логгер подключен");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

log_info("[INFO] Запуск kernel.php");



include __DIR__ . '/../config/page.config.php';
log_info("[INFO] Конфигурация страниц загружена");

$routes = include __DIR__ . '/../config/routes.config.php';
log_info("[INFO] Маршруты загружены");

include "autoinclude.php";
log_info("[INFO] Автоматический инклюд выполнен");

include "routes.php";
log_info("[INFO] Роутинг инициализирован");

if (!empty($config['auto_init_db'])) {
    log_info("[INFO] auto_init_db = true, подключаем install.php");
    include_once __DIR__ . "/install/install.php";
} else {
    log_info("[INFO] auto_init_db = false, пропускаем установку базы");
}
