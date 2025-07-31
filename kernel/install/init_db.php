<?php
function init_database()
{
    $config = include __DIR__ . '/../../config/database.config.php';
    $dsnBase = "mysql:host={$config['host']}";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    log_info("Подключение к БД '{$config['dbname']}'...");

    try {
        // Пробуем подключиться сразу с БД
        $pdo = new PDO("$dsnBase;dbname={$config['dbname']}", $config['user'], $config['pass'], $options);
        log_info("Успешное подключение к базе данных '{$config['dbname']}'");

    } catch (PDOException $e) {
        log_warning("База '{$config['dbname']}' не найдена или недоступна: " . $e->getMessage());

        if ($config['auto_init_db']) {
            log_info("Инициализация базы данных...");

            try {
                log_info("Подключение к MySQL-серверу без выбора БД...");
                $pdo = new PDO($dsnBase, $config['user'], $config['pass'], $options);

                log_info("Создание базы данных '{$config['dbname']}'...");
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$config['dbname']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                log_info("База данных создана или уже существует.");

                log_info("Переподключение с базой '{$config['dbname']}'...");
                $pdo = new PDO("$dsnBase;dbname={$config['dbname']}", $config['user'], $config['pass'], $options);

                $schemaPath = __DIR__ . '/../../config/schema.sql';
                log_info("Загрузка схемы из: $schemaPath");

                if (!file_exists($schemaPath)) {
                    log_error("Файл схемы не найден: $schemaPath");
                    exit(1);
                }

                $schema = file_get_contents($schemaPath);
                log_info("Выполнение SQL-скрипта...");

                foreach (explode(';', $schema) as $stmt) {
                    $stmt = trim($stmt);
                    if ($stmt) {
                        log_info("SQL: $stmt;");
                        try {
                            $pdo->exec($stmt);
                            log_info("Успешное выполнение.");
                        } catch (PDOException $stmtError) {
                            log_error("Ошибка при выполнении SQL: " . $stmtError->getMessage());
                        }
                    }
                }

                log_info("Инициализация базы завершена.");

            } catch (PDOException $innerEx) {
                log_fatal("Ошибка при создании базы данных: " . $innerEx->getMessage());
                exit(1);
            }

        } else {
            log_fatal("Подключение к БД невозможно, и auto_init_db отключен.");
            exit(1);
        }
    }
}