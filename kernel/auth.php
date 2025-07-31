<?php
function isAdmin(): bool {
    return isset($_COOKIE['admin_logged_in']) && $_COOKIE['admin_logged_in'] === '1';
}

function requireAdmin(): void {
    if (!isAdmin()) {
        header('Location: /admin/login');
        exit;
    }
}
