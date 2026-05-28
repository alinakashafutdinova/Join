<?php include __DIR__ . '/../header.php'; ?>

<div class="error-page">
    <div class="code">500</div>
    <h1>Что-то пошло не так</h1>
    <p>На сервере произошла ошибка. Мы уже работаем над её устранением.</p>
    <?php if (!empty($error)): ?>
        <p style="color: var(--muted); font-size: .9rem;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <a href="/" class="btn btn-primary">На главную</a>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
