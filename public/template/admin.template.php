<div class="admin-wrapper">
    <header class="admin-header">
        Добро пожаловать в админку PASE
    </header>

    <div class="admin-layout">
        <!-- Левое меню -->
        <aside class="admin-left-vertical-menu">
            <?php include __DIR__ . "/../pages/{$componentsPath}/admin-left-vertical-menu.php"; ?>
        </aside>

        <!-- Контент -->
        <main class="admin-content">
            <?php include __DIR__ . "/../pages/{$componentsPath}/main.php"; ?>
        </main>
    </div>

    <footer class="admin-footer">
        <?php include __DIR__ . "/../pages/{$componentsPath}/footer.php"; ?>
    </footer>
</div>