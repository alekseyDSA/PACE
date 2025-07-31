<?php
setcookie('admin_logged_in', '', time() - 3600, '/');
header('Location: /admin/login');
exit;
