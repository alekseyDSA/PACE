<?php
$env = 'dev';
$debugger = true;

$cssFiles = [
    [
        'path' => '/css/template.css',
        'priority' => 10,
        'include' => ['*'],
        'exclude' => ['/admin']
    ],
    [
        'path' => '/css/admin.css',
        'priority' => 100,
        'include' => ['/admin'],
        'exclude' => ['']
    ],
    [
        'path' => '/pages/welcome/public/css/main.css',
        'priority' => 20,
        'include' => ['*'],
        'exclude' => ['/admin']
    ]
];

$defaultTemplate = 'welcome';
$ErrorTemplate = '404.template.php';
$ErrorPage = 'Error.php';