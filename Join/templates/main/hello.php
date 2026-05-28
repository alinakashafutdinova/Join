<?php include __DIR__ . '/../header.php'; ?>

<div class="greeting">
    <div class="icon">👋</div>
    <h1>Привет, <span class="name"><?= htmlspecialchars($name) ?></span>!</h1>
    <p>Это страница приветствия. Маршрут <code>/hello/&lt;имя&gt;</code> демонстрирует работу роутера: имя из адреса передаётся в действие контроллера, а затем — в шаблон.</p>
    <div class="btn-row">
        <a href="/" class="btn btn-primary">На главную</a>
        <a href="/bye/<?= htmlspecialchars($name) ?>" class="btn btn-ghost">Попрощаться</a>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
