<?php
$componentsPath = isset($GLOBALS['componentsPath']) ? $GLOBALS['componentsPath'] : 'default';
?>

<div class="admin-container">

    <!-- Вертикальное меню -->
    <aside class="admin-sidebar">
        <?php include __DIR__ . "/../pages/{$componentsPath}/sidebar.php"; ?>
    </aside>

    <div class="admin-main">

        <!-- Верхняя панель -->
        <header class="admin-topbar">
            <?php include __DIR__ . "/../pages/{$componentsPath}/topbar.php"; ?>
        </header>

        <!-- Основное содержимое -->
        <main class="admin-content">
            <?php include __DIR__ . "/../pages/{$componentsPath}/main.php"; ?>
        </main>

        <!-- Нижний футер -->
        <footer class="admin-footer">
            <?php include __DIR__ . "/../pages/{$componentsPath}/footer.php"; ?>
        </footer>
    </div>

</div>