<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($login === 'admin' && $pass === '1234') {
        setcookie('admin_logged_in', '1', time() + 3600, '/');
        header('Location: /admin');
        exit;
    } else {
        $error = "Неверные данные";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Вход в админку</title></head>
<body>
<h1>Авторизация</h1>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
    <label>Логин: <input type="text" name="login"></label><br>
    <label>Пароль: <input type="password" name="password"></label><br>
    <button type="submit">Войти</button>
</form>
</body>
</html>
