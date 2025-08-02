<?php
$componentsPath = isset($GLOBALS['componentsPath']) ? $GLOBALS['componentsPath'] : 'default';
?>

<header>Добро пожаловать в FrameworkX</header>

<div class="banner">
    <?php include __DIR__ . "/../pages/{$componentsPath}/banner.php"; ?>
</div>

<nav>
    <?php include __DIR__ . "/../pages/{$componentsPath}/horizontalNavigation.php"; ?>
</nav>

<div class="features">
    <?php include __DIR__ . "/../pages/{$componentsPath}/feature.php"; ?>
</div>

<div class="status-bar">
    <?php include __DIR__ . "/../pages/{$componentsPath}/statusBar.php"; ?>
</div>

<main>
    <article>
        <?php include __DIR__ . "/../pages/{$componentsPath}/article.php"; ?>
    </article>
    <aside>
        <?php include __DIR__ . "/../pages/{$componentsPath}/aside.php"; ?>
    </aside>
</main>

<footer>
    <?php include __DIR__ . "/../pages/{$componentsPath}/footer.php"; ?>
</footer>