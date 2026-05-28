<?php include __DIR__ . '/../header.php'; ?>

<div class="greeting bye">
    <div class="icon">👋</div>
    <h1>Пока, <span class="name"><?= htmlspecialchars($name) ?></span>!</h1>
    <p>До новых встреч. Маршрут <code>/bye/&lt;имя&gt;</code> добавлен в третьем домашнем задании по аналогии с <code>/hello/&lt;имя&gt;</code> — это демонстрирует, как просто расширяется таблица маршрутов.</p>
    <div class="btn-row">
        <a href="/" class="btn btn-primary">На главную</a>
        <a href="/hello/<?= htmlspecialchars($name) ?>" class="btn btn-ghost">Поздороваться снова</a>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
