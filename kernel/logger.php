<?php

// Храним конфиг логгера в статической переменной
function logger_config(array $config = null)
{
    static $cfg = [
        'env' => 'prod',
        'debugger' => false,
        'log_dir' => __DIR__ . '/logs',
    ];

    if ($config !== null) {
        $cfg = array_merge($cfg, $config);
    }

    return $cfg;
}

function log_message(string $level, string $message): void
{
    $cfg = logger_config();

    $level = strtoupper($level);

    // Если режим не dev и debugger выключен — логируем только ERROR
    if ($cfg['env'] !== 'dev' && $cfg['debugger'] === false && $level !== 'ERROR') {
        return; // игнорируем INFO и WARNING в проде при выключенном дебаггере
    }

    $dir = $cfg['log_dir'];
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $timestamp = date('Y-m-d H:i:s');
    $line = "[$timestamp] [$level] $message\n";

    file_put_contents("$dir/app.log", $line, FILE_APPEND);
}

function log_info(string $message): void
{
    log_message('INFO', $message);
}

function log_warning(string $message): void
{
    log_message('WARNING', $message);
}

function log_error(string $message): void
{
    log_message('ERROR', $message);
}
