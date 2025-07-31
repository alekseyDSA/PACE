<?php

// lib/db.php
function get_pdo(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $config = include __DIR__ . '/../config/database.config.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
    }
    return $pdo;
}
